<?php

session_start();

$errors = array();

include("../connect/connect.php");

$pic_id = $_POST['like_button'];
$pic_id2 = $_POST['post_button'];

$get_current_user = "SELECT `id` FROM `Users` WHERE `username`='". $_SESSION["username"] ."'";
$result2 = mysqli_query($conn, $get_current_user);
$current_user = mysqli_fetch_assoc($result2);
$current_user_id = strval($current_user["id"]);

if (isset($_POST['like_button'])) {
	if ($_SESSION["username"] != null) {
	    //get current likes
	    $liked_by_query = "SELECT `liked_by` FROM `uploads` WHERE `id`='". $pic_id ."'";
        $result = mysqli_query($conn, $liked_by_query);
        $liked_by = mysqli_fetch_assoc($result);
        $users_who_liked = $liked_by["liked_by"];
        
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
		header('location: https://phpstagram.000webhostapp.com/registration/login/loginform.php');
	}
}

$comment_btn_clicked = -1;

if (isset($_POST['comment_button'])) {
	if ($_SESSION["username"] != null) {
		$comment_btn_clicked = $_POST['comment_button'];
	} else {
		header('location: https://phpstagram.000webhostapp.com/registration/login/loginform.php');
	}
}

if (isset($_POST['post_button'])) {
	$comment_text = $_POST["comment_input"];
	$inc_num_comments = "UPDATE `uploads` SET `num_comments`=`num_comments`+1 WHERE `id`=?";
	$stmt = $conn->prepare($inc_num_comments);
	$stmt->bind_param("i", $pic_id2);
	$stmt->execute();
	
	$add_comment = "INSERT INTO `comments` (`photo_id`, `comment`, `username`)
                  VALUES (?, ?, ?)";
	$stmt = $conn->prepare($add_comment);
	$stmt->bind_param("iss", $pic_id2, $comment_text, $_SESSION["username"]);
	$stmt->execute();
}
?>