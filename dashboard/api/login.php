<?php
session_start();
require "inc/config.php";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

   if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    date_default_timezone_set('Africa/Lagos');
    $date = date('M d, Y');
    $time = date('h:i:sa');

    $sql = "SELECT * FROM users WHERE email = '{$email}' && password = '{$password}'";
    $query = mysqli_query($connect, $sql);
    $counts = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);
    if ($counts > 0) {
    
    

        
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $id = $row['id'];
        $update = mysqli_query($connect, "INSERT INTO login (user_id, date, time) VALUES ('$id', '$date', '$time')");
        $msg = "Login Successful";
        $message = [
        "status" =>200,
        "msg" => $msg,
        "user_id"=> $row['id'],
        "firstname"=> $row['firstname'], 
        "lastname"=> $row['lastname'], 
        "email" => $row['email'],
        "token"=> $row['token'], 
        "user_status" =>$row['status'], 
        "level"=> $row['level'], 
        "login_date" => date('Y-m-d') 
         
    
    ];
    }
    else{
        $msg = "Wrong email or password";
        $message = ["status"=> 500, "msg" => $msg];
    }
}else{
    $message = ["status"=> 501, "msg" => "Error!"];
    

}
echo json_encode($message);
?>