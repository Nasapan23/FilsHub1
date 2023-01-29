<!doctype html>
<html>
<head>
<?php
$user='nisipeanu';
$server='localhost';
$pass='2311';
$db='filshub';
session_start();
$conn=mysqli_connect($server,$user,$pass,$db);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
            if(!isset($_SESSION['username']))
            {
                header("Location: index.php");
            }
            if(isset($_POST['logout'])){
                session_destroy();
                header("Location: index.php");
            }
?>
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
    <?php 
    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: index.php");
    }
    ?>
    <!--Here is the main page where the post starts-->
        <!-- create a div that has a profile image a username and a post-->
        <?php 
        $querry = "SELECT * FROM posts ORDER BY PostId DESC";
        $result = mysqli_query($conn, $querry);
        while($row = mysqli_fetch_array($result)){
            $username = $row['PosterUsername'];
            $text = $row['text'];
            $id = $row['PostId'];
            $querry2 = "SELECT * FROM users WHERE username = '$username'";
            $result2 = mysqli_query($conn, $querry2);
            $row2 = mysqli_fetch_array($result2);
            $profileimage = $row2['profileimage'];
            echo '
            <div class="foryou">
            <div class="postborder">
            <div class="post">
            <img src="/resources/basicprofile.jpg" alt="profile" width="50" height="50">
            <a href="profile.php">'.$username.'</a>
        </div>
        <div class="posttext">
            <p style="margin:1vh">'.$text.'</p>
            </p>
            </div>
            <div class="comment">
                <a href="post.php?postid='.$id.'">Comments</a>
            </div>
    </div>
    </div>
            ';
        }


?>
</body>
</html>
