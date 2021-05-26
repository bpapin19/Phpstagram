<?php include('upload.php'); ?>
<?php $activepage = "upload"; ?>
<?php include('../navbar/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phpstagram - Upload Photo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../registration/registration.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../navbar/navbar.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="mainContainer">
        <div class="formContainer">
            <h1 class="header">Upload Photo</h1>
            <form action="uploadform.php" method="post" enctype="multipart/form-data">
                <?php include('../registration/errors.php'); ?>
                <div class="form-group row">
                    <label for="caption" class="col-sm-2 col-form-label">Caption</label>
                    <div class="col-sm-10">
                        <input type="text" class="col-sm-3" id="caption" name="caption">
                    </div>
                </div>
                <div class="form-group row">
                    <input class="col-sm-3" type="file" name="fileToUpload" id="fileToUpload" accept="image/*" required>
                </div>
                    <button type="submit" class="btn btn-primary" name="upload_button">Upload</button>
            </form>
        </div>
    </div>
</body>
</html>