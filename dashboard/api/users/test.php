<?php

require '../inc/config.php'; 
require "../inc/email.php";

$date = date('Y/M/d h:i:sa');
mysqli_query($connect, "UPDATE services SET date = '{$date}'");