<!doctype html>
<html>
<head>
    <title>FilsHUB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="containerfp"> <!--This is the container for the first page-->
            <div class="register">
    <form action="" method="post">
    <!--<h1>Fils<a style="color:rgb(255,163,26);">HUB</a></h1>-->
    <img src="/resources/logo.png" alt="logo" style="width: 30vh; height: 10vh; ">
                <b><p>Engineering without boundaries.</p><b>
            <span><input type="text" name="username" placeholder="Username" style="margin-bottom: 5%;"></span>
        <br>
            <input type="password" name="password" placeholder="Password" >
        <br>
            <b><input type="submit" name="submitr" value="Sign up" style="margin-top: 5%;">
            <input type="submit" name="submitl" value="Sign in" style="margin-top: 5%;"></b>
            </form>
        </div>
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

if(isset($_POST['submitr'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $check="SELECT * FROM users WHERE username='$username'";
    $result=mysqli_query($conn,$check);
    if(mysqli_num_rows($result)>0){
        echo "Username already exists";
    }
    else{
        $sql="INSERT INTO users (username,password) VALUES ('$username','$password')";
        $result=mysqli_query($conn,$sql);
        if($result){
            echo "You have been registered";
        }
        else{
            echo "Error: ".$sql."<br>".mysqli_error($conn);
        }
    }
}
if(isset($_POST['submitl'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $check="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result=mysqli_query($conn,$check);
    if(mysqli_num_rows($result)>0){
        $_SESSION['username']=$username;
        header("Location: foryou.php");
    }
    else{
        echo "Username or password is incorrect";
    }
}
?>
    </div>
</body>
</html>