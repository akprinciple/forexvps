<?php
 require 'inc/session.php';
 header('Content-Type: Application/json');


//  To fetch withdrawal requests

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    

        $sql = mysqli_query($connect, "SELECT * FROM withdrawal WHERE user_id = '{$_SESSION['id']}' ORDER BY id DESC");
        $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);

        $message = ["data" =>$data];
         echo json_encode($message);
    }
    
    
         
    



// To add Withdrawal Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
        $bank_name = mysqli_real_escape_string($connect, $_POST['bank_name']);
        $amount = mysqli_real_escape_string($connect, $_POST['amount']);
        $account_name = mysqli_real_escape_string($connect, $_POST['account_name']);
        $account_number = mysqli_real_escape_string($connect, $_POST['account_number']);
        $date = date('d/M/Y');
        $user_id = $_SESSION['id'];
       if ($amount <10) {
          $msg = 'Amount must be atleast 10USD!';
        }elseif(strlen($bank_name)<1 || strlen($account_name)<1 || strlen($account_number)<1){
          $msg  = 'All fields are required';
        }elseif(strlen($account_number)<10){
            $msg  = 'Account Number must be atleast 10 digits';
          }
        else{
           $sel = mysqli_query($connect, "SELECT * FROM affiliate_wallet WHERE user_id = '{$user_id}'");
        $row = mysqli_fetch_array($sel);
           if ($row['amount'] < $amount){
           $msg = 'Insufficient Funds';
        }else{
              $updated = mysqli_query($connect, "INSERT INTO withdrawal(user_id, amount, account_name, 
              account_number, bank_name, date) VALUES ('$user_id', '$amount', '$account_name', 
              '$account_number', '$bank_name', '$date')");
              
              if ($updated) {
                // To reduce amount from wallet
                mysqli_query($connect, "UPDATE affiliate_wallet SET amount = amount-'$amount' WHERE user_id = '{$user_id}'");
               $msg = 'Withdrawal request has been successfully made. Our representatives will get back to you as soon as possible.';
              }else{
                     $msg = 'Error!';
                  }
               }
              }
            
              $message = ["msg" => $msg];
              echo json_encode($message);
}

