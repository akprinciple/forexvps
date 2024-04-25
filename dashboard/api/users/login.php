<?php
    require 'inc/session.php';
    header('Content-Type: Application/json');


// to Fetch transactions
if ($_SERVER["REQUEST_METHOD"] == "GET") {

       
                $sql = mysqli_query($connect, "SELECT * FROM login
                WHERE user_id = '{$_SESSION['id']}'
                ORDER BY id DESC LIMIT 5");
            $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
            $message = ["data" =>$data,];
            echo json_encode($message);
        }
       


    
