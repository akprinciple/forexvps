<?php
    require "inc/session.php";
    require "../inc/email.php";

    //Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

    $select = mysqli_query($connect, "SELECT * FROM users WHERE id = '{$_SESSION['id']}'");
    $row = mysqli_fetch_array($select);
    $firstname = $row['firstname'];
    $email = $row['email'];
    if (isset($_POST['subject']) && isset($_POST['message'])) {
      $subject = mysqli_real_escape_string($connect, $_POST['subject']);
      $message = mysqli_real_escape_string($connect, $_POST['message']);


      //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $smtp;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $smtp_username;                     //SMTP username
    $mail->Password   = $smtp_password;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($smtp_username, 'Teleow Support');
    $mail->addAddress($support_mail, $subject);     //Add a recipient
    $mail->addReplyTo($email, $firstname);
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;


    $mail->AltBody = $message;

    $mail->send();
    

   $msg  = "Message Sent! We will get back to you as soon as possible.";
   
}
 catch (Exception $e) {
    $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}.";
}    
}else {
    $msg  = "Array key Error or Unknown Http Request.";
}
$message = ["msg" =>$msg];
echo json_encode($message);
  ?>
