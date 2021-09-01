<?php include('edit.php'); ?>
<?php $activepage = "profile"; ?>
<?php include('../../navbar/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phpstagram - Edit Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../registration/registration.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../navbar/navbar.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="mainContainer">
        <div class="formContainer">
            <h1 class="header">Edit Profile</h1>
            <form action="editForm.php" method="post" enctype="multipart/form-data">
                <?php include('../../registration/errors.php'); ?>
                <div class="form-group row">
                    <label for="nameInput" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="col-sm-3" id="name" name="name" placeholder="<?php echo $name_ph ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passwordInput" class="col-sm-2 col-form-label">Bio:</label>
                    <div class="col-sm-10">
                        <input type="text" class="col-sm-3" id="bio" name="bio" placeholder="<?php echo $bio_ph ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="usernameInput" class="col-sm-2 col-form-label">New Profile Picture:</label>
                    <input class="col-sm-3" type="file" name="profilePicture" id="profilePicture" accept="image/*">
                </div>
                    <button type="submit" class="btn btn-primary" name="update_button">Update Profile</button>
            </form>
        </div>
    </div>
</body>
</html>