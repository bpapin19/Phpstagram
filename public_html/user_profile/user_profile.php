<?php

$errors = array();

include("../connect/connect.php");

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

// if (isset($_POST['follow_button'])) {
//     echo "here";
//     header('location: user_profilelayout.php');
// }

?>