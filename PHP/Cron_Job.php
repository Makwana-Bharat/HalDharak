<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/Exception.php");
    require("PHPMailer/SMTP.php");
    
    include_once("Connection.php");
    
    include_once('Mysqldump/Mysqldump.php');
    $dump = new Ifsnop\Mysqldump\Mysqldump("mysql:host=$hostname;dbname=$dbname", "$username","$password");
    $date=date("d-m-Y");
    $dump->start("BackUps/AllKhedut.sql");  
    $mail = new PHPMailer(true);

    $to="2018bharatmakwana@gmail.com";
    try {
        $mail->isSMTP();                                          
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                 
        $mail->Username   = '2022makwanabharat@gmail.com';        
        $mail->Password   = 'ewieevjcnilctlfm';                   
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
        $mail->Port       = 465;                                  

        //Recipients
        $mail->setFrom('2022makwanabharat@gmail.com', 'Makwana Bharat');
        $mail->addAddress($to, 'All Khedut');     //Add a recipient
        //Content
        $mail->isHTML(true);                                   //Set email format to HTML
        $mail->Subject = "HalDhar Backup";
        $mail->Body    = "HalDhar Softwer BackUp ".$date;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->addAttachment("BackUps/AllKhedut.sql"); 
        $mail->send();
        echo 'OTP Send..';
        unlink("BackUps/AllKhedut.sql");
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
?>