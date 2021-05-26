<?php

$errors = array();

// Set up DB Connection
$host = "mariadb";
$username = "cs431s8";
$password = "Ouphai7n";
$database = "cs431s8";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_errorno) {
  array_push($errors, "connection failed: " . $conn->connect_error);
}

$username = $_GET['username'];

//Get placeholders for form
$get_info = "SELECT * FROM `account_info` WHERE `username`='" . $username . "'";
$result = mysqli_query($conn, $get_info);
$acc_info = mysqli_fetch_assoc($result);

$name = $acc_info['name'];
$bio = $acc_info['bio'];
$pfp = $acc_info['pfp'];
$followers = $acc_info['num_followers'];
$following = $acc_info['num_following'];

//Get user's images
$get_uploads = "SELECT * FROM `uploads` WHERE `username`='" . $username . "'";
$result = mysqli_query($conn, $get_uploads);
$images = mysqli_fetch_assoc($result);



?>