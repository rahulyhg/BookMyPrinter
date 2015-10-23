<?php
	function sendmail($Email){

		date_default_timezone_set('Etc/UTC');
		require ("PHPMailer/PHPMailerAutoload.php");
		$key=rand(1,999999);
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 2;
		$mail->Debugoutput = 'html';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = "bookmyprinterncku@gmail.com";
		$mail->Password = "e8k9j9e1rz58";
		$mail->setFrom('bookmyprinterncku@gmail.com', 'book printer');
		$mail->addReplyTo('bookmyprinterncku@gmail.com', 'book printer');
		$mail->addAddress($Email, ' ');
		$mail->Subject = 'bookmyprinter verification mail';
		$mail->Body = '你的認證碼是: '.$key;
		$mail->SMTPDebug = 0;
		$mail->send();
		return $key;
	}
?>