<?php include('signup.php'); ?>
<?php $activepage = "signupform"; ?>
<?php include('../../navbar/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../registration.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../navbar/navbar.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="mainContainer">
        <div class="formContainer">
            <h1 class="header">Sign Up</h1>
            <form action="signupform.php" method="post" enctype="multipart/form-data">
                <?php include('../errors.php'); ?>
                <div class="form-group row">
                    <label for="usernameInput" class="col-sm-2 col-form-label">Username:</label>
                    <div class="col-sm-10">
                        <input type="text" class="col-sm-3" id="username" pattern="^[a-zA-Z0-9_]*$" name="username" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="emailInput" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="col-sm-3" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passwordInput" class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="col-sm-3" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passwordInput" class="col-sm-2 col-form-label">Confirm Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="col-sm-3" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary" name="signup_button">Sign Up</button>
            </form>
            <div class="login-link">Already have an account? <a href="../login/loginform.php" name="forgotPassword">Log In</a></div>
        </div>
    </div>
</body>
</html>