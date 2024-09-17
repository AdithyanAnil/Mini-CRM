<?php
include "connect.php";
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="delete from`users` where uid=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('location:update_staff.php');
    }else{
        die(mysqli_error($con));
    }
}
?>