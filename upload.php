<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file type (assuming CSV for this example)
    if ($fileType != "csv") {
        echo "Sorry, only CSV files are allowed.";
        exit;
    }

    // Upload the file
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit;
    }

    // Proceed to read the file and insert into the database
    insertDataToDatabase($target_file);
}

function insertDataToDatabase($filePath) {
    // Establish a database connection
    $conn = new mysqli('localhost', 'root', '123456', 'crm1');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

    // Open the file for reading
    if (($handle = fopen($filePath, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Generate a random id
            $id = mt_rand(100000, 999999);  // Generates a random 6-digit number

            // Assuming the CSV has columns: fname, lname, phone, email, business, baddress, bindustry, state, country, zipcode
            $fname = $data[0];
            $lname = $data[1];
            $phone = $data[2];
            $email = $data[3];
            $business = $data[4];
            $baddress = $data[5];
            $bindustry = $data[6];
            $state = $data[7];
            $country = $data[8];
            $zipcode = $data[9];

            // Insert into the database
            $sql = "INSERT INTO customers (cust_id, cust_fname, cust_lname, cust_phone, cust_email, cust_business, b_address, b_industry, state, country, zipcode)
                    VALUES ('$id', '$fname', '$lname', '$phone', '$email', '$business', '$baddress', '$bindustry', '$state', '$country', '$zipcode')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully with ID: $id<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        fclose($handle);
    }

    $conn->close();
}
?>
