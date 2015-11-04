<?php
/*
sendmail:
	$Email 		is recipient's email address(example:xxx@xxx.com)
	$content 	is the message you want to send to the recipient(if $content=='GETKEY',means send a ramdom verifycode and return it)
*/
	function sendmail($Email,$content){

		date_default_timezone_set('Etc/UTC');
		require ("PHPMailer/PHPMailerAutoload.php");
		
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
		if(!strcmp($content,'GETKEY')){
			$mail->Subject = 'bookmyprinter verification mail';
			$key=rand(1,999999);
			$mail->Body = '你的認證碼是: '.$key;
		}
		else{
			$mail->Subject = 'bookmyprinter user report';
			$mail->Body = $content;
		}
		$mail->SMTPDebug = 0;
		$mail->send();
		if(!strcmp($content,'GETKEY')){
			return $key;
		}
		else{
			return 1;
		}
		
	}
?>