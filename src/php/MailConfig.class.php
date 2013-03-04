<?php

class MailConfig {
	public $mail;

	function __construct() {
		$this->mail = array(
					"host" => "smtp.mandrillapp.com",
					"port" => "587",
					"pass" => "F9TenROspDKLMspC8UCLkg",
					"user" => "info@leanandlasting.com",
					"LNLURL" => "http://thelastconsultant.com/index.page.php?id=",
					"default" => "Assignment Oracle",
					"template" => "lnl-thank-you"
				);
		$this->service = array(
					"name" => "The Last Consultant",
					"from" => "info@thelastconsultant.com"
				);
	}
}
?>
