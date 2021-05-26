<?php include('login.php'); ?>
<?php $activepage = "loginform"; ?>
<?php include('../../navbar/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phpstagram - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../registration.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../navbar/navbar.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="mainContainer">
        <div class="formContainer">
            <h1 class="header">Login</h1>
            <form action="loginform.php" method="post" enctype="multipart/form-data">
                <?php include('../errors.php'); ?>
                <div class="form-group row">
                    <label for="emailInput" class="col-sm-2 col-form-label">Email or Username:</label>
                    <div class="col-sm-10">
                        <input type="text" class="col-sm-3" id="user_id" name="user_id" pattern="^[a-zA-Z0-9_]*$" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passwordInput" class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="col-sm-3" id="password" name="password" required>
                    </div>
                </div>
                    <button onclick="login()" type="submit" class="btn btn-primary" name="login_button">Login</button>
            </form>
            <p class="forgot-password"><a href="password_recovery/enterEmail.php" name="forgotPassword">Forgot Password?</a></p>
            <div>Need an account? <a href="../signup/signupform.php" name="forgotPassword">Sign Up</a></div>
        </div>
    </div>
</body>
</html>