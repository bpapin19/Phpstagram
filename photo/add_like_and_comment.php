<?php

session_start();

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

$pic_id = $_POST['like_button'];

// Store id's of users who liked the photo in a string

$liked_by_query = "SELECT `liked_by` FROM `uploads` WHERE `id`='". $pic_id ."'";
$result = mysqli_query($conn, $liked_by_query);
$liked_by = mysqli_fetch_assoc($result);
$users_who_liked = $liked_by["liked_by"];

$get_current_user = "SELECT `id` FROM `Users` WHERE `username`='". $_SESSION["username"] ."'";
$result2 = mysqli_query($conn, $get_current_user);
$current_user = mysqli_fetch_assoc($result2);
$current_user_id = strval($current_user["id"]);

if (isset($_POST['like_button'])) {
	if ($_SESSION["username"] != null) {

		// if user hasnt liked pic, like pic
		if (strpos($users_who_liked, $current_user_id) == false) {
			$like_button_color = "#e32424";
			$new_liked_by_string = $users_who_liked . " " . $current_user_id;
			$add_like = "UPDATE `uploads` SET `num_likes`=`num_likes`+1, `liked_by`=?, `like_button_color`=? WHERE `id`=?";
			$stmt = $conn->prepare($add_like);
			$stmt->bind_param("sss", $new_liked_by_string, $like_button_color, $pic_id);
			$stmt->execute();
		// if user has liked pic, remove like
		} else {
			$like_button_color = "transparent";
			$removed_like_from_string = str_replace($users_who_liked, "", $current_user_id);
			$remove_like = "UPDATE `uploads` SET `num_likes`=`num_likes`-1, `liked_by`=?, `like_button_color`=? WHERE `id`=?";
			$stmt = $conn->prepare($remove_like);
			$stmt->bind_param("sss", $removed_like_string, $like_button_color, $pic_id);
			$stmt->execute();
		}
	} else {
		header('location: /~cs431s8/Project/registration/login/loginform.php');
	}
}
?>