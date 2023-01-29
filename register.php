<?php
$user='nisipeanu';
$server='localhost';
$pass='2311';
$db='filshub';

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
        header("Location: foryou.php");
    }
    else{
        echo "Username or password is incorrect";
    }
}
?>