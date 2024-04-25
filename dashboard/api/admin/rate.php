<?php
    require 'inc/session.php';
    header('Content-Type: Application/json');
    
    // To fetch cards
     if ($_SERVER["REQUEST_METHOD"] == "GET") {
      
       $sql = mysqli_query($connect, "SELECT * FROM rate WHERE id = 1");
       $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
       $message = ["data" =>$data];
        echo json_encode($message);
      }elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rate = mysqli_real_escape_string($connect, $_POST['rate']);
    $change = mysqli_query($connect, "UPDATE rate SET rate = '$rate' WHERE id = 1");
    if ($change) {
       $msg = "Rate successfully updated";

  }else{
        $msg = "The system encountered an error. Please try again later.";
       }
       $message = ["msg" => $msg];
    echo json_encode($message);
    }else{
       $msg = "Unknown Http Request";
       $message = ["msg" => $msg];
    echo json_encode($message);
    }
   
     


      
    