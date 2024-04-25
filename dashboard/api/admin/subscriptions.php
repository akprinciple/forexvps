<?php
    require 'inc/session.php';
    header('Content-Type: Application/json');

    require "../inc/email.php";

    //Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';



// to Fetch transactions
if ($_SERVER["REQUEST_METHOD"] == "GET") {

        if(isset($_GET['key'])){
              $key = $_GET['key'];
            //   Search transactions by  trans_id & date
            $sql = mysqli_query($connect, "SELECT transactions.*, subcategories.subcategory,
            users.email, users.firstname, users.lastname, COALESCE(SUM(payments.payment_amount), 0) AS amount_paid FROM transactions
            LEFT JOIN subcategories ON transactions.subcategory_id = subcategories.id
            LEFT JOIN users ON transactions.user_id = users.id
            LEFT JOIN payments ON transactions.id = payments.transaction_id
            WHERE transactions.trans_id LIKE '%".$key."%' && transactions.user_id = '{$_SESSION['id']}' 
               || transactions.date LIKE '%".$key."%' && transactions.user_id = '{$_SESSION['id']}'
            GROUP BY transactions.id
            ORDER BY transactions.id DESC LIMIT 100");
            }elseif (isset($_GET['sub_id'])) {
                $id = $_GET['sub_id'];

                $sql = mysqli_query($connect,"SELECT subscriptions.*, vps.*, users.firstname, users.lastname, users.email
                FROM subscriptions
               LEFT JOIN vps ON subscriptions.vps_id = vps.id
                LEFT JOIN users ON subscriptions.user_id = users.id
                WHERE subscriptions.sub_id = '{$id}'
                ORDER BY subscriptions.id DESC LIMIT 1");
                $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $message = ["data" =>$data,];
                echo json_encode($message);
                die();
            } 
            elseif (isset($_GET['dash'])) {

                $sql = mysqli_query($connect,"SELECT subscriptions.*, vps.*, users.firstname, users.lastname, users.email
                FROM subscriptions
               LEFT JOIN vps ON subscriptions.vps_id = vps.id
               LEFT JOIN users ON subscriptions.user_id = users.id
                WHERE subscriptions.sub_status='processing'
                ORDER BY subscriptions.id DESC LIMIT 5 
                ");
                $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
                $message = ["data" =>$data,];
                echo json_encode($message);
                die();
            }
            else{
                $sql = mysqli_query($connect, "SELECT subscriptions.*, vps.*, users.*
                 FROM subscriptions
                LEFT JOIN vps ON subscriptions.vps_id = vps.id
                LEFT JOIN users ON subscriptions.user_id = users.id
                ORDER BY subscriptions.id DESC LIMIT 100");
            }
            $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
            $message = ["data" =>$data,];
            echo json_encode($message);
        }


    

// To update VPS
if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    
    // Read the raw input from the request
$rawData = file_get_contents("php://input");

// Decode the JSON data (assuming the data is in JSON format)
$patch = json_decode($rawData, true);

if (array_key_exists('username', $patch) && array_key_exists('password', $patch) 
&& array_key_exists('ip', $patch) && array_key_exists('status', $patch)) {
// To Update Subscriptions
$id = $_GET['sub_id'];
$username = mysqli_real_escape_string($connect, $patch['username']);
$password = mysqli_real_escape_string($connect, $patch['password']);
$status = mysqli_real_escape_string($connect, $patch['status']);
$ip = mysqli_real_escape_string($connect, $patch['ip']);

$up = mysqli_query($connect, "UPDATE subscriptions 
SET username ='$username', password = '$password', ip = '$ip', sub_status = '$status'
 WHERE sub_id = '{$id}'");
   // To fetxh vps 
   $select = mysqli_query($connect, "SELECT * FROM vps 
   WHERE id = ANY(SELECT vps_id FROM subscriptions WHERE sub_id = '{$id}')");
   $rw = mysqli_fetch_array($select);
   // To fetch User
   $user = mysqli_query($connect, "SELECT * FROM users
   WHERE id = ANY(SELECT user_id FROM subscriptions WHERE sub_id = '{$id}')");
   $r = mysqli_fetch_array($user);
//    to fetch subscription
        $query = mysqli_query($connect, "SELECT * FROM subscriptions WHERE sub_id = '{$id}'");
        $row = mysqli_fetch_array($query);

        $amount = $rw['price']*$row['duration'];
       
if ($up){
     //This is to reverse deducted funds from wallets
 if ($status == 'Rejected' && $row['sub_status'] != 'Rejected' && $row['sub_status'] != 'Activated') {
    // To return amount from wallet
    mysqli_query($connect, "UPDATE wallet SET amount = amount+'$amount' WHERE user_id = '{$row['user_id']}'");
    // To debit Referee
    mysqli_query($connect, "UPDATE affiliate_wallet SET amount = amount-1 
    WHERE user_id = (SELECT id FROM users WHERE reg_id= '{$r['ref_id']}') LIMIT 1");
    
}
if ($status == 'Activated') {
    $message = "Dear ".$r['firstname'].",<br> your Subscription for ".$rw['vps']." Forex VPS has been successfully activated. Details are as follows:
        <br><br><b>Duration:</b> ".$row['duration']." month(s) <br><b>Username: </b>".$row['username']." <br><b>Password:</b> ".$row['password']."
        <br><b>VPS IP Address:</b> ".$row['ip']." <br>Thank you for subscribing with us  <br> Best Regards 👋";   

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
$mail->setFrom($smtp_username, 'Myfxvpsm Support');
$mail->addAddress($r['email'], $r['firstname']);     //Add a recipient
$mail->addReplyTo($support_mail, 'Support');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');



//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Subscription Activation Alert';
$mail->Body    = $message;


$mail->AltBody = $message;

$mail->send();


//    $msg  = "Message Sent! We will get back to you as soon as possible.";

}
catch (Exception $e) {
// $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}.";
}    
}

    $msg ='Subscription successfully '.$status;
   
  } else{
    $msg ="Error!";
        }
}else{
$msg ="Array key Error!";
    }
    $message = ["msg" => $msg];
    echo json_encode($message);  
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
$id = $_GET['id'];
$sql = "DELETE FROM subscriptions WHERE sub_id = '{$id}'";
$query = mysqli_query($connect, $sql);
$msg = 'Subscriptions successfully deleted';
$message = ["msg" => $msg];
echo json_encode($message);
}
