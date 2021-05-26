<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="navbar.css?v=<?php echo time(); ?>">
</head>
<body>
	<div class="topnav">
	  <a href="/~cs431s8/Project/home/homelayout.php" <?php if($activepage=="home") { ?> class="active" <?php } ?>><i class="fa fa-home"></i></a>
	  <?php if ($_SESSION['username'] != null) { ?>
	  <a href="/~cs431s8/Project/profile/profilelayout.php" <?php if($activepage=="profile") { ?> class="active" <?php } ?>><i class="fa fa-user"></i></a>
	  <a href="/~cs431s8/Project/upload/uploadform.php" <?php if($activepage=="upload") { ?> class="active" <?php } ?>><i class="fa fa-upload"></i></a>
	  <?php } ?>
	  <a class="title" href="/~cs431s8/Project/home/homelayout.php">
	  	<img class="logo" src="/~cs431s8/Project/navbar/phpstagram.png" alt="">
	  </a>
	  <div class="topnav-right">
	  	<?php if ($_SESSION['username'] != null) {
	  	$get_info = "SELECT `pfp` FROM `account_info` WHERE `username`='" . $_SESSION["username"] . "'";
		$result = mysqli_query($conn, $get_info);
		$pfp_ = mysqli_fetch_assoc($result)["pfp"];
		if ($pfp_ != "https://i.imgur.com/WhhtmKi.png") {
			$profile_pic = "/~cs431s8/Project/profile/edit_profile/profile_pics/" . $pfp_ . "";
		} else {
			$profile_pic = $pfp_;
		}
		?>
		<a class="pic" href="/~cs431s8/Project/profile/profilelayout.php">
	  		<img class="nav-image" src=<?php echo $profile_pic ?> alt="">
	  		<div class="nav-username"><?php echo $_SESSION['username'] ?></div>
	  	</a>
	  	<?php } else { ?>
		  <a href="/~cs431s8/Project/registration/signup/signupform.php" <?php if($activepage=="signupform") { ?> class="active" <?php } ?>>Register</a>
		  <a href="/~cs431s8/Project/registration/login/loginform.php" <?php if($activepage=="loginform") { ?> class="active" <?php } ?>>Login</a>
		 <?php } ?>
	  </div>
	</div>
</body>
</html>