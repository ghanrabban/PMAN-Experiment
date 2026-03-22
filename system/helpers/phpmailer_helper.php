<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function send_email($recipient, $sender, $subject, $message, $attachment = "", $judul = "", $to = "", $cc = "", $senderName = "", $bcc ="", $displayname = 'Aplikasi Talenta PT Indonesia Power') {
    require_once("phpmailer/class.phpmailer.php");

    $mail = new PHPMailer();
    $body = $message;
    $mail->IsSMTP();
    $mail->SMTPAuth = false;


    $mail->Host = "192.168.10.105";

    $mail->Port = "25";
    if ($senderName == "") {
        $mail->AddReplyTo($sender, $displayname);
        $mail->FromName = $displayname;
    } else {
        $mail->AddReplyTo($sender, "$senderName");
        $mail->FromName = "$senderName";
    }
    $mail->From = $sender;

    /* if($to != ""){

      $mail->addCustomHeader("TO: $to");
      }
      if($cc != ""){

      $mail->addCustomHeader("CC: $cc");
      } */

    if (is_array($to)) {
        foreach ($to as $key) {
            $mail->AddAddress("$key");
        }
    }
    if (is_array($cc)) {
        foreach ($cc as $key) {
            $mail->AddCC("$key");
        }
    }
    
      if (is_array($bcc)) {
        foreach ($bcc as $key) {
            $mail->AddBcc("$key");
        }
    }



    $mail->Subject = $subject;
    $mail->AltBody = strip_tags($message);
    $mail->MsgHTML($body);
    $mail->AddAddress($recipient);

    if ($attachment != "") {
        #$mail->AddAttachment($attachment);      // attachment
        $binary_content = file_get_contents($attachment);
        #echo $binary_content;
        $mail->AddStringAttachment($binary_content, $judul, $encoding = 'base64', $type = 'application/pdf');
        #$mail->AddAttachment("./temp/a.pdf");
    }

    if (!$mail->Send()) {

        return FALSE;
    } else {

        return TRUE;
    }
}

/* End of file captcha_pi.php */
/* Location: ./system/plugins/captcha_pi.php */