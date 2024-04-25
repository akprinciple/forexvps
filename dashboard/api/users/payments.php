<?php
    require 'inc/session.php';
    require '../inc/email.php';
    header('Content-Type: Application/json');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require '../../PHPMailer-master/src/Exception.php';
    require '../../PHPMailer-master/src/PHPMailer.php';
    require '../../PHPMailer-master/src/SMTP.php';
        
    // To fetch transactions
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      if(isset($_GET['dash'])){
        // Just for Dashboard use only
        $sql = mysqli_query($connect, "SELECT * FROM payments 
        WHERE payments.user_id = '{$_SESSION['id']}'
        ORDER BY id DESC LIMIT 5
        ");
        $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        $message = ["data" =>$data];
        echo json_encode($message);
        }else{

          $sql = mysqli_query($connect, "SELECT * FROM payments 
          WHERE user_id = '{$_SESSION['id']}' ORDER BY id DESC LIMIT 50");
          $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
          $message = ["data" =>$data];
          echo json_encode($message);
}
    }

    // To make payment
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['method']) && isset($_POST['amount'])) {
          if (!isset($_FILES['image'])) {
           $msg = 'Please upload your payment receipt.';
          }else{
            
          
            $user_id = $_SESSION['id'];
            $amount = mysqli_real_escape_string($connect, $_POST['amount']);
            $method = mysqli_real_escape_string($connect, $_POST['method']);
            $image = $_FILES['image']['name'];
            $date = date('d/M/Y');
            $time = date('h:i:sa');
            $tmp = $_FILES['image']['tmp_name'];
             // String of all alphanumeric character
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            // $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
       
          // Shuffle the $str_result and returns substring
          // of specified length
            $payment_id = 'FX'.substr(str_shuffle($str_result),0, 10);
            $type = pathinfo("upload/$image", PATHINFO_EXTENSION);
            if ($amount <1) {
              $msg = 'Amount must be atleast 1 USD';
            }
            elseif ($image == '') {
              $msg = "Please upload your payment receipt.";
            }elseif ($_FILES["image"]["size"] > 1000000) {
              $msg = "Sorry, your file size must be less than 1mb.";
              }
              elseif ($type != "JPG" && $type != "jpg"  && $type != "PNG" && $type != "png" && $type != '') {
                $msg = "Only jpg and png files are allowed";
                  }
                   else{
                     $d = date('d-m-y');
                       $updated = mysqli_query($connect, "INSERT INTO payments
                                (user_id, payment_id, payment_amount, payment_method, payment_image,  payment_date, payment_time)
                        VALUES ('$user_id', '$payment_id', '$amount', '$method', '$d $image', '$date', '$time')");
                       
                      //  Email Alert Message
                       $message = "Dear Admin,<br> You have a new". $method." Payment made by <b>". $_SESSION['firstname'].' '. $_SESSION['lastname']."
                       </b>. Amount paid is  <b>USD ".$amount."</b><br><br> Kindly check your Dashboard as soon as possible for verification. <br>Thanks!";
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
               $mail->addAddress($support_mail, 'Admin');     //Add a recipient
               $mail->addReplyTo($_SESSION['email'], $_SESSION['firstname']);
               // $mail->addCC('cc@example.com');
               // $mail->addBCC('bcc@example.com');
           
               
           
               //Content
               $mail->isHTML(true);                                  //Set email format to HTML
               $mail->Subject = 'Payment Alert';
               $mail->Body    = $message;
           
           
               $mail->AltBody = $message;
           
               $mail->send();
               
           
           //    $msg  = "Message Sent! We will get back to you as soon as possible.";
              
           }
            catch (Exception $e) {
              //  $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}.";
           }
                       if ($updated) {
                         move_uploaded_file($tmp, "../payment_images/$d $image");
               $msg = "Payment Evidence has been Successfully Submitted. Our team will check and confirm ASAP";

                       }      
                       else{
                        $msg = "Error!";
                       }
          }
        }
        }else{
            $msg = "Submission key Error!";
           }
           $message = ["msg" => $msg];
           echo json_encode($message);
    }