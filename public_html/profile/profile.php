<?php

session_start();

$errors = array();

include("../connect/connect.php");

//Get placeholders for form
$get_info = "SELECT * FROM `account_info` WHERE `username`='" . $_SESSION["username"] . "'";
$result = mysqli_query($conn, $get_info);
$placeholders = mysqli_fetch_assoc($result);

$name = $placeholders['name'];
$bio = $placeholders['bio'];
$pfp = $placeholders['pfp'];
$followers = $placeholders['num_followers'];
$following = $placeholders['num_following'];

if (isset($_POST['logout_button'])) {
	$_SESSION['username'] = null;
	$_SESSION['success'] = "Successfully logged out";
	$like_button_color = "transparent";
	$update_like_button_color = "UPDATE `uploads` SET `like_button_color`=?";
	$stmt = $conn->prepare($update_like_button_color);
	$stmt->bind_param("s", $like_button_color);
	$stmt->execute();
	header('location: /registration/login/loginform.php', true, 301);
}

//Get user's images
$get_uploads = "SELECT * FROM `uploads` WHERE `username`='" . $_SESSION["username"] . "'";
$result = mysqli_query($conn, $get_uploads);
$images = mysqli_fetch_assoc($result);
?>