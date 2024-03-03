<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

try {
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $subject = htmlentities($_POST['subject']);
    $message = htmlentities($_POST['message']);

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.seznam.cz';
    $mail->SMTPAuth = true;
    $mail->Username = 'pjel@seznam.cz';
    $mail->Password = 'smiller3287*';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('pjel@seznam.cz', $name); // Nastav� odes�latele podle �daj� z formul��e
    // Nastaven� adresy p��jemce, p�edm�tu a obsahu zpr�vy
    $mail->addAddress('pjel@seznam.cz');
    $mail->addCC($email);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // P�id�n� p��loh
    if (!empty($_FILES['attachment']['name'][0])) {
        // Cyklus pro p�id�n� v�ech p��loh
        for ($i = 0; $i < count($_FILES['attachment']['name']); $i++) {
            $attachment = $_FILES['attachment']['tmp_name'][$i];
            $attachment_name = $_FILES['attachment']['name'][$i];
            $mail->addAttachment($attachment, $attachment_name);
        }
    }

    // Pokus� se odeslat e-mail
    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>


