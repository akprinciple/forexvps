<?php
session_start();
require "inc/config.php";
require "inc/email.php";
ob_start();

  //Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
$msg = "";



if (isset($_POST['email']) && isset($_POST['token']) && isset($_POST['password'])&& isset($_POST['c_password'])) {
    $email = $_POST['email'];
    $token = $_POST['token'];

    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $c_password = mysqli_real_escape_string($connect, $_POST['c_password']);

    $query = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email' && token = '$token'");
    if ($query -> num_rows <1) {
        $msg ="Invalid or Expired link!";
    }elseif(empty($password) || strlen($password)<8){
        $msg ="Password length must be atleast 8 characters!";
    }
    elseif ($password != $c_password) {
        $msg ="Re-confirm your password!";
    }else {
        $update = mysqli_query($connect, "UPDATE users SET password = '$password' WHERE email = '{$email}' && token = '{$token}'");
        if ($update) {
            $sql = mysqli_query($connect, "SELECT * FROM users WHERE email = '{$email}' && token = '{$token}'");
            $row = mysqli_fetch_array($sql);
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $msg ="Password successfully changed";
            
            
        }
    
    }
     
}
// To send change password mail
elseif (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $sql = mysqli_query($connect, "SELECT * FROM users WHERE email = '{$email}'");
    if ($sql ->num_rows<1) {
        $msg ="Email not found!";
        
    }else{

    
    $row = mysqli_fetch_array($sql);
    $firstname = $row['firstname'];
    // $email = $row['email'];
    $token = md5($firstname).rand(1000, 9999);
    // Change token
    $update = mysqli_query($connect, "UPDATE users SET token = '$token' WHERE email = '{$email}'");
    
    $message = '<!DOCYPE html><html><head>
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

<br><br>The link below will help you in changing your password. <center><a href='.'"https://www.myfxvpsm.com/dashboard/template/change-forgot-password?email='.$email.'&&token='.$token.'">
<br><br><button class="btn">Link</button></a></center>

<br><br>If clicking on the link does not work, please copy this<br>
https://www.myfxvpsm.com/dashboard/template/change-forgot-password?email='.$email.'&&token='.$token.'
<br> and paste in your browser instead.
<br><br>
If you did not initiate this process on our website, you can ignore this message and your account will be safe.
<br><br>
If you have any question, please feel free to contact us at '.$support_mail.'

</body></html>';
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
    $mail->setFrom($smtp_username, 'Myfxvpsm');
    $mail->addAddress($email, $firstname);     //Add a recipient
    // $mail->addAddress($smtp_username);               //Name is optional
    // $mail->addReplyTo($smtp_username, 'Arocketpay');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Change of password link';
    $mail->Body    = $message;


    $mail->AltBody = $message;

    $mail->send();
    

   $msg ="A link has been sent to your mail. Check your mail for further steps";
}
 catch (Exception $e) {
   $msg ="Message could not be sent. Ensure that your email is properly typed. Mailer Error: {$mail->ErrorInfo}. ";
}    
}
} else{
    $msg= 'Unknown http request or invalid array key';
}

$messages = ["status"=> 200, "msg" => $msg];
    echo json_encode($messages);
