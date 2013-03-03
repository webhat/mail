<?php

if(file_exists("../../../ext/php/lib/swift_required.php"))
	include_once "../../../ext/php/lib/swift_required.php";
if(file_exists("ext/php/lib/swift_required.php"))
	include_once "ext/php/lib/swift_required.php";
include_once "bootstrap.php";

class Mail {
	function concierge( $data) {
		$c = new Config();

		$from = array( $c->service["mail"] => $c->service["name"]);
		$to = array( $c->service["mail"] => $c->service["name"]);
		$subject = "Automatisch Incasso";

		$transport = Swift_SmtpTransport::newInstance(
				$c->mail['host'],
				$c->mail['port']
			);
		$transport->setUsername($c->mail['username']);
		$transport->setPassword($c->mail['password']);
		$swift = Swift_Mailer::newInstance($transport);

		$message = new Swift_Message($subject);
		$message->setFrom($from);
		$message->setBody(var_export($data, true), 'text/plain');
		$message->setTo($to);

		if ($recipients = $swift->send($message, $failures)) {
			return true;
		} else {
			return false;
			print_r($failures);
		}

	}

	function send( $u) {
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
		$html = "You can view your results <a href='*|LNLURL|*' target='_self'>here</a>.</div>";
		//$subject = "Test";
		$subject = $c->service["name"] .": ". $c->mail['default'];

		$arr = array(
				"FNAME" => $fullname,
				"_rcpt" => $mail,
				"SUBJECT" =>$subject,
				"LNLURL" => $c->mail['LNLURL']. $hash
				);

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
