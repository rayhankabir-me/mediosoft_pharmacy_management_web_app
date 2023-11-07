<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';


function send_mail($email, $subject, $message){
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'devrayhankabir@gmail.com';                     
        $mail->Password   = 'jfmhjonbbfhlpjxk';                 
        $mail->SMTPSecure = 'tls';           
        $mail->Port       = 587;
    
        //Recipients
        $mail->setFrom('devrayhankabir@gmail.com', 'MedioSoft');
        $mail->addAddress($email);     
    
    
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;
    
        $mail->send();

        return true;

    } catch (Exception $e) {
        return false;
    }
}


?>