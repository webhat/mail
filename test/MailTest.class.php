<?php

class MailTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
	}

	public function tearDown() {
	}

	public function testStub() {
		$this->markTestIncomplete( 'This test has not been implemented yet.');
	}

	public function testMail() {
		$mail = new Mail();
		$mail->send(array("name" => "blaat","mail" => "daniel.crompton@gmail.com", "hash" => "ABCD"));
	}
}
 
?>
