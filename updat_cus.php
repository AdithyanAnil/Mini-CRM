
<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />

<div class="bg-orange-100 min-h-screen">
  <div class="fixed bg-white text-blue-800 px-10 py-1 z-10 w-full">
      <div class="flex items-center justify-between py-2 text-5x1">
        <div class="font-bold text-blue-900 text-xl">Admin<span class="text-orange-600">Panel</span></div>
        <div class="flex items-center text-gray-500">
          <span class="material-icons-outlined p-2" style="font-size: 30px">search</span>
          <span class="material-icons-outlined p-2" style="font-size: 30px">notifications</span>
          <div class="bg-center bg-cover bg-no-repeat rounded-full inline-block h-12 w-12 ml-2" style="background-image: url(https://i.pinimg.com/564x/de/0f/3d/de0f3d06d2c6dbf29a888cf78e4c0323.jpg)"></div>
        </div>
    </div>
  </div>
  
  <div class="flex flex-row pt-24 px-10 pb-4">
    <div class="w-2/12 mr-6">
      <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
        
        <p class="bg-blue-600 w-full font-bold text-lg text-center text-white">Manage Staff</p>
        <a href="adduser.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">dashboard</span>
          Add Staff
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="view_staff.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">tune</span>
          Staff List
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="update_staff.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">file_copy</span>
          Update/Delete
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
      </div>

      <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
      <p class="bg-rose-600 w-full font-bold text-lg text-center text-white">Manage Customers</p>

        <a href="add_cus.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">face</span>
          Add Customer
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="view_cus.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">settings</span>
          View Customers
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="update_cus.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">tune</span>
          Update/Delete
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
      </div>

      <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
      <a href="" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">power_settings_new</span>
          Log out
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
    </div>
    </div>
    <div class="w-10/12">
    <?php
include 'connect.php';
$id=$_GET['updateid'];
$sql = "SELECT * FROM `customers` WHERE `cust_id` = $id";

$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
$cust_fname = $row['cust_fname'];
$cust_lname = $row['cust_lname'];
$cust_phone= $row['cust_phone'];
$cust_email = $row['cust_email'];
$cust_business = $row['cust_business'];
$b_address = $row['b_address'];
$b_industry = $row['b_industry'];
$state = $row['state'];
$country = $row['country'];
$zipcode = $row['zipcode'];

if (isset($_POST['submit'])) {
  $cust_fname = $_POST['cust_fname'];
  $cust_lname = $_POST['cust_lname'];
  $cust_phone= $_POST['cust_phone'];
  $cust_email = $_POST['cust_email'];
  $cust_business = $_POST['cust_business'];
  $b_address = $_POST['b_address'];
  $b_industry = $_POST['b_industry'];
  $state = $_POST['state'];
  $country = $_POST['country'];
  $zipcode = $_POST['zipcode'];

     echo $cust_fname.$cust_lname.$zipcode;
    $sql="update `customers` set cust_fname='$cust_fname',cust_lname='$cust_lname',cust_phone='$cust_phone',cust_email='$cust_email',cust_business='$cust_business',b_address='$b_address',b_industry='$b_industry',state='$state', country='$country', zipcode='$zipcode' where cust_id=$id";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header('location:update_cus.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

    // Close the statement


// Close the connection
$conn->close();
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 10px;
            border: 3px solid #fdba74;
            border-radius: 10px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], input[type="tel"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
    </style>
<div class="ms">
<div class="form-container" class="border border-orange-300 border-2" style="border-radius: 5px;">

<!-- <button  class="hover:shadow-form rounded-md bg-green-500 py-3 px-8 text-base font-semibold text-white outline-none"><a href="display.php">View List</a></button> -->
<form method="post">
            <div class="flex">
            <div class="form-group w-[49%]">
                <label for="cust_fname">First Name:</label>
                <input type="text" id="cust_fname" name="cust_fname" class="border border-orange-300 border-2" style="border-radius: 5px;" value=<?php echo $cust_fname; ?> required>
            </div>
            <div class="form-group w-[49%] ml-[5%]">
                <label for="cust_lname">Last Name:</label>
                <input type="text" id="cust_lname" name="cust_lname" class="border border-orange-300 border-2" style="border-radius: 5px;" value=<?php echo $cust_lname; ?> required>
            </div>
            </div>
            <!--||||||||||||||||||||||||||||||||||||||| -->

            <div class="flex">
            <div class="form-group w-[49%] ">
                <label for="cust_phone" >Phone Number:</label>
                <input type="tel" id="cust_phone" name="cust_phone" class="border border-orange-300 border-2" style="border-radius: 5px;" value=<?php echo $cust_phone; ?> required>
            </div>
            <div class="form-group w-[49%] ml-[5%]">
                <label for="cust_email">Email:</label>
                <input type="email" id="cust_email" name="cust_email" class="border border-orange-300 border-2" style="border-radius: 5px;" value=<?php echo $cust_email; ?> required>
            </div>
            </div>
            <!-- ||||||||||||||||||||||||||||||| -->
            
            

            <!-- |||||||||| -->
            <div class="flex">
            <div class="form-group w-[49%] ">
                <label for="cust_business">Business Name:</label>
                <input type="text" id="cust_business" name="cust_business" class="border border-orange-300 border-2" style="border-radius: 5px;" value=<?php echo $cust_business; ?> required>
            </div>
            <div class="form-group w-[49%] ml-[5%]">
                <label for="b_address">Business Address:</label>
                <input type="text" id="b_address" name="b_address" class="border border-orange-300 border-2" style="border-radius: 5px;" value=<?php echo $b_address; ?> required>
            </div>
            </div>
             <!-- |||||||||| -->
             <div class="flex">
             <div class="form-group w-[49%] ">
                <label for="b_industry">Business Industry:</label>
                <input type="text" id="b_industry" name="b_industry" class="border border-orange-300 border-2" style="border-radius: 5px;" value=<?php echo $b_industry; ?> required>
                </div>
            <div class="form-group w-[49%] ml-[5%]">
                <label for="state">State:</label>
                <input type="text" id="state" name="state"  class="border border-orange-300 border-2" style="border-radius: 5px;" value=<?php echo $state; ?> required>
            </div>
            </div>

             <!-- |||||||| -->
             <div class="flex">
             <div class="form-group w-[49%]">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" class="border border-orange-300 border-2" style="border-radius: 5px;" value=<?php echo $country; ?>
                 required>
            </div>
            <div class="form-group w-[49%] ml-[5%]">
                <label for="zipcode">Zipcode:</label>
                <input type="text" id="zipcode" name="zipcode" class="border border-orange-300 border-2" style="border-radius: 5px;" value=<?php echo $zipcode; ?>
                 required>
            </div>
            </div>
           <!-- |||||||| -->
            
            <button type="submit" name="submit" class="flex w-full justify-center rounded-md border border-transparent bg-blue-800 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">Update</button>
        </form>
        </div>
</div>
</body>

</html>
        
 
  
    </div>
  </div>
</div>






        
 
  