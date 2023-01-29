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
        <!--Here is the main page where the creation starts, here i implement i system for the posts like facebook(forum)-->
        <div class="wpost">
        <h1>Hi <?php echo $_SESSION['username']; ?>, Write your post</h1>
            <div class="cpost">
       <form action="" method="post">
            <input type="text" name="messagepst" placeholder="Write your message here"/>
            <input type="submit" name="submitpst" value="Post"/> 
        </form>
        </div>
        </div>
       <?php
       // Send the form data to the database in the table posts
         if(isset($_POST['submitpst'])){
              $messagepst = $_POST['messagepst'];
              $username = $_SESSION['username'];
                $sql = "INSERT INTO posts (PosterUsername, text) VALUES ('$username', '$messagepst')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: foryou.php");
                }else{
                    echo "Post not created";
                }
            }

        ?>
    </body>
</html>
