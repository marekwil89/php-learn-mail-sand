<?php

/**
* Mail
*/

// $data = [
// 	'nadawca_imie' => '',
// 	'odpowiedz' => '', //opcjonalnie
// 	'odpowiedz_imie' => '', //opcjonalnie
// 	'odbiorca' => '',
// 	'odbiorca_imie' => '',
// 	'tytul' => '',
// 	'tresc' => '',
// ];

class Mail
{

	function smtp( $data ){

		date_default_timezone_set('Etc/UTC');

		require_once 'vendor/PHPMailer/PHPMailerAutoload.php';
		require_once 'vendor/html2text/src/Html2Text.php';

		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = Mail_SMTPDebug;
		$mail->CharSet = 'UTF-8';
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = Mail_Host;
		//Set the SMTP port number - likely to be 25, 465 or 587
		$mail->Port = Mail_Port;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication
		$mail->Username = Mail_Username;
		//Password to use for SMTP authentication
		$mail->Password = Mail_Password;
		//Set who the message is to be sent from
		$mail->setFrom( Mail_Username, $data['nadawca_imie']);
		
		if( isset( $data['odpowiedz'] ) ){
			//Set an alternative reply-to address
			$mail->addReplyTo( $data['odpowiedz'], $data['odpowiedz_imie']);
		}

		//Set who the message is to be sent to
		$mail->addAddress( $data['odbiorca'], $data['odbiorca_imie']);
		//Set the subject line
		$mail->Subject = $data['tytul'];
		//Read an HTML message body from an external file, convert referenced images to embedded,
		// convert HTML into a basic plain-text alternative body
		$mail->msgHTML( $data['tresc'] );
		// Replace the plain text body with one created manually
	
		$html = new \Html2Text\Html2Text($data['tresc']);
		$mail->AltBody = $html->getText();


		// dodanie załączników
		if( isset($data['attach']) && !empty($data['attach']) ){
			// Attach an image file
			if( is_array( $data['attach'] ) ){
				foreach ($data['attach'] as $key => $value) {
					$mail->addAttachment( $value );
				}
			}else{
				$mail->addAttachment($data['attach']);
			}
		}
		
		
		if (!$mail->send()) {
			$output = false;
		    // return "Mailer Error: " . $mail->ErrorInfo;
		} else {
			$output = true;
		    // return "Message sent!";
		}

		return $output;
	}
}