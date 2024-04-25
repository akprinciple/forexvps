<?php
 require 'inc/session.php';
 header('Content-Type: Application/json');


 

if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    
    // Read the raw input from the request
$rawData = file_get_contents("php://input");

// Decode the JSON data (assuming the data is in JSON format)
$patch = json_decode($rawData, true);

if (array_key_exists('firstname', $patch) && array_key_exists('lastname', $patch) && array_key_exists('phone', $patch) && array_key_exists('address', $patch)) {

// To Update profile

    $firstname = $patch['firstname'];
    $lastname = $patch['lastname'];
    $address = $patch['address'];
    $phone = $patch['phone'];
    $update = mysqli_query($connect, "UPDATE users SET firstname = '$firstname', lastname = '$lastname', phone = '$phone', address = '$address' WHERE id = '{$_SESSION['id']}'");
    if ($update) {
      $msg = "Profile successfully updated";
  }else{
    $msg = "The system encountered an error. Please try again later.";
       }
        $message = ["msg" => $msg];
        echo json_encode($message);
  }
 
}else{
    //  To fetch User
        $select = mysqli_query($connect, "SELECT * FROM users WHERE id = '{$_SESSION['id']}'");
        $row = mysqli_fetch_array($select, MYSQLI_ASSOC);
        $message = ["data" =>$row];
        echo json_encode($message);
}