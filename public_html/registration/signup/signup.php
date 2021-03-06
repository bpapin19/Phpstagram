<?php

session_start();

$errors = array();

include("../../connect/connect.php");

// Checks if signup button was clicked
if (isset($_POST['signup_button'])) {

  // Load in variables from form fields
  $username = $email = $password = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $confirm_password = $_POST["confirm_password"];
  }

  if ($password != $confirm_password) {
    array_push($errors, "Two passwords do not match");
  }

  $user_check_query = "SELECT * FROM `Users` WHERE `username`='$username' OR `email`='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] == $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] == $email) {
      array_push($errors, "Email already exists");
    }
  }

  if (count($errors) == 0) {
      $password = md5($password);//encrypt the password before saving in the database

      $insert_query = "INSERT INTO `Users` (`username`, `email`, `password`)
                  VALUES (?, ?, ?)";
      $stmt = $conn->prepare($insert_query);
      $stmt->bind_param("sss", $username, $email, $password);
      $stmt->execute();
      $_SESSION['username'] = $username;

      // Insert sample data into account info table
      $account_sample_insert = "INSERT INTO `account_info` (`name`, `bio`, `username`, `pfp`, `num_followers`, `num_following`) VALUES ('Your Name', 'Say something about yourself','" . $username . "', 'https://i.imgur.com/WhhtmKi.png', 0, 0)";
      mysqli_query($conn, $account_sample_insert);

      $_SESSION['success'] = "You are now logged in";
      header('location: ../../index.php');
      exit();
  }
}
?>