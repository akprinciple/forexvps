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
// To add Services
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['name']) && isset($_POST['description']) && isset($_FILES['image']['name'])) {
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $image = $_FILES['image']['name'];
      
    $sel = mysqli_query($connect, "SELECT * FROM services WHERE service_name ='{$name}'");
    
    if ($sel->num_rows>0){
      $msg = "Service already existing";
    }else{
    $tmp = $_FILES['image']['tmp_name'];
   $type = pathinfo("upload/$image", PATHINFO_EXTENSION);
if ($_FILES["image"]["size"] > 1000000) {
  $msg = "Sorry, your file size must be less than 1mb.";
      }
      elseif ($type != "JPG" && $type != "jpg"  && $type != "PNG" && $type != "png") {
        $msg = "Only jpg and png files are allowed";
          }
          else{
              $updated = mysqli_query($connect, "INSERT INTO services(service_name, service_image, service_description) VALUES ('$name', '$image', '$description')");
              if ($updated) {
                move_uploaded_file($tmp, "../services_images/$image");
            // header('location: teachers?teacher='.$name.'&&section='.$section.'&&success');
            $msg = "Service Successfully added";

                
              }

              else{
                $msg = "Error!";
              }
      

            }
          }
  }elseif(isset($_FILES['image']['name'])){
    $image = $_FILES['image']['name'];
    $id = (int)$_GET['id'];
    $app = mysqli_query($connect, "SELECT * FROM services WHERE id = '$id'");
          $row = mysqli_fetch_array($app);
          $old_image = $row['service_image'];
          
            $tmp = $_FILES['image']['tmp_name'];
           $type = pathinfo("upload/$image", PATHINFO_EXTENSION);
        if ($_FILES["image"]["size"] > 1000000) {
          $msg = "Sorry, your file size must be less than 1mb.";
              }
              elseif ($type != "JPG" && $type != "jpg"  && $type != "PNG" && $type != "png") {
                $msg = "Only jpg and png files are allowed";
                  }else{

                    if ($old_image != "") {
                      unlink("../services_images/$old_image");
                    }
                    $sel = mysqli_query($connect, "UPDATE services SET service_image ='$image' WHERE id = '$id'");
                    if ($sel){
                move_uploaded_file($tmp, "../services_images/$image");
                 $msg = "Service image successfully updated";
                } else{
                  $msg = "Error!!!";
                }
              }
            }
  else{
        $msg = "Array Key Error!";
      }
              

            
    $message = ["msg" => $msg];
    echo json_encode($message);
}
// To Update Services
if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
  
  // Read the raw input from the request
$rawData = file_get_contents("php://input");

// Decode the JSON data (assuming the data is in JSON format)
$patch = json_decode($rawData, true);

  if (array_key_exists('name', $patch) && array_key_exists('description', $patch)) {
   // To Update Service 
   
    $name = $patch['name'];
    $description = htmlspecialchars($patch['description']);
    $id = (int)$_GET['id'];
    
    $sql = mysqli_query($connect, "SELECT * FROM services WHERE service_name ='$name' && id !='{$id}'");
    if ($sql->num_rows>0){
      $msg = "Service Name already existing";
    }else{
    $sel = mysqli_query($connect, "UPDATE services SET service_name ='$name', service_description = '{$description}' WHERE id = '$id'");
    if ($sel){
       $msg = "Service name successfully updated";
      } else{
           $msg = "Error!!!";
            }
      
          }
     }
     else{
              $msg = "Array key Error!";
               }
         
           
        
     $message = ["msg" => $msg];
     echo json_encode($message);

}
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
  $id = (int)$_GET['id'];
  $app = mysqli_query($connect, "SELECT * FROM services WHERE id = '$id'");
        $row = mysqli_fetch_array($app);
        $image = $row['service_image'];
            if ($image != "") {
                unlink("../services_images/$image");
            }
  $sql = "DELETE FROM services WHERE id = '{$id}'";
  $query = mysqli_query($connect, $sql);
  $msg = 'Service successfully deleted';
  $message = ["msg" => $msg];
  echo json_encode($message);
}