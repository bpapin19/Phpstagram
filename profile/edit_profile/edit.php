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

//Get placeholders for form
$get_placeholders = "SELECT * FROM `account_info` WHERE `username`='" . $_SESSION["username"] . "'";
$result = mysqli_query($conn, $get_placeholders);
$placeholders = mysqli_fetch_assoc($result);

$name_ph = $placeholders['name'];
$bio_ph = $placeholders['bio'];

// Checks if signup button was clicked
if (isset($_POST['update_button'])) {

  // Load in variables from form fields
  $name = $bio = $pfp = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST["name"];
      $bio = $_POST["bio"];
      $pfp = $_FILES["profilePicture"]["name"];
  }

  if (count($errors) == 0) {

    if (($name != null)) {
      $update_name = "UPDATE `account_info` SET `name`=? WHERE `username`=?";
      $stmt = $conn->prepare($update_name);
      $stmt->bind_param("ss", $name, $_SESSION["username"]);
      if ($stmt->execute()) {
        $_SESSION['success'] = "Name successfully updated";
        header('location: /~cs431s8/Project/profile/profilelayout.php');
      }
    }

    if ($bio != null) {
      $update_bio = "UPDATE `account_info` SET `bio`=? WHERE `username`=?";
      $stmt = $conn->prepare($update_bio);
      $stmt->bind_param("ss", $bio, $_SESSION["username"]);
      if ($stmt->execute()) {
        $_SESSION['success'] = "Bio successfully updated";
        header('location: /~cs431s8/Project/profile/profilelayout.php');
      }
    }

    if ($pfp != null) {
      $dir = "profile_pics/";
      if (!file_exists($dir)) {
        if (!mkdir ($dir, 0777)) {
          array_push($errors, "Failed to make uploads directory");
        }
      } else {
        if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $dir . $pfp)) {
          $upload_photo = "UPDATE `account_info` SET `pfp`=? WHERE `username`=?";
          $stmt = $conn->prepare($upload_photo);
          $stmt->bind_param("ss", $pfp, $_SESSION["username"]);
          if ($stmt->execute()) {
            $_SESSION['success'] = "Profile picture successfully updated";
            header('location: /~cs431s8/Project/profile/profilelayout.php');
          } else {
            array_push($errors, "Invalid caption or file type");
          }
        } else {
          array_push($errors, "Failed to upload file");
        }
      }
    }
  }
}
?>