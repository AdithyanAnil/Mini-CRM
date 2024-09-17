<?php
include "connect.php";
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="delete from`customers` where cust_id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('location:update_cus.php');
    }else{
        die(mysqli_error($con));
    }
}
?>