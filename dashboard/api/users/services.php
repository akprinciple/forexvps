<?php
   require 'inc/session.php';
   header('Content-Type: Application/json');
   
   // To fetch cards
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
     if (isset($_GET['id'])) {
       $id = (int)$_GET['id'];
      $sql = mysqli_query($connect, "SELECT * FROM services WHERE id ='{$id}'");
      $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
      $message = ["data" =>$data, "image_path"=>"http://localhost/teleow/dashboard/services_images"];
       echo json_encode($message);
     }else{

       $sql = mysqli_query($connect, "SELECT * FROM services");
       $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
           $message = ["data" =>$data, "image_path"=>"http://localhost/teleow/dashboard/services_images"];
            echo json_encode($message);
     }
}

?>