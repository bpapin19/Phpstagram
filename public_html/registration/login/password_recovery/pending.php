<?php include('resetPassLogic.php'); ?>
<?php include('../../../navbar/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
	<link rel="stylesheet" href="../../registration.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="../../../navbar/navbar.css?v=<?php echo time(); ?>">
</head>
<body>

	<form class="pending">
		<p>
			We sent an email to  <b><?php echo $_GET['email'] ?></b> to help you recover your account. <?php echo $_SESSION['mail'] ?>
		</p>
	    <p>Please login into your email account and click on the link we sent to reset your password</p>
	</form>
		
</body>
</html>