<?php
session_start();
require "inc/config.php";
require "inc/email.php";

ob_start();
if (getallheaders()!=='') {
    $all = getallheaders();
if (isset($all['user_id'])&&isset($all['email']) && isset($all['token']) ) {
  $login_date = $all['login_date'];
  $user_check = $all['user_id'];
  $user_email = $all['email'];
  $token = $all['token'];
}else{
  $message = ["status"=> 501, "msg" => "Please log in!"];
    echo json_encode($message);
  die();

}}


  //Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
$msg = "";

$sql = mysqli_query($connect, "SELECT * FROM users WHERE id = '{$user_check}'");
    

$row = mysqli_fetch_array($sql);
$firstname = $row['firstname'];
$email = $row['email'];
$token = $row['token'];


if (isset($_POST['submit'])) {
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $smtp;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $smtp_username;;                     //SMTP username
    $mail->Password   = $smtp_password;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom($smtp_username, 'Myfxvpsm');
      $mail->addAddress($email, $firstname);     //Add a recipient
      // $mail->addAddress($smtp_username);               //Name is optional
      // $mail->addReplyTo($smtp_username, 'myfxvpsm');
      // $mail->addCC('cc@example.com');
      // $mail->addBCC('bcc@example.com');
  
      
  
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Myfxvpsm verification link';
      $mail->Body    = '<!DOCYPE html><html><head>
                  <style>
                   .btn{   display: block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    background-color: #65B530;
    border-color: #65B530;
    color: #fff;
    width: 75%;
    display: inline-block;
    margin: 15px auto;
  }
                  </style>
      </head><body><b>Dear '. $firstname .'</b>, 
      <br>Thank you for registering with myfxvpsm.com.
      
      <br><br>The link below will help you in verifying your account. <a href='.'"https://www.myfxvpsm.com/dashboard/template/verify?email='.$email.'&&token='.$token.'">
        <br><br><button class="btn">Link</button></a>
        
        <br><br>If clicking on the link does not work, please copy this<br>
        https://www.myfxvpsm.com/dashboard/template/verify?email='.$email.'&&token='.$token.'
        <br> and paste in your browser instead.
        <br><br>
        If you did not register on our website, you can ignore this message and your account will be deleted.
        <br><br>
        If you have any question, please feel free to contact us at '.$support_mail.' 
        
        </body></html>';
  
  
      $mail->AltBody = '<!DOCYPE html><html><head>
      <style>
       .btn{   display: block;
  font-weight: 400;
  color: #212529;
  text-align: center;
  vertical-align: middle;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-color: transparent;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
  background-color: #65B530;
  border-color: #65B530;
  color: #fff;
  width: 75%;
  display: inline-block;
  margin: 15px auto;
  }
      </style>
  </head><body><b>Dear '. $firstname .'</b>, 
  <br>Thank you for registering with myfxvpsm.com.
  
  <br><br>The link below will help you in verifying your account. <a href='.'"https://www.myfxvpsm.com/dashboard/template/verify?email='.$email.'&&token='.$token.'">
  <br><br><button class="btn">Link</button></a>
  
  <br><br>If clicking on the link does not work, please copy this<br>
  https://www.myfxvpsm.com/dashboard/template/verify?email='.$email.'&&token='.$token.'
  <br> and paste in your browser instead.
  <br><br>
  If you did not register on our website, you can ignore this message and your account will be deleted.
  <br><br>
  If you have any question, please feel free to contact us at '.$support_mail.' 
  
  </body></html>';
  
      $mail->send();
      $msg = "Verification Link successfully sent to Mail";
      
  
  //    header('location: locked');
  }
   catch (Exception $e) {
      $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}.";
  }   
$message = ["msg" => $msg];
echo json_encode($message);
} 