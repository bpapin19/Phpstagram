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

  if (count($errors) == 0) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $dir . $photo)) {
      $upload_photo = "INSERT INTO `uploads` (`username`, `caption`, `file`, `liked_by`)
                    VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($upload_photo);
      $stmt->bind_param("ssss", $_SESSION["username"], $caption, $photo, $liked_by);
      if ($stmt->execute()) {
        $_SESSION['success'] = "Photo successfully uploaded";
        header('location: /~cs431s8/Project/profile/profilelayout.php');
      } else {
        array_push($errors, "Invalid caption or file type");
      }
    } else {
      array_push($errors, "Failed to upload file");
    }
  }
}

?>