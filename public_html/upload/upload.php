<?php

session_start();

$errors = array();

include("../connect/connect.php");

if (isset($_POST['upload_button'])) {
  // Load in variables from form fields
  $caption = $photo = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $caption = $_POST["caption"];
      $photo = $_FILES["fileToUpload"]["name"];
  }

  $dir = "uploads/";

  if (!file_exists($dir)) {
    if (!mkdir ($dir, 0777)) {
      array_push($errors, "Failed to make uploads directory");
    }
  }

  $liked_by = "";
  $num_likes = 0;
  $num_comments = 0;
  $like_color = "transparent";

  if (count($errors) == 0) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $dir . $photo)) {
      $upload_photo = "INSERT INTO `uploads` (`username`, `caption`, `file`, `liked_by`, `num_likes`, `num_comments`, `like_button_color`)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($upload_photo);
	  $stmt->bind_param("ssssiis", $_SESSION["username"], $caption, $photo, $liked_by, $num_likes, $num_comments, $like_color);
      if ($stmt->execute()) {
        $_SESSION['success'] = "Photo successfully uploaded";
        header('location: ../profile/profilelayout.php');
      } else {
        array_push($errors, "Invalid caption or file type");
      }
    } else {
      array_push($errors, "Failed to upload file");
    }
  }
}

?>