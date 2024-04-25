<?php 
  session_start();
  include('../inc/config.php');
  if (getallheaders()!=='') {
    $all = getallheaders();
if (isset($all['user_id'])&&isset($all['email']) && isset($all['token']) ) {
  $login_date = $all['login_date'];
  $user_check = $all['user_id'];
  $user_email = $all['email'];
  $token = $all['token'];
}else{
  $message = ["status"=> 500, "msg" => "Please log in!"];
    echo json_encode($message);
  die();

}
  
  }else{
    $message = ["status"=> 501, "msg" => "Please log in!"];
    echo json_encode($message);
    die();
  }
  

  $date = date('Y-m-d');
  $today = date_create($date);
  $signInDate = date_create($login_date);
  $diff = date_diff($signInDate, $today);
  $session_expiry_date = $diff->format("%R%a");


  $ses_sql = mysqli_query($connect, "SELECT * FROM users WHERE id = '$user_check' 
  && email = '$user_email' && token = '$token' && level = 'admin'");
  $ses_row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
  $login_id = $ses_row['id'];
  $ses_count = mysqli_num_rows($ses_sql);
  if (!isset($login_id)) {
    $message = ["status"=> 502, "msg" => "Please log in!"];
    echo json_encode($message);
    die();

  }
  if ($ses_row['status']=="Unverified") {
    $message = ["status"=> 503, "msg" => "Please verify your account!"];
echo json_encode($message);
    
    die();
    
   }
  elseif($session_expiry_date >1){
    $message = ["status"=> 504, "msg" => "Session Expired! Please log in again."];
    echo json_encode($message);
        die();
    }
    elseif ($ses_count < 1) {
      $message = ["status"=> 505, "msg" => "Session Expired! Please log in again."];
      echo json_encode($message);
          die();
   
    }elseif ($ses_row['status']=="Blocked") {
      $message = ["status"=> 506, "msg" => "You don't have access to this page. Contact the administrator for assistance."];
      echo json_encode($message);
          die();
      }
  $_SESSION['id'] = $ses_row['id'];
  $_SESSION['firstname'] = $ses_row['firstname'];
  $_SESSION['lastname'] = $ses_row['lastname'];
//   $_SESSION[''] = $ses_row[''];
?>