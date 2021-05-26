<?php include('profile.php'); ?>
<?php $activepage = "profile"; ?>
<?php include('../navbar/navbar.php'); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phpstagram - Profile</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../navbar/navbar.css?v=<?php echo time(); ?>">
</head>
<header>
    <div class="container">
        <div class="profile">
            <div class="profile-image">
                <?php if ($pfp != "https://i.imgur.com/WhhtmKi.png") { ?>
                <img src=<?php echo "/~cs431s8/Project/profile/edit_profile/profile_pics/" . $pfp . "" ?> alt="">
                <?php } else { ?>
                <img src=<?php echo "" . $pfp . "" ?> alt="">
                <?php } ?>
            </div>
            <div class="profile-user-settings">
                <h1 class="profile-user-name"><?php echo $_SESSION['username'] ?></h1>
                <button class="btn profile-edit-btn" onClick="document.location.href='/~cs431s8/Project/profile/edit_profile/editForm.php'">Edit Profile</button>
                <form class="logout" action="profile.php" method="post">
                    <button class="btn profile-edit-btn" type="submit" name="logout_button">Log Out</button>
                </form>
            </div>
            <div class="profile-stats">
                <ul>
                    <?php //Get user's images
                    $get_uploads = "SELECT * FROM `uploads` WHERE `username`='" . $_SESSION["username"] . "' ORDER BY `id` DESC";
                    $result = mysqli_query($conn, $get_uploads);
                    ?>
                    <li><span class="profile-stat-count"><?php echo $result->num_rows ?></span> posts</li>
                    <li><span class="profile-stat-count"><?php echo $followers ?></span> followers</li>
                    <li><span class="profile-stat-count"><?php echo $following ?></span> following</li>
                </ul>
            </div>
            <div class="profile-bio">
                <p><span class="profile-real-name"><?php echo $name ?></span> <?php echo $bio ?></p>
            </div>
        </div>
        <!-- End of profile section -->
    </div>
    <!-- End of container -->
</header>
<main>
    <?php if ($result->num_rows == 0) { ?>
    <div class="no-posts">
        <i class="fas fa-camera-retro fa-3x"></i>
        <p>
            You don't have any posts yet. <br/> Add a post with the Upload Photo tab.
        </p>
    </div>
    <?php } ?>
    <div class="container">
        <div class="gallery">
            <?php //Get user's images
            while ($image = mysqli_fetch_assoc($result)) { ?>
            <a href=<?php echo "/~cs431s8/Project/photo/photolayout.php?photo_id=" . $image["id"] . "" ?>>
                <div class="gallery-item" tabindex="0">
                    <img src=<?php echo "/~cs431s8/Project/upload/uploads/" . $image["file"] . "" ?> class="gallery-image" alt="">
                    <div class="gallery-item-info">
                        <ul>
                            <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i><?php echo $image["num_likes"] ?></li>
                            <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i><?php echo $image["num_comments"] ?></li>
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </a>
        </div>
        <!-- End of gallery -->
    </div>
    <!-- End of container -->
</main>
</html>