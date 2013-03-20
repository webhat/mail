<?php

class MailTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
	}

	public function tearDown() {
	}

	public function testStub() {
		$this->markTestIncomplete( 'This test has not been implemented yet.');
	}

	/**
	 * @expectedException MailException
	 */
	public function testMail() {
		$mail = new Mail();
		$mail->send(
				array("name" => "blaat","mail" => "daniel.crompton+github@gmail.com", "hash" => "ABCD")
				);
	}

	public function testMailWithBody() {
		$mail = new Mail();
		$mail->send(
				array("name" => "blaat","mail" => "daniel.crompton+github@gmail.com", "hash" => "ABCD"),
				array(
					"body" => "<strong>*|URL|*</strong>",
					"URL" => "http://test.com/"
				));
	}
}
 
?>
