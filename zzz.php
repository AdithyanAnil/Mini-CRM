<?php
include 'connect.php';
// Function to generate a random customer ID
function generateCustomerId($length = 6) {
    return mt_rand(100000, 999999);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cust_fname = $_POST['cust_fname'];
    $cust_lname = $_POST['cust_lname'];
    $cust_phone = $_POST['cust_phone'];
    $cust_email = $_POST['cust_email'];
    $cust_business = $_POST['cust_business'];
    $b_address = $_POST['b_address'];
    $b_industry = $_POST['b_industry'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $zipcode = $_POST['zipcode'];
    $cust_id = generateCustomerId();

    // Validate input
    if (!empty($cust_fname) && !empty($cust_lname) && !empty($cust_phone) && !empty($cust_email) && !empty($cust_business) && !empty($b_address) && !empty($b_industry) && !empty($state) && !empty($country) && !empty($zipcode)) {
        // Check if email already exists
        $emailCheckSql = "SELECT * FROM customers WHERE cust_email = ?";
        $stmt = $conn->prepare($emailCheckSql);
        $stmt->bind_param("s", $cust_email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "Email already exists. Please use a different email.";
        } else {
            // Insert into the database
            $sql = "INSERT INTO customers (cust_id, cust_fname, cust_lname, cust_phone, cust_email, cust_business, b_address, b_industry, state, country, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issssssssss", $cust_id, $cust_fname, $cust_lname, $cust_phone, $cust_email, $cust_business, $b_address, $b_industry, $state, $country, $zipcode);

            if ($stmt->execute()) {
                echo "Registration successful! Your Customer ID is: " . $cust_id;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Please fill in all fields.";
    }
}

// Close the connection


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .form-group {
            margin-bottom: 15px;
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
</head>
<body>
    <div class="form-container">
        <h2>Signup</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="cust_fname">First Name:</label>
                <input type="text" id="cust_fname" name="cust_fname" required>
            </div>
            <div class="form-group">
                <label for="cust_lname">Last Name:</label>
                <input type="text" id="cust_lname" name="cust_lname" required>
            </div>
            <div class="form-group">
                <label for="cust_phone">Phone Number:</label>
                <input type="tel" id="cust_phone" name="cust_phone" required>
            </div>
            <div class="form-group">
                <label for="cust_email">Email:</label>
                <input type="email" id="cust_email" name="cust_email" required>
            </div>
            <div class="form-group">
                <label for="cust_business">Business Name:</label>
                <input type="text" id="cust_business" name="cust_business" required>
            </div>
            <div class="form-group">
                <label for="b_address">Business Address:</label>
                <input type="text" id="b_address" name="b_address" required>
            </div>
            <div class="form-group">
                <label for="b_industry">Business Industry:</label>
                <input type="text" id="b_industry" name="b_industry" required>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="zipcode">Zipcode:</label>
                <input type="text" id="zipcode" name="zipcode" required>
            </div>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>