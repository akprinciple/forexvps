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

                $sql = mysqli_query($connect,"SELECT subscriptions.*, vps.*
                FROM subscriptions
               LEFT JOIN vps ON subscriptions.vps_id = vps.id
                WHERE subscriptions.sub_id = '{$id}' && subscriptions.user_id = '{$_SESSION['id']}'
                GROUP BY subscriptions.id
                ORDER BY subscriptions.id DESC LIMIT 1");
                $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $message = ["data" =>$data,];
                echo json_encode($message);
                die();
            } 
            elseif (isset($_GET['dash'])) {

                $sql = mysqli_query($connect,"SELECT subscriptions.*, vps.*
                FROM subscriptions
               LEFT JOIN vps ON subscriptions.vps_id = vps.id
                WHERE subscriptions.user_id = '{$_SESSION['id']}' && subscriptions.sub_status='Activated'
                ORDER BY RAND() LIMIT 5 
                ");
                $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
                $message = ["data" =>$data,];
                echo json_encode($message);
                die();
            }
            else{
                $sql = mysqli_query($connect, "SELECT subscriptions.*, vps.vps
                 FROM subscriptions
                LEFT JOIN vps ON subscriptions.vps_id = vps.id
                WHERE subscriptions.user_id = '{$_SESSION['id']}'
                ORDER BY subscriptions.id DESC LIMIT 100");
            }
            $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
            $message = ["data" =>$data,];
            echo json_encode($message);
        }


    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['vps']) && isset($_POST['duration'])
    && isset($_POST['username']) && isset($_POST['password'])) {
        $user_id = $_SESSION['id'];
        $vps = mysqli_real_escape_string($connect, $_POST['vps']);
        $duration = mysqli_real_escape_string($connect, $_POST['duration']);
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);

        // To fetxh vps 
        $select = mysqli_query($connect, "SELECT * FROM vps WHERE vps = '{$vps}'");
        $rw = mysqli_fetch_array($select);
        // To fetch User
        $user = mysqli_query($connect, "SELECT * FROM users WHERE id = '{$user_id}'");
        $r = mysqli_fetch_array($user);
        // Main Wallet Balance
        $query = mysqli_query($connect, "SELECT * FROM wallet WHERE user_id = '{$_SESSION['id']}'");
        $row = mysqli_fetch_array($query);

        $amount = $rw['price']*$duration;
        $vps_id = $rw['id'];
        $date = date('d-M-Y');
        $time = date('h:i:sa');
        $wallet_balance = $row['amount'];
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
   
      // Shuffle the $str_result and returns substring
      // of specified length
        $subscription_id = 'Sub-'.substr(str_shuffle($str_result),0, 10);
        if($select->num_rows< 1){
          $msg = "VPS not found";
  
        }elseif ($wallet_balance < $amount) {
            $msg = "Insufficient Fund!";
        }elseif ($username == '' || $username ==' ') {
            $msg = "Please enter your preferred username";
        }
        else{
            $d = date('d-m-y');
            $updated = mysqli_query($connect, "INSERT INTO 
            subscriptions(sub_id, user_id, vps_id, duration, amount, date, time, username, password) 
            VALUES ('$subscription_id', '$user_id', '$vps_id', '$duration', '$amount', '$date', '$time', '$username', '$password')");
            if ($updated) {
            
            // To reduce amount from wallet
            mysqli_query($connect, "UPDATE wallet SET amount = amount-'$amount' WHERE user_id = '{$user_id}'");
            // To credit Referee
            mysqli_query($connect, "UPDATE affiliate_wallet SET amount = amount+1 
            WHERE user_id = (SELECT id FROM users WHERE reg_id= '{$r['ref_id']}') LIMIT 1");
            $msg = "Order for VPS has been successfully made. Our Representive(s) will get back to you as soon as possible";
            
            $message = "Dear Admin,<br> A new order has been made for <b>"
            .$vps."</b> Forex VPS for <b>".$duration."</b> month(s) by <b>".$r['firstname']. ' '.$r['lastname']. "</b><br><br><b>Subscription Id:</b> ".$subscription_id."<br>
             <br>Kindly check your dashboard and reply as soon as possible. <br> Best Regards 👋";
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
    $mail->addAddress($support_mail, 'Support');     //Add a recipient
    $mail->addReplyTo($r['email'], $r['firstname']);
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Order Alert';
    $mail->Body    = $message;


    $mail->AltBody = $message;

    $mail->send();
    

//    $msg  = "Message Sent! We will get back to you as soon as possible.";
   
}
 catch (Exception $e) {
    // $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}.";
}    
            
            }      
            else{
            $msg = "SQL Error!";
            }
      }
    }else{
        $msg = "Array key Error!";

       }
    $message = ["msg" => $msg];
    echo json_encode($message);
}


