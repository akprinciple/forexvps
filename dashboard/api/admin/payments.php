<?php
    require 'inc/session.php';
    header('Content-Type: Application/json');
    

    // To fetch payments
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
      
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $sql = mysqli_query($connect, "SELECT payments.*, users.firstname, users.lastname, users.email
            FROM payments 
          LEFT JOIN users ON payments.user_id = users.id 
             WHERE payments.id = '$id'");
         $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
         $message = ["data" =>$data];
         echo json_encode($message); 
         }elseif (isset($_GET['key'])) {
             $key = htmlspecialchars($_GET['key']);
             $sql = mysqli_query($connect, "SELECT payments.*, users.firstname, users.lastname, users.email
             FROM payments 
           LEFT JOIN users ON payments.user_id = users.id 
             WHERE payments.payment_id LIKE '%".$key."%' || payments.payment_date LIKE '%".$key."%' ORDER BY id DESC LIMIT 50");
           $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
           $message = ["data" =>$data];
           echo json_encode($message);
                 }elseif(isset($_GET['dash'])){
                    // Just for Dashboard use only
                    $sql = mysqli_query($connect, "SELECT payments.*, users.firstname, users.lastname FROM payments 
                    LEFT JOIN users ON payments.user_id = users.id
                    WHERE payments.payment_status = 'pending'
                    ORDER BY payments.id DESC LIMIT 5
                    ");
                    $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
                    $message = ["data" =>$data];
                    echo json_encode($message);
                    }
                  
                 else{

                  $sql = mysqli_query($connect, "SELECT payments.*, users.firstname, users.lastname, users.email
                  FROM payments 
                LEFT JOIN users ON payments.user_id = users.id
                ORDER BY id DESC LIMIT 100");

         $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
         $message = ["data" =>$data];
         echo json_encode($message);
        }
         }elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // To approve payment
        if (isset($_POST['status']) && isset($_POST['type']) && isset($_POST['amount'])) {
            
            $id = (int)$_GET['id'];
            $amount = mysqli_real_escape_string($connect, $_POST['amount']);
            $status = mysqli_real_escape_string($connect, $_POST['status']);
            $type = mysqli_real_escape_string($connect, $_POST['type']);
            $updated = mysqli_query($connect, "UPDATE payments SET payment_amount='{$amount}', 
            payment_status = '{$status}', payment_type='{$type}' WHERE id ='{$id}'");
            if ($updated) {
                         $msg = "Action Successful";
                       }      
                       else{
                        $msg = "Error!";
                       }
          }
          else{
              $msg = "Submission key Error!";
            }
            $message = ["msg" => $msg];
            echo json_encode($message);
        }elseif ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    
          // Read the raw input from the request
  $rawData = file_get_contents("php://input");
  
  // Decode the JSON data (assuming the data is in JSON format)
  $patch = json_decode($rawData, true);
  
    if (array_key_exists('amount', $patch) && array_key_exists('status', $patch)) {
     // To Update Payments
    $id = $_GET['id'];
    $amount = $patch['amount'];
    $status = $patch['status'];
    
    $sel = mysqli_query($connect, "SELECT * FROM payments WHERE id = '{$id}'");
      $row = mysqli_fetch_array($sel);
      $current_status = $row['payment_status'];
      if ($current_status != 'Approved') {
        
      $up = mysqli_query($connect, "UPDATE payments SET payment_amount ='$amount', payment_status = '$status'
       WHERE id = '{$id}'");
      if ($up){
        // To add to wallet
        if ($status == 'Approved') {
          $wallet = mysqli_query($connect, "UPDATE wallet SET amount =amount+'$amount'
          WHERE user_id = '{$row['user_id']}'");
        }
        $msg ='Payment successfully updated';
         
        } else{
          $msg ="Error!";
              }
            }else{
              $msg = 'Payment cannot be Unapproved when it has already been approved!';
            }
  }else{
      $msg ="Array key Error!";
          }
          $message = ["msg" => $msg];
          echo json_encode($message);  
      }elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            // To delete payments
            $id = (int)$_GET['id'];
            $app = mysqli_query($connect, "SELECT * FROM payments WHERE id = '$id'");
            $row = mysqli_fetch_array($app);
            
                $approve = mysqli_query($connect, "DELETE FROM payments WHERE id = '$id'");
                $msg = "Payment was successfully Deleted!";
            
           
            $message = ["msg" => $msg];
            echo json_encode($message);
          }
          else{
            $msg = "Unknown http request";
            $message = ["msg" => $msg];
            echo json_encode($message);
          }
          
    
    