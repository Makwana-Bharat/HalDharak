<?php
session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/Exception.php");
    require("PHPMailer/SMTP.php");
BackUpData();
SendMail();

function BackUpData(){
$date=date("d-m-Y");
include_once("Connection.php");
$BackUpFile=fopen("BackUps/".$date.".sql","w");

fwrite($BackUpFile,"\nDELETE FROM `khedut_master` WHERE SID=(SELECT SID FROM shethmaster WHERE
EMAIL='".$_SESSION['EMAIL']."'); \n") ;

$KhedutBkp=array();
$KhedutId=array();
$FolderId=array();
$Query="SELECT * FROM khedut_master WHERE SID=(SELECT SID FROM shethmaster WHERE EMAIL='".$_SESSION['EMAIL']."')";
$result=mysqli_query($con,$Query);
while($Khedut=mysqli_fetch_assoc($result))
{
$KhedutId[count($KhedutId)]=$Khedut['ID'];
$KhedutBkp[count($KhedutBkp)]="\nINSERT INTO `khedut_master`(`SID`, `ID`, `NAME`, `PIC`, `VILLAGE`, `MOBILE`) VALUES
('".$Khedut['SID']."','".$Khedut['ID']."','".$Khedut['NAME']."','".$Khedut['PIC']."','".$Khedut['VILLAGE']."','".$Khedut['MOBILE']."');";
}

fwrite($BackUpFile,"/*Khedut*/\n");
foreach($KhedutBkp as $element)
{
fwrite($BackUpFile,$element);
}

fwrite($BackUpFile,"\n/*Folder*/\n");


$KhedutBkp=[];
foreach($KhedutId as $element)
{
$Query="SELECT * FROM main_folder where ID=$element";
$result=mysqli_query($con,$Query);
if(mysqli_num_rows($result)>0){
while($Folder=mysqli_fetch_assoc($result))
{
$FolderId[count($FolderId)]=$Folder['MFID'];
$KhedutBkp[count($KhedutBkp)]="\nINSERT INTO `main_folder`(`MFID`, `ID`, `Year`) VALUES
('".$Folder['MFID']."','".$Folder['ID']."','".$Folder['Year']."');";
}

}

}
foreach($KhedutBkp as $Folder)
{
fwrite($BackUpFile,$Folder) ;
}

fwrite($BackUpFile,"\n/*Invoice*/\n");
$KhedutBkp=[];
foreach($FolderId as $element)
{
$Query="SELECT * FROM invoice where MFID=$element";
$result=mysqli_query($con,$Query);
if(mysqli_num_rows($result)>0){
while($Folder=mysqli_fetch_assoc($result))
{
$KhedutBkp[count($KhedutBkp)]="\nINSERT INTO `invoice`(`IID`, `MFID`, `RUPEE`, `DATE`, `DETAILS`, `TYPE`) VALUES
('".$Folder['IID']."','".$Folder['MFID']."','".$Folder['RUPEE']."','".$Folder['DATE']."','".$Folder['DETAILS']."','".$Folder['TYPE']."');";
}

}

}
foreach($KhedutBkp as $Invoice)
{
fwrite($BackUpFile,$Invoice);
}
fclose($BackUpFile);
}


function SendMail(){
$date=date("d-m-Y");
$mail = new PHPMailer(true);

$to='rahulkhannakaliyo@gmail.com';
try {
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = '2022makwanabharat@gmail.com';
$mail->Password = 'ewieevjcnilctlfm';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port = 465;

//Recipients
$mail->setFrom('2022makwanabharat@gmail.com', 'Makwana Bharat');
$mail->addAddress($to, $_SESSION['BRAND']); //Add a recipient
//Content
$mail->isHTML(true); //Set email format to HTML
$mail->Subject = $_SESSION['BRAND']." Backup";
$mail->Body = "HalDhar Softwer BackUp ".$date;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->addAttachment("BackUps/$date.sql");
$mail->send();
echo 'OTP Send..';
unlink("BackUps/$date.sql");
}
catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}