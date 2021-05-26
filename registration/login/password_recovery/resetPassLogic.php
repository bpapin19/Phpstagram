<?php 

session_start();
$errors = array();
$user_id = "";
// Set up DB Connection
$host = "mariadb";
$username = "cs431s8";
$password = "Ouphai7n";
$database = "cs431s8";

$conn = new mysqli($host, $username, $password, $database);

/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST["send_reset"])) {

  $email = $_POST["email"];

  // ensure that the user exists on our system
  $select_email = "SELECT `email` FROM `Users` WHERE `email`='$email'";
  $results = mysqli_query($conn, $select_email);

  if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sorry, no user exists with that email");
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));

  if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $reset_insert = "INSERT INTO `password_reset` (`email`, `token`) VALUES (?, ?)";
    $stmt = $conn->prepare($reset_insert);
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();

    // Send email to user with the token in a link they can click on
    $to = $email;
    $subject = "Reset your password on Phpstagram";
    $msg = "Hi there, click on this <a href=\"new_password.php?token=" . $token . "\">link</a> to reset your password on our site";
    $msg = wordwrap($msg,70);
    $headers = "From: info@instapic.com";
    if (mail($to, $subject, $msg, $headers)) {
      $_SESSION['mail'] = "success";
    } else {
      $_SESSION['mail'] = "fail";
    }
    header('location: pending.php?email=' . $email);
  }
}

// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
  $new_pass = $_POST['new_password'];
  $new_pass_c = $_POST['new_password_confirm'];

  // Grab to token that came from the email link
  $token = $_SESSION['token'];

  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
  if (count($errors) == 0) {
    // select email address of user from the password_reset table 
    $sql = "SELECT `email` FROM `password_reset` WHERE `token`=$token LIMIT 1";
    $results = mysqli_query($conn, $sql);
    $email = mysqli_fetch_assoc($results)['email'];

    if ($email) {
      $new_pass = md5($new_pass);
      $sql = "UPDATE 'Users' SET `password`=? WHERE `email`=?";
      $stmt = $conn->prepare($insert_query);
      $stmt->bind_param("ss", $password, $email);
      $stmt->execute();
      header('location: home.php');
    }
  }
}
?>