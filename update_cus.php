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
$total_records_sql = "SELECT COUNT(*) FROM `customers`";
if ($search_query) {
    $total_records_sql .=  " WHERE cust_fname LIKE '%$search_query%' OR cust_lname LIKE '%$search_query%' OR cust_business LIKE '%$search_query%' OR cust_email LIKE '%$search_query%'";
}
$total_records_result = mysqli_query($conn, $total_records_sql);
$total_records_row = mysqli_fetch_array($total_records_result);
$total_records = $total_records_row[0];
$total_pages = ceil($total_records / $records_per_page);

// Fetch records for the current page (with search filter if provided)
$sql = "SELECT * FROM `customers`";
if ($search_query) {
    $sql .= " WHERE cust_fname LIKE '%$search_query%' OR cust_lname LIKE '%$search_query%' OR cust_business LIKE '%$search_query%' OR cust_email LIKE '%$search_query%'";
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
    <div class="ms-2 mt-4">
    <p class="font-bold text-3xl text-center">Action</p>

        <!-- Search Form -->
        <form action="" method="GET" class="mb-4">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search_query); ?>" placeholder="Search by name, username, or email" class="border border-gray-400 p-2 rounded">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Search</button>
        </form>
        
        <!-- Table -->
        <table class="table-auto border border-blue-500 mt-4">
            <thead>
                <tr class="border border-black border-2">
                <th class="px-4 py-2 border border-black border-2" style="width: 20px;">ID</th>
                    <th class="px-4 py-2 border border-black border-2" style="width: 100px;">First Name</th>
                    <th class="px-4 py-2 border border-black border-2" style="width: 100px;">Last Name</th>
                    <th class="px-4 py-2 border border-black border-2" style="width: 100px;">Phone</th>
                    <th class="px-4 py-2 border border-black border-2" style="width: 400px;">Email</th>
                    <th class="px-4 py-2 border border-black border-2" style="width: 40px;">Business</th>
                    <th class="px-4 py-2 border border-black border-2" style="width: 40px;">Business <br>address</th>
                    <th class="px-4 py-2 border border-black border-2" style="width: 40px;">Industry</th>
                    <th class="px-4 py-2 border border-black border-2" style="width: 40px;">State</th>
                    <th class="px-4 py-2 border border-black border-2" style="width: 40px;">Country</th>
                    <th class="px-4 py-2 border border-black border-2" style="width: 40px;">Zipcode</th>
                    <th class="px-4 py-2 border border-black border-2" style="width: 880px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['cust_id'];
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
                        echo '<tr>
                            <td class="border px-4 py-2 border border-black border-2">' . $id . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $cust_fname . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $cust_lname . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $cust_phone . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $cust_email . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $cust_business . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $b_address . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $b_industry . '</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $state .'</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $country.'</td>
                            <td class="border px-4 py-2 border border-black border-2">' . $zipcode.'</td>
                               
                                <div class="inline-flex items-center rounded-md shadow-sm">
    <td>
                                <a href="updat_cus.php?updateid=' . $id . '"
        class="text-slate-800 hover:text-blue-600 text-sm bg-green-500 hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.1"
    stroke="white" class="w-6 h-6">
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
</svg>

        </span>
        
    </a>
    
    <a href="delete_cus.php?deleteid=' . $id . '"
        class="text-slate-800 hover:text-blue-600 text-sm bg-red-500 hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="white" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
        </span>
       
    </a>
</div>
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