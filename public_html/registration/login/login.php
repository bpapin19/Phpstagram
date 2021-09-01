<?php

session_start();

$errors = array();

include("../../connect/connect.php");

if (isset($_POST['login_button'])) {
  // Load in variables from form fields
  $email = $password = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $user_id = $_POST["user_id"];
      $password = $_POST["password"];
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $login_user = "SELECT * FROM `Users` WHERE `email`=? OR `username`=? AND `password`=?";
    $stmt = $conn->prepare($login_user);
    $stmt->bind_param("sss", $user_id, $user_id, $password);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
      $get_username = "SELECT `username` FROM `Users` WHERE `email`='$user_id' OR `username`='$user_id'";
      $app_username = $conn -> query($get_username);
      $_SESSION['username'] = mysqli_fetch_row($app_username)[0];
      $_SESSION['success'] = "You are now logged in";
      header('Location: https://phpstagram.000webhostapp.com/', true, 301);
    } else {
      array_push($errors, "Invalid username or password");
    }
  }
}

?>