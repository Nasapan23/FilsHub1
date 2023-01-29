<!doctype html>
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
    <?php 
    $sql="SELECT * FROM posts where PostId = '$_GET[postid]'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $username=$row['PosterUsername'];
    $text=$row['text'];
    echo '
    <div class="postpage">
        <div class="postheader">
            <img src="/resources/basicprofile.jpg" alt="minilogo" width="50" height="50">
            <h1>'.$username.'</h1>
        </div>
        <div class="postbody">
            <p>'.$text.'</p>
        </div>
    ';

    $comments_sql = "SELECT * FROM comments WHERE PostId = '$_GET[postid]'";
    $comments_result = mysqli_query($conn, $comments_sql);
    echo '
    <div class="postfooter">
            <h1>Comments:</h1>
    ';
    while($comments_row = mysqli_fetch_array($comments_result)){
        $comment = $comments_row['comment'];
        $commenter = $comments_row['commenter'];
        echo '
            <p>'.$commenter.': '.$comment.'</p>
        ';
    }
    echo '
    </div>
        <div class="postcommenting">
            <form action="" method="post">
                <input type="text" name="comment" placeholder="Comment">
                <br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
    ';
    if(isset($_POST['submit'])){
        $comment = $_POST['comment'];
        $commenter = $_SESSION['username'];
        $sql = "INSERT INTO comments (comment, commenter, PostId) VALUES ('$comment', '$commenter', '$_GET[postid]')";
        $result = mysqli_query($conn, $sql);
        if($result){
         header("Location: post.php?postid=$_GET[postid]");
        }
        else{
            echo "There was an error";
        }
    }
    ?>
</body>
</html>