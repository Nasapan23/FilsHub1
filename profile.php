<!doctype html>
<?php
            session_start();
            if(!isset($_SESSION['username']))
            {
                header("Location: index.php");
            }
            if(isset($_POST['logout'])){
                session_destroy();
                header("Location: index.php");
            }
            ?>
<html>
    <head>
        <title>FilsHUB</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="topnav">
        <img src="/resources/minilogo.png" alt="minilogo" width="50" height="50">
        <b><a class="active" href="foryou.php">Home</a>
        <a href="pcreation.php">Create a post</a>
        <a href="profile.php">Profile</a></b>
        <div class="logout">
        <form action="" method="post">
        <input type="submit" name="logout" value="LOG OUT">
        </form>
            </div>
        </div> 
    </div>
    <div class="sprofile">
        <h1>Hello, <?php echo $_SESSION['username']; ?> THIS PART OF THE WEBSITE IS UNDER DEVELOPMENT</h1>
</body>
</html>