<?php
    require 'inc/session.php';
    header('Content-Type: Application/json');
    
    // To fetch cards
     if ($_SERVER["REQUEST_METHOD"] == "GET") {
      
       $sql = mysqli_query($connect, "SELECT * FROM rate WHERE id = 1");
       $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
       $message = ["data" =>$data];
        echo json_encode($message);
      }else{
       $msg = "Unknown Http Request";
       $message = ["msg" => $msg];
    echo json_encode($message);
    }
   
     


      
    