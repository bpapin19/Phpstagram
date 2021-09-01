<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../registration.css">
</head>
<body>
    <div class="mainContainer">
        <div class="formContainer">
            <h1 class="header">New Password</h1>
            <?php include('../errors.php'); ?>
            <form action="enterEmail.php" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="emailInput" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="col-sm-3" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="emailInput" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="col-sm-3" id="new_password_confirm" name="new_password_confirm" required>
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary" name="new_password">Set Password</button>
            </form>
        </div>
    </div>
</body>
</html>