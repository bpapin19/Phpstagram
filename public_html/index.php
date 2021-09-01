<?php include('connect/connect.php'); ?>
<?php include('photo/add_like_and_comment.php'); ?>
<?php $activepage = "home"; ?>
<?php include('navbar/navbar.php'); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phpstagram - Home</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://phpstagram.000webhostapp.com/photo/photolayout.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://phpstagram.000webhostapp.com/navbar/navbar.css?v=<?php echo time(); ?>">
</head>
<main>
    <div class="container">
        <?php //Get user's images
            $get_feed = "SELECT * FROM `uploads` ORDER BY `id` DESC";
            $results = mysqli_query($conn, $get_feed);
        ?>
        <?php while ($row = mysqli_fetch_assoc($results)) { ?>
        <div class="photo-container">
            <div class="top-user-info">
                <?php $get_info = "SELECT `pfp` FROM `account_info` WHERE `username`='" . $row["username"] . "'";
                $result = mysqli_query($conn, $get_info);
                $pfp = mysqli_fetch_assoc($result)["pfp"];
                if ($pfp != "https://i.imgur.com/WhhtmKi.png") {
                    $profile_pic = "https://phpstagram.000webhostapp.com/profile/edit_profile/profile_pics/" . $pfp . "";
                } else {
                    $profile_pic = $pfp;
                } ?>
                <img class="top-pfp" src=<?php echo $profile_pic ?> alt="">
                <a href=<?php echo "https://phpstagram.000webhostapp.com/user_profile/user_profilelayout.php?username=" . $row["username"] . ""; ?>>
                	<div class="top-username"><?php echo $row["username"]; ?></div>
            	</a>
            </div>
            <div class="photo">
                <img src=<?php echo "https://phpstagram.000webhostapp.com/upload/uploads/" . $row["file"] . "" ?> class="photo" alt="">
            </div>
            <div class="metadata">
                <form class="like" action=<?php echo "https://phpstagram.000webhostapp.com/"; ?> method="post">
                    <button class="like-button" style=<?php echo "background-color:" . $row["like_button_color"] ?> name="like_button" value=<?php echo $row["id"]; ?>><i class="fa fa-heart"></i></button>
                    <button class="comment-button" type="submit" name="comment_button" value=<?php echo $row["id"]; ?>><i class="fa fa-comment"></i></button>
                </form>
                <div class="likes"> <?php echo $row["num_likes"] . " likes" ?></div>
                <a href=<?php echo "https://phpstagram.000webhostapp.com/user_profile/user_profilelayout.php?username=" . $row["username"]; ?>>
                	<div class="username"><?php echo $row["username"]; ?></div>
                </a>
                <span class="caption"><?php echo $row["caption"]; ?></span>
                <a href=<?php echo "https://phpstagram.000webhostapp.com/photo/photolayout.php?photo_id=" . $row["id"] . ""; ?>>
                    <div class="comments"> <?php echo "" . $row["num_comments"] . " comments" ?></div>
                </a>
                <?php if ($comment_btn_clicked == $row["id"]) { ?>
                <form class="comment" action=<?php echo "https://phpstagram.000webhostapp.com/"; ?> method="post">
                    <input class="comment-input" name="comment_input" type="text" placeholder="Add a comment"/>
                    <button class="post-button" name="post_button" value=<?php echo $row["id"]; ?>>Post</button>
                </form>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <!-- End of gallery -->
    </div>
    <!-- End of container -->
</main>
</html>