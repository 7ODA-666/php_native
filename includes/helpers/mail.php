<?php

function send_mail(string $mail,string $subject,string $message): bool {

    if(config('mail.protocol') == 'smtp') {

        ini_set("SMTP",config('mail.smtp_domain'));
        ini_set("smtp_port",config('mail.smtp_port'));
    }

    $headers = "MIMN_Version: 1.0\r\n";
    $headers .= "Content-type: text/html;charset=UTF-8\r\n";
    $headers .= "From: ". config('mail.FROM_ADDRESS') . "\r\n";


    return mail($mail, $subject, $message, $headers);
}


function send_mails(array $mails,string $subject,string $message): bool {

    return true;

    if(config('mail.protocol') == 'smtp') {

        ini_set("SMTP",config('mail.smtp_domain'));
        ini_set("smtp_port",config('mail.smtp_port'));
    }

    $headers = "MIMN_Version: 1.0\r\n";
    $headers .= "Content-type: text/html;charset=UTF-8\r\n";
    $headers .= "From: ". config('mail.FROM_ADDRESS') . "\r\n";

    foreach($mails as $mail) {
      mail($mail, $subject, $message, $headers);
    }
    
    return true;

}