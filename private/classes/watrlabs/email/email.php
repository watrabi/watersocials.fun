<?php

namespace watrlabs\email;

class email {
    public function __construct() {
        return "Hello World!";
    }
    
    public function helloworld() {
        return "Hello World!";
    }

    public function sendmail($to, $subject, $message) {

    $smtpServer = "mail.watrlabs.lol";
    $smtpPort = 465; 
    $smtpUsername = "info@watrlabs.lol";
    $smtpPassword = "Hello!!11";

    $smtpConnection = fsockopen('ssl://' . $smtpServer, $smtpPort, $errno, $errstr, 30);

    if (!$smtpConnection) {
        $returnvar = array(
            "code" => "500",
            "message" => "Could not connect to the mail server.",
        );
            
        return json_encode($returnvar);
        exit();
    }

    $email = "Subject: $subject\r\n";
    $email .= "To: $to\r\n";
    $email .= "From: info@watrlabs.lol\r\n";
    $email .= "MIME-Version: 1.0\r\n";
    $email .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $email .= "\r\n";
    $email .= $message;

    fwrite($smtpConnection, "EHLO " . $smtpServer . "\r\n");
    fwrite($smtpConnection, "AUTH LOGIN\r\n");
    fwrite($smtpConnection, base64_encode($smtpUsername) . "\r\n");
    fwrite($smtpConnection, base64_encode($smtpPassword) . "\r\n");
    fwrite($smtpConnection, "MAIL FROM: <info@watrlabs.lol>\r\n");
    fwrite($smtpConnection, "RCPT TO: <$to>\r\n");
    fwrite($smtpConnection, "DATA\r\n");
    fwrite($smtpConnection, $email . "\r\n");
    fwrite($smtpConnection, ".\r\n");
    fwrite($smtpConnection, "QUIT\r\n");
    fclose($smtpConnection);

    return "Mail sent successfully";

    }
}
