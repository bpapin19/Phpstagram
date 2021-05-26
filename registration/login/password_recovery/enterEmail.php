<?php include('resetPassLogic.php'); ?>
<?php include('../../../navbar/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../registration.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../../navbar/navbar.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="mainContainer">
        <div class="formContainer">
            <h1 class="header">Password Reset</h1>
            <?php include('../../errors.php'); ?>
            <form action="enterEmail.php" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="emailInput" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="col-sm-3" id="email" name="email" required>
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary" name="send_reset">Send Reset Email</button>
            </form>
        </div>
    </div>
</body>
</html>