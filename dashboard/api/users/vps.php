<?php
 require 'inc/session.php';
 header('Content-Type: Application/json');


//  To fetch vps

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['id'])) {
     $id = (int)$_GET['id'];
     $sql = mysqli_query($connect, "SELECT * FROM vps WHERE id = '{$id}' && status ='Active'");
  $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
  $message = ["data" =>$data];
  echo json_encode($message); 
  }elseif (isset($_GET['vps'])) {
    $vps = $_GET['vps'];
    $sql = mysqli_query($connect, "SELECT * FROM vps WHERE vps = '{$vps}' && status ='Active'");
 $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
 $message = ["data" =>$data];
 echo json_encode($message); 
 }
  elseif (isset($_GET['dash'])) {
    $sql = mysqli_query($connect, "SELECT * FROM vps WHERE status ='Active' ORDER BY RAND() LIMIT 5");
 $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
 $message = ["data" =>$data];
 echo json_encode($message); 
 }
   else{

      $sql = mysqli_query($connect, "SELECT * FROM vps WHERE status ='Active' ORDER BY id DESC");
      $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);

      $message = ["data" =>$data];
       echo json_encode($message);
  }
  
  
       
  

}

