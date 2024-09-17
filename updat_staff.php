
    
    <div class="w-10/12">
    <?php
include 'connect.php';
$id=$_GET['updateid'];
$sql="Select * from `users` where uid=$id";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
$ufname = $row['ufname'];
$ulname = $row['ulname'];
$username = $row['username'];
$email = $row['email'];
$password = $row['password'];
$role = $row['role'];

if (isset($_POST['submit'])) {
    $ufname = $_POST['ufname'];
    $ulname = $_POST['ulname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Prepare the SQL statement
    $sql="update `users` set uid=$id,ufname='$ufname',ulname='$ulname',username='$username',email='$email',password='$password',role='$role' where uid=$id";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header('location:update_staff.php');
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
<div class="ms-20 mt-20">
<p class="font-bold text-3xl text-center">Staff List</p>

<!-- <button  class="hover:shadow-form rounded-md bg-green-500 py-3 px-8 text-base font-semibold text-white outline-none"><a href="display.php">View List</a></button> -->
<form class="w-full max-w-lg" method="post">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
      First Name 
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name='ufname' value=<?php echo $ufname; ?>>
      
    </div>

    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
      Last Name 
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name='ulname' value=<?php echo $ulname; ?>>
      
    </div>

    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
      Username 
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name='username' value=<?php echo $username; ?>>
      
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
        Email
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="email" name='email' value=<?php echo $email; ?>>
    </div>
  </div>
 
  <div class="flex flex-wrap -mx-3 mb-2">
  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
      Password 
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="password" name='password' value=<?php echo $password; ?>>
      
    </div>
    <?php
include 'connect.php';

// Fetch all results into an array
$sql = "SELECT id, role FROM roles";
$result = mysqli_query($conn, $sql);

// Check for query errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch results into an array
$roles = [];
while ($row = mysqli_fetch_assoc($result)) {
    $roles[] = $row;
}
?>

<div class="w-full md:w-1/2 px-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-role">
        Role
    </label>
    <select class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-role" name="role">
        <option value="">Select a role ↴</option>
        <?php
        // Iterate over the array using foreach
        foreach ($roles as $row) {
            $id = htmlspecialchars($row['id']); // Ensure safe output
            $role = htmlspecialchars($row['role']); // Ensure safe output
            echo "<option name='role' value=\"$role\">$role</option>";
        }
        ?>
    </select>
</div>

<?php
// Close the database connection
mysqli_close($conn);
?>


  </div>
</div>



    <!-- <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
        Age
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" name='age'>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Address
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="password" name='address'>
      
    </div> -->
  </div>
  </div>
  <button type="submit" name="submit" class="hover:shadow-form rounded-md bg-green-500 py-3 px-8 mx-20 text-base font-semibold text-white outline-none">Submit</button>
</form>
</div>
</body>

</html>
        
 
  
    </div>
  </div>
</div>






        
 
  