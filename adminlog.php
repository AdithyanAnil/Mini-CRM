<?php
session_start();
include "connect.php";

$username=$_POST['username'];
$password=$_POST['password'];
$sql="select * from admin where username='$username' AND password='$password'";
$result=$conn->query($sql);

if(!$row=$result->fetch_assoc()){
    header("Location:index.php");
}else{
    $_SESSION['name']=$_POST['username'];
    header("Location:admin_dash.php");
}
?>