<?php
    require 'inc/session.php';
    header('Content-Type: Application/json');

    
    // to Fetch Users
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        if(isset($_GET['key'])){
            $key = $_GET['key'];
            $sql = mysqli_query($connect, "SELECT * FROM users WHERE  email LIKE '%".$key."%' || firstname LIKE '%".$key."%' || lastname LIKE '%".$key."%' || date LIKE '%".$key."%' ORDER BY id DESC");
          }elseif(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = mysqli_query($connect, "SELECT * FROM users WHERE  id = '{$id}' ORDER BY id DESC");
            $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            $message = ["data" =>$data];
            echo json_encode($message);
            die();
          }
          else{
            $sql = mysqli_query($connect, "SELECT * FROM users WHERE level = 'user' ORDER BY id DESC ");
          }
          $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
            $message = ["data" =>$data];
            echo json_encode($message);
    }


    // TO Verify or Block Users
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id']) && isset($_POST['status'])) {
        $identity = $_POST['id'];
        $stat = $_POST['status'];
        
        if ($stat  == "Verified" || $stat  == "Unverified" || $stat  == "Blocked") {
            $approval= mysqli_query($connect, "UPDATE users SET status ='$stat' WHERE id = '{$identity}'");
            if ($approval) {
                $msg = "Action was Successful";
                  }else{
                    $msg = "Error!";
                  }
        }else {
            $msg = "Developer Error! Status can only be Verified, Unverified & Blocked";
        }
        $message = ["msg" => $msg];
        echo json_encode($message);
          
    } 
} 