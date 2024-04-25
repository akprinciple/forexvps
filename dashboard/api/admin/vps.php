<?php
 require 'inc/session.php';
 header('Content-Type: Application/json');


//  To fetch vps

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
       $id = (int)$_GET['id'];
       $sql = mysqli_query($connect, "SELECT * FROM vps WHERE id = '{$id}'");
    $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $message = ["data" =>$data];
    echo json_encode($message); 
    }elseif (isset($_GET['dash'])) {
      $sql = mysqli_query($connect, "SELECT * FROM vps ORDER BY RAND() LIMIT 5");
   $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
   $message = ["data" =>$data];
   echo json_encode($message); 
   }
     else{

        $sql = mysqli_query($connect, "SELECT * FROM vps ORDER BY id DESC");
        $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);

        $message = ["data" =>$data];
         echo json_encode($message);
    }
    
    
         
    

}

// To add VPS
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
        $vps = mysqli_real_escape_string($connect, $_POST['vps']);
        $price = mysqli_real_escape_string($connect, $_POST['price']);
        $old_price = mysqli_real_escape_string($connect, $_POST['old_price']);
        $description = mysqli_real_escape_string($connect, $_POST['description']);
        $status = 'Active';
        
       if ($price <1) {
          $msg = 'Please enter a valid price!';
        }elseif(strlen($vps)<1){
          $msg  = 'VPS name cannot be empty';
        }
        else{
           $sel = mysqli_query($connect, "SELECT * FROM vps WHERE 
           vps ='$vps' && price = '$price'");
        if ($sel->num_rows>0){
           $msg = 'VPS Name is already existing';
        }else{
              $updated = mysqli_query($connect, "INSERT INTO vps(vps, price,old_price, 
              description, status) VALUES ('$vps', '$price', '$old_price', 
              '$description', '$status')");
              
              if ($updated) {
               $msg = 'VPS Successfully added';
              }else{
                     $msg = 'Error!';
                  }
               }
              }
            
              $message = ["msg" => $msg];
              echo json_encode($message);
}

// To update VPS
if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    
        // Read the raw input from the request
$rawData = file_get_contents("php://input");

// Decode the JSON data (assuming the data is in JSON format)
$patch = json_decode($rawData, true);

  if (array_key_exists('vps', $patch) && array_key_exists('price', $patch) 
  && array_key_exists('old_price', $patch) && array_key_exists('status', $patch)
&& array_key_exists('description', $patch)) {
   // To Update VPS
  $id = $_GET['id'];
  $vps = $patch['vps'];
  $description = mysqli_real_escape_string($connect, $patch['description']);

  $price = $patch['price'];
  $old_price = $patch['old_price'];
  $status = $patch['status'];

    $up = mysqli_query($connect, "UPDATE vps SET vps ='$vps', price = '$price', 
    description = '$description', status = '$status', old_price = '$old_price'
     WHERE id = '{$id}'");
    if ($up){
        $msg ='VPS successfully updated';
       
      } else{
        $msg ="Error!";
            }
}else{
    $msg ="Array key Error!";
        }
        $message = ["msg" => $msg];
        echo json_encode($message);  
    }

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM vps WHERE id = '{$id}'";
    $query = mysqli_query($connect, $sql);
    $msg = 'VPS successfully deleted';
    $message = ["msg" => $msg];
    echo json_encode($message);
  }