<?php
 require 'inc/session.php';
 header('Content-Type: Application/json');


//  To fetch withdrawal requests

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
  if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $sql = mysqli_query($connect, "SELECT withdrawal.*, users.firstname, users.lastname, users.email FROM withdrawal
        LEFT JOIN users ON withdrawal.user_id = users.id WHERE withdrawal.id = '{$id}'");
        $data = mysqli_fetch_array($sql);

        $message = ["data" =>$data];
        echo json_encode($message);
  }else{
        $sql = mysqli_query($connect, "SELECT withdrawal.*, users.firstname, users.lastname FROM withdrawal
        LEFT JOIN users ON withdrawal.user_id = users.id
         ORDER BY id DESC LIMIT 50");
        $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        
        $message = ["data" =>$data];
        echo json_encode($message);
}
    }elseif ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    
        // Read the raw input from the request
$rawData = file_get_contents("php://input");

// Decode the JSON data (assuming the data is in JSON format)
$patch = json_decode($rawData, true);

  if (array_key_exists('status', $patch)) {
   // To Update Withdrawal
  $id = $_GET['id'];
  $status = $patch['status'];
  
  $sel = mysqli_query($connect, "SELECT * FROM withdrawal WHERE id = '{$id}'");
    $row = mysqli_fetch_array($sel);
    $current_status = $row['with_status'];
    $amount = $row['amount'];

    
     if ($current_status == 'Rejected') {
        $msg = 'Withdrawal request has already been rejected';
     } else{
      $up = mysqli_query($connect, "UPDATE withdrawal SET with_status = '$status'
      WHERE id = '{$id}'");

    if ($current_status != 'Rejected' && $status == 'Rejected') {
        // To add back to wallet
        $wallet = mysqli_query($connect, "UPDATE affiliate_wallet SET amount =amount+'$amount'
        WHERE user_id = '{$row['user_id']}'");
    }
    if ($up){
      $msg ='Withdrawal successfully updated';
      } else{
        $msg ="Error!";
            }
          }
          }else{
        $msg ="Array key Error!";
          }
          $message = ["msg" => $msg];
          echo json_encode($message);
        }elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        $id = (int)$_GET['id'];
        $sql = "DELETE FROM withdrawal WHERE id = '{$id}'";
        $query = mysqli_query($connect, $sql);
        $msg = 'Withdrawal request successfully deleted';
        $message = ["msg" => $msg];
        echo json_encode($message);
      }
    
         
    



