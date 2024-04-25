<?php

require '../inc/config.php'; 
require "../inc/email.php";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';


    $sql = mysqli_query($connect, "SELECT subscriptions.*,users.firstname, users.email 
    FROM subscriptions 
    LEFT JOIN users ON subscriptions.user_id = users.id
    WHERE sub_status = 'Activated'");
    $msg = '';
    foreach ($sql as $key) {
        $sub_days = 30*$key['duration'];
        $activation_date = date_create($key['date']);
        $date = date("d-M-Y");        
        
        $today = date_create($date);
        
        $diff = date_diff($activation_date,$today);
        $days = $diff->format("%R%a");
        $days_left = $sub_days - $days;
        // echo $days;
        // echo $sub_days.' days '.$key['date'].' '.$days_left.' days left ☺<br>';
         if ($days_left == 7 || $days_left == 3 || $days_left == 1) {
             if($days_left >1){$t = 'days';}else{$t = 'day';}
             $title = $days_left.' '.$t. ' left until the end of the VPS rental period.';
            $msg = '<b>Dear '.$key['firstname'].',</b><br><br> We would like to inform you that there are only <b>'.
            $days_left.' '.$t.' left</b> until the lease of your VPS server with IP Address <b>'.$key['ip'].'</b> and Username <b>'.$key['username']. '</b> expires. <br><br> Please do not forget to renew your lease 
            in your personal account to avoid interruption of VPS operation. <br><br> Best regards👋';
         }elseif($days_left==0) {
            $title = 'VPS EXPIRED & LOCKED';
            $msg = '<b>Dear '.$key['firstname'].',</b><br><br>We would like to inform you that your VPS server with IP Address <b>'.$key['ip'].'</b> and Username <b>'.$key['username']. '</b> has been locked due to the expiration of the rental period.
            <br><br>
            Please note that we keep your vps data for 2 days after it is locked. After this period, the server and all its data will be permanently deleted. We strongly recommend that you do not delay the renewal to avoid the loss of important data. <br><br> Best regards👋';
            
         }
         if ($days_left == 7 || $days_left == 3 || $days_left == 1 || $days_left ==0) {
        $message =  '<!DOCYPE html><html><head>
    <style>
    .body{
        min-height: 100%;
        background-color: #eeeded !important;
        font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif;
        text-align: justify;
        padding: 15px;
    }
        .page{   
            background-color: #fff !important;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            color: black;
            width: 95%;
            display: inline-block;
            margin: 15px auto;
        }
    </style>
    </head><body><div class="body"><div class="page">'.$msg.'</div></div></body></html>';

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
    $mail->addAddress($key['email'], $key['firstname']);     //Add a recipient
    // $mail->addAddress($smtp_username);               //Name is optional
    // $mail->addReplyTo($smtp_username, 'Arocketpay');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $title;
    $mail->Body    = $message;
    $mail->AltBody = $message;
    $mail->send();
    // echo 'Success';
}
 catch (Exception $e) {
   echo "Message could not be sent. Ensure that your email is properly typed. Mailer Error: {$mail->ErrorInfo}. ";
}    
}
if ($days_left < 1) {
    mysqli_query($connect, "UPDATE subscriptions SET sub_status = 'Deactivated' WHERE id = '{$key['id']}'");
}
}
?>
