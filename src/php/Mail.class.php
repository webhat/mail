<?php

if(file_exists("../../../ext/php/lib/swift_required.php"))
	include_once "../../../ext/php/lib/swift_required.php";
if(file_exists("../../mail/ext/php/lib/swift_required.php"))
	include_once "../../mail/ext/php/lib/swift_required.php";
if(file_exists("ext/php/lib/swift_required.php"))
	include_once "ext/php/lib/swift_required.php";
include_once "bootstrap.php";

class Mail {
	function send( $u, $mailbody = array()) {
		$c = new Config();

		$fullname = $u['name'];
		$mail = $u['mail'];
		$hash = $u['hash'];


		$from = array( $c->service["from"] => $c->service["name"]);   
		$to = array(
				  $mail => $fullname
				);

		$text = $c->service["name"] ." speaks plaintext";
		// FIXME: HACK!!!
		if( !empty($mailbody) && array_key_exists( 'body', $mailbody))
			$html = $mailbody['body'];
		else
			throw new MailException("No mail body");
		//$subject = "Test";
		$subject = $c->service["name"] .": ". $c->mail['default'];

		$arr = array(
				"FNAME" => $fullname,
				"_rcpt" => $mail,
				"SUBJECT" =>$subject,
				);

		$arr = array_merge( $arr, $mailbody);

		$json = json_encode($arr);

		$transport = Swift_SmtpTransport::newInstance(
				$c->mail['host'],
				$c->mail['port']
			);
		$transport->setUsername($c->mail['user']);
		$transport->setPassword($c->mail['pass']);
		$swift = Swift_Mailer::newInstance($transport);

		$message = new Swift_Message($subject);
		$message->setFrom($from);
		$message->setBody($html, 'text/html');
		$message->setTo($to);
//		$message->addPart($text, 'text/plain');
		$headers = $message->getHeaders();
		$headers->addTextHeader('X-MC-MergeVars', $json);
		$headers->addTextHeader('X-MC-Template', $c->mail['template']);

		if ($recipients = $swift->send($message, $failures)) {
			return true;
		} else {
			return false;
			print_r($failures);
		}
	}
}

?>
