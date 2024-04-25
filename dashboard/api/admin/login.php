<?php
    require 'inc/session.php';
    header('Content-Type: Application/json');


// to Fetch Visitors
if ($_SERVER["REQUEST_METHOD"] == "GET") {

       
                $sql = mysqli_query($connect, "SELECT login.*, users.firstname, users.lastname FROM login
                LEFT JOIN users ON login.user_id = users.id
                ORDER BY id DESC LIMIT 5");
            $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
            $message = ["data" =>$data,];
            echo json_encode($message);
        }
       


    
