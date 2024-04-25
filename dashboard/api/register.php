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
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
if (isset($_POST['firstname']) && isset($_POST['lastname'])
&& isset($_POST['email']) && isset($_POST['phone']) 
&& isset($_POST['password']) && isset($_POST['c_password']) && isset($_POST['address'])) 
  {
    // echo $_POST['firstname'];


$firstname = test_input($_POST['firstname']);
$lastname = test_input($_POST['lastname']);
$email = test_input($_POST['email']);
$phone = test_input($_POST['phone']);
$password = test_input($_POST['password']);
$c_password = test_input($_POST['c_password']);
$address = test_input($_POST['address']);
$token = "myfxvpsm".md5($firstname)."leo".rand(1000, 9999);
$date= date('d/M/Y');
// Referral Id
$ref_id = test_input($_POST['ref_id']);

// String of all alphanumeric character
$str_result = '0123456789abcdefghijklmnopqrstuvwxyz';

$reg_id = 'user-'.substr(str_shuffle($str_result),0, 8).date('dm');
if($firstname == '' || $lastname == '' || $email == '' || $phone== '' || $password== '' || $address== ''){
  $msg = 'All fields are required';
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $msg = "Invalid email format";
}
elseif(strlen($password <8)){
  $msg = 'Password must be atleast 8 characters';
}
elseif ($password != $c_password) {
$msg = "Confirm Your Password!";
}
else{
$mail = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");
// print_r($mail);
if (mysqli_num_rows($mail) > 0) {
$msg = "The Email has been registered!";
    
}else{



$sql = "INSERT INTO users(firstname, lastname, email, password, phone, address, token, date, reg_id, ref_id) VALUES ('$firstname', '$lastname', '$email', '$password', '$phone', '$address', '$token', '$date', '$reg_id', '$ref_id')";
$query = mysqli_query($connect, $sql);
if ($query) {
$fetch = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");
$vet = mysqli_fetch_array($fetch);
$_SESSION['id'] = $vet['id'];
$_SESSION['email'] = $vet['email'];
$_SESSION['password'] = $vet['password'];
$id = $vet['id'];

$wallet = mysqli_query($connect, "INSERT INTO wallet(user_id, amount) VALUES('$id', 0)");
$affiliate_wallet = mysqli_query($connect, "INSERT INTO affiliate_wallet(user_id, amount) VALUES('$id', 0)");
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $smtp;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $smtp_username;                    //SMTP username
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
    $msg = "Registration Successful";
    

//    header('location: locked');
}
 catch (Exception $e) {
    $msg = "Registration Successful. Message could not be sent. Ensure that your email is properly typed. Mailer Error: {$mail->ErrorInfo}.";
}    

}
}
}
}else{
 $msg = "Error! ".mysqli_error($connect);
}
$message = ["msg" => $msg];
echo json_encode($message);