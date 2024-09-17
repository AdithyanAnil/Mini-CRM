



<?php

// Create a connection to the MariaDB database
$conn = new mysqli('localhost', 'root', '123456', 'crm1');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully";
}
?>