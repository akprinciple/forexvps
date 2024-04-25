<?php
 require 'inc/session.php';
 header('Content-Type: Application/json');

 if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    
    // Read the raw input from the request
$rawData = file_get_contents("php://input");

// Decode the JSON data (assuming the data is in JSON format)
$patch = json_decode($rawData, true);

if (array_key_exists('password', $patch) && array_key_exists('new_password', $patch) && array_key_exists('c_password', $patch)) {
// To Update Subcategory
$select = mysqli_query($connect, "SELECT * FROM users WHERE id = '{$_SESSION['id']}'");
$row = mysqli_fetch_array($select);
$password = $patch['password'];
    $new_password = $patch['new_password'];
    $c_password = $patch['c_password'];
    if($password != $row['password']){
       $msg = "Incorrect Password.";
    }elseif ($c_password != $new_password) {
       $msg = "Re-confirm your password.";
      
    }else{
      $change = mysqli_query($connect, "UPDATE users SET password = '$new_password' WHERE id = '{$_SESSION['id']}'");
      if ($change) {
         $msg = "Password successfully updated";

    }else{
          $msg = "The system encountered an error. Please try again later.";
         }
    }
}else{
    $msg = "Developer Error! Expected array keys password, new_password and c_password  are not found.";
       }
       
 }else{
    $msg = "Unknown Http Request";
 }
$message = ["msg" => $msg];
 echo json_encode($message);
 