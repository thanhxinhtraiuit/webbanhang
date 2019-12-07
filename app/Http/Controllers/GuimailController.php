<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class GuimailController extends Controller
{
    public function sendEmail ($to,$name,$title,$body) {
  	// is method a POST ?
			  		
			 // $to="lsr32355@zzrgg.com";
			 // $name = "hong";
			 // $title="test";
			 // $path = asset("mau-mail.html");

			 
			// echo $contents; die;

			$mail = new PHPMailer(true);                            // Passing `true` enables exceptions

			try {
				// Server settings
	    	$mail->SMTPDebug = 0;                                	// Enable verbose debug output
				$mail->isSMTP();                                     	// Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';												// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                              	// Enable SMTP authentication
				$mail->Username = 'hoangnguyen13579z@gmail.com';             // SMTP username
				$mail->Password = 'thanh123a';              // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;    
				$mail->CharSet = "UTF-8";                                 // TCP port to connect to

				//Recipients
				$mail->setFrom('hoangnguyen13579z@gmail.com', 'CuteShop');
				$mail->addAddress($to, $name);	// Add a recipient, Name is optional
				// $mail->addReplyTo('your-email@gmail.com', 'Mailer');
				// $mail->addCC('his-her-email@gmail.com');
				// $mail->addBCC('his-her-email@gmail.com');

				//Attachments (optional)
				// $mail->addAttachment('/var/tmp/file.tar.gz');			// Add attachments
				// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');	// Optional name

				//Content
				$mail->isHTML(true); 																	// Set email format to HTML
				$mail->Subject = $title;
				$mail->Body    = $body;					// message

				$mail->send();
				return "thanh cong";
			} catch (\Exception $e) {
				\Log::info($e);
				return "loi";
			}
		
    	return 'abc';
  }
}
