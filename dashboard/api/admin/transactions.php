<?php
    require 'inc/session.php';
    header('Content-Type: Application/json');
   

// to Fetch transactions
if ($_SERVER["REQUEST_METHOD"] == "GET") {

        if(isset($_GET['key'])){
              $key = $_GET['key'];
            //   Search transactions by firstnme, lastname, email, trans_id
              $sql = mysqli_query($connect, "SELECT transactions.*, subcategories.subcategory,
               users.email, users.firstname,users.lastname, COALESCE(SUM(payments.payment_amount), 0) AS amount_paid FROM transactions
               LEFT JOIN subcategories ON transactions.subcategory_id = subcategories.id
               LEFT JOIN users ON transactions.user_id = users.id
               LEFT JOIN payments ON transactions.id = payments.transaction_id
               WHERE transactions.user_id = ANY(SELECT id FROM users WHERE email LIKE '%".$key."%' || firstname LIKE '%".$key."%' || lastname LIKE '%".$key."%') || transactions.trans_id LIKE '%".$key."%' || transactions.date LIKE '%".$key."%' 
               GROUP BY transactions.id
               ORDER BY id DESC LIMIT 50");
            }elseif (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = mysqli_query($connect, "SELECT transactions.*, subcategories.subcategory,
                users.email, users.firstname,users.lastname, COALESCE(SUM(payments.payment_amount), 0) AS amount_paid FROM transactions
                LEFT JOIN subcategories ON transactions.subcategory_id = subcategories.id
                LEFT JOIN users ON transactions.user_id = users.id 
                LEFT JOIN payments ON transactions.id = payments.transaction_id
                WHERE transactions.id = '{$id}' 
                GROUP BY transactions.id
                 ORDER BY id DESC ");
                  $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
                  $message = ["data" =>$data,];
                  echo json_encode($message);
                  die();
            } 
            elseif (isset($_GET['user_id'])) {
                $id = $_GET['user_id'];
                $sql = mysqli_query($connect, "SELECT transactions.*, subcategories.subcategory,
                users.email, users.firstname,users.lastname, COALESCE(SUM(payments.payment_amount), 0) AS amount_paid FROM transactions
                LEFT JOIN subcategories ON transactions.subcategory_id = subcategories.id
                LEFT JOIN users ON transactions.user_id = users.id 
                LEFT JOIN payments ON transactions.id = payments.transaction_id
                WHERE transactions.user_id = '{$id}'
                GROUP BY transactions.id
                 ORDER BY id DESC");
            }elseif (isset($_GET['status'])) {
                $status = $_GET['status'];
                $sql = mysqli_query($connect, "SELECT transactions.*, subcategories.subcategory,
                users.email, users.firstname,users.lastname, COALESCE(SUM(payments.payment_amount), 0) AS amount_paid FROM transactions
                LEFT JOIN subcategories ON transactions.subcategory_id = subcategories.id
                LEFT JOIN users ON transactions.user_id = users.id 
                LEFT JOIN payments ON transactions.id = payments.transaction_id
                WHERE transactions.trans_status = '{$status}'
                GROUP BY transactions.id
                 ORDER BY id DESC");
            }   
            else{
                $sql = mysqli_query($connect, "SELECT transactions.*, subcategories.subcategory,
                users.email, users.firstname,users.lastname, COALESCE(SUM(payments.payment_amount), 0) AS amount_paid FROM transactions
                LEFT JOIN subcategories ON transactions.subcategory_id = subcategories.id
                LEFT JOIN users ON transactions.user_id = users.id
                LEFT JOIN payments ON transactions.id = payments.transaction_id
                GROUP BY transactions.id
                ORDER BY id DESC LIMIT 100");
            }
            $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
            $message = ["data" =>$data,];
            echo json_encode($message);
        }


        // to Manage Status of transactions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['trans_status']) && isset($_POST['amount']) && isset($_POST['payment_status'])) {
     $identity = $_POST['id'];
    $trans_status = $_POST['trans_status']; //completed, processing, pending
    $payment_status = $_POST['payment_status'];
    $amount = $_POST['amount'];
    if ($trans_status != "completed" && $trans_status != "processing" && $trans_status != "pending" && $trans_status != "rejected") {
        $msg = "Developer Error! Transaction Status can only be completed, processing, pending or rejected in lowercase";
    }elseif ($payment_status != "completed" && $payment_status != "part payment" && $payment_status != "waiting") {
        $msg = "Developer Error! Payment Status can only be completed, part payment or waiting in lowercase";
    }else{
        $approval= mysqli_query($connect, "UPDATE transactions SET trans_status ='$trans_status',
        payment_status = '$payment_status', amount = '{$amount}'
         WHERE id = '{$identity}'");
         if ($approval) {
            $msg = "Action was Successful!";
         }else{
            $msg = 'Error!';
         }
    }
     
    }
     elseif(isset($_POST['identity']) && isset($_POST['payment_status'])) {
        $identity = $_POST['id'];
       $stat = $_POST['payment_status'];
   
       if ($stat  == "completed" || $stat  == "part payment" || $stat  == "waiting") {
           $approval= mysqli_query($connect, "UPDATE transactions SET payment_status ='$stat' WHERE id = '{$identity}'");
           $msg = "Action was Successful!";
       }else {
           $msg = "Developer Error! Payment Status can only be completed, part payment or waiting in lowercase";
       }
       }else{
        $msg = "Array Key Error!";
       }
    $message = ["msg" => $msg];
    echo json_encode($message);
}


// To delete transactions
    if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        $id = (int)$_GET['id'];
        $app = mysqli_query($connect, "SELECT * FROM transactions WHERE id = '$id'");
        $row = mysqli_fetch_array($app);
        
            $approve = mysqli_query($connect, "DELETE FROM transactions WHERE id = '$id'");
            $msg = "Transaction was Deleted!";
        
       
        $message = ["msg" => $msg];
        echo json_encode($message);
      }