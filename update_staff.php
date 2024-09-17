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
include "connect.php";
?>
<?php
// Database connection (assumed to be established here)
 // Replace with your actual connection file

// Pagination variables
$records_per_page = 10; // Number of records per page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $records_per_page;

// Search query
$search_query = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Get total number of records (with search filter if provided)
$total_records_sql = "SELECT COUNT(*) FROM `users`";
if ($search_query) {
    $total_records_sql .= " WHERE ufname LIKE '%$search_query%' OR ulname LIKE '%$search_query%' OR username LIKE '%$search_query%' OR email LIKE '%$search_query%'";
}
$total_records_result = mysqli_query($conn, $total_records_sql);
$total_records_row = mysqli_fetch_array($total_records_result);
$total_records = $total_records_row[0];
$total_pages = ceil($total_records / $records_per_page);

// Fetch records for the current page (with search filter if provided)
$sql = "SELECT * FROM `users`";
if ($search_query) {
    $sql .= " WHERE ufname LIKE '%$search_query%' OR ulname LIKE '%$search_query%' OR username LIKE '%$search_query%' OR email LIKE '%$search_query%'";
}
$sql .= " LIMIT $offset, $records_per_page";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="ms-20 mt-4">
        <!-- Search Form -->
        <form action="" method="GET" class="mb-4">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search_query); ?>" placeholder="Search by name, username, or email" class="border border-gray-400 p-2 rounded">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Search</button>
        </form>
        
        <!-- Table -->
        <table class="table-auto border border-blue-500 mt-4">
            <thead>
                <tr class="border border-black border-2">
                    <th class="px-4 py-2 border border-black border-2">ID</th>
                    <th class="px-4 py-2 border border-black border-2">First Name</th>
                    <th class="px-4 py-2 border border-black border-2">Last Name</th>
                    <th class="px-4 py-2 border border-black border-2">Username</th>
                    <th class="px-4 py-2 border border-black border-2">Email</th>
                    <th class="px-4 py-2 border border-black border-2">Password</th>
                    <th class="px-4 py-2 border border-black border-2">Role</th>
                    <th class="px-4 py-2 border border-black border-2">Status</th>
                    <th class="px-4 py-2 border border-black border-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['uid'];
                        $fname = $row['ufname'];
                        $lname = $row['ulname'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $password = $row['password'];
                        $role = $row['role'];
                        $status = $row['status'];
                        echo '<tr>
                            <td class="border px-4 py-2 border border-black border-2">' . $id . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $fname . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $lname . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $username . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $email . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $password . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $role . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $status . '</td>
                            <td class="border px-4 py-2 border border-black border-2">
                                <a href="updat_staff.php?updateid=' . $id . '" class="hover:shadow-form rounded-md bg-[#6A64F1] py-2 px-4 text-base font-semibold text-white outline-none">Update</a>
                                <a href="delete_staff.php?deleteid=' . $id . '" class="hover:shadow-form rounded-md bg-red-500 py-2 px-4 text-base font-semibold text-white outline-none">Delete</a>
                            </td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="mt-4">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = $i == $current_page ? 'bg-blue-700' : 'bg-blue-500';
                echo '<a href="?page=' . $i . '&search=' . urlencode($search_query) . '" class="inline-block px-4 py-2 m-1 text-white ' . $active . ' rounded">' . $i . '</a>';
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>

    </div>
  </div>
</div>