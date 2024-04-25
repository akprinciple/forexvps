<?php require 'inc/config.php';
	if (isset($_GET['email']) && isset($_GET['token'])) {
		$sql = mysqli_query($connect, "UPDATE users SET status = 'Verified' WHERE email = '{$_GET['email']}' && token = '{$_GET['token']}'");
		if ($sql) {
			$query = mysqli_query($connect, "SELECT * FROM users WHERE email = '{$_GET['email']}' && token = '{$_GET['token']}'");
			$row = mysqli_fetch_array($query);
			$_SESSION['id'] = $row['id'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['password'] = $row['password'];
			$msg = 'Verification Successful';
		}else{
			$msg = 'Invalid Token!';

		}
	}else {
        $msg = 'Invalid Request!';
    }
    $message = ["msg" => $msg];
    echo json_encode($message);

 ?>