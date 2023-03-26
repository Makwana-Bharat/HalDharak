<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/Exception.php");
    require("PHPMailer/SMTP.php");
    
    
    $mail = new PHPMailer(true);

    $to=$_POST['EMAIL'];
    $_SESSION['EMAIL']=$to;
    $OTP=rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    $_SESSION["TOTPT"]=$OTP;
    $body="Verify Your New Account Using <hr><h2><strong>OTP: <strong><b>$OTP</b></h2><br><hr><sapn style='color:red'>* Don't Share It..!!!";
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
        $mail->addAddress($to, 'Ramdev Treding');     //Add a recipient
        //Content
        $mail->isHTML(true);                                   //Set email format to HTML
        $mail->Subject = "Ramdev Treding Forgot Password";
        $mail->Body    = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        echo 'OTP Send..';
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
?>