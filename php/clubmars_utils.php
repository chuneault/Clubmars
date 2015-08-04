<?php
  //error_reporting(E_ALL ^ E_NOTICE);

  date_default_timezone_set('America/Toronto');

  require_once('extra/phpmailer/class.phpmailer.php');

  function sendmail($to,  $subject = '(No subject)', $bodymsg = '', $files, $sendermail) {

    $mail = new PHPMailer();

    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                               // 1 = errors and messages
                                               // 2 = messages only
    $mail->SMTPAuth   = true;                  // enable SMTP authentication

    $mail->Host       = "hp52.hostpapa.com";
    $mail->Port       = 465;
    $mail->Username   = "noreply@clubmars.org";
    $mail->Password   = "noreply";
    $mail->CharSet = "UTF-8";
    $mail->SMTPSecure = "ssl";

    $mail->AddReplyTo($sendermail);
    $mail->SetFrom("noreply@clubmars.org", $sendermail);
    $mail->Subject    = $subject;
    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

    $mail->MsgHTML($bodymsg);

    foreach ($to as $idx => $tomail) {
     $mail->AddBCC($tomail['email'], $tomail['name']);
    }

    if (isset($files['myfile'])) {
      foreach ($files['myfile'] as $idx => $file) {
         $mail->AddAttachment($file['tmp_name'], $file['']);
      }
    }

    if(!$mail->Send()) {
      Return "Mailer Error: " . $mail->ErrorInfo;
    } else {
      Return "ok";
    }
  }

?>