<!--  -->

<!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->

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
        <a href="update_staff" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">file_copy</span>
          Update/Delete
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
      </div>

      <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
      <p class="bg-rose-600 w-full font-bold text-lg text-center text-white">Manage Customers</p>

        <a href="add_cus" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">face</span>
          Add Customer
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="view_cus.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">settings</span>
          View Customer
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

if (isset($_POST['submit'])) {
    $ufname = $_POST['ufname'];
    $ulname = $_POST['ulname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Prepare the SQL statement
    $sql = "INSERT INTO users (ufname, ulname, username, email, password, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters to the SQL query
    $stmt->bind_param("ssssss", $ufname, $ulname, $username, $email, $password, $role);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: adduser.php');
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

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
<p class="font-bold text-3xl text-center">Add Staff</p>

<div class="flex justify-center mt-16">

<!-- <button  class="hover:shadow-form rounded-md bg-green-500 py-3 px-8 text-base font-semibold text-white outline-none"><a href="display.php">View List</a></button> -->
<form class="w-full max-w-lg " method="post">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
      First Name 
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name='ufname'>
      
    </div>

    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
      Last Name 
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name='ulname'>
      
    </div>

    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
      Username 
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name='username'>
      
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
        Email
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="email" name='email'>
    </div>
  </div>
 
  <div class="flex flex-wrap -mx-3 mb-2">
  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
      Password 
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="password" name='password'>
      
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
  <button type="submit" name="submit" class="hover:shadow-form rounded-md bg-green-500 py-3 px-8 mx-20 text-base font-semibold text-white outline-none w-96 h-12">Submit</button>

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
</form>
</div>
</div>
</body>

</html>
        
 
  
    </div>
  </div>
</div>






        
 
  