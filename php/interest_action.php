<?php
// interest_action.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "dbms";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['propertyId'])) {
    // Get property ID from the URL parameter
    $propertyId = $_GET['propertyId'];

    // Fetch seller details
    $propertyQuery = "SELECT seller_id FROM property WHERE property_id = $propertyId";
    $result = $conn->query($propertyQuery);

    if ($result && $result->num_rows > 0) {
        $property = $result->fetch_assoc();
        $sellerId = $property['seller_id'];

        // Fetch seller details from the seller table
        $sellerQuery = "SELECT seller_name, seller_contact FROM seller WHERE seller_id = $sellerId";
        $sellerResult = $conn->query($sellerQuery);

        if ($sellerResult && $sellerResult->num_rows > 0) {
            $seller = $sellerResult->fetch_assoc();
            $sellerName = $seller['seller_name'];
            $sellerContact = $seller['seller_contact'];

            // Display seller details
            
            echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css\">
    <title>Seller Details</title>
    <style>

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background: url('../css/app-data/sold.jpg') center/cover no-repeat;
        background-attachment: fixed; 
        opacity: 0.9;
    }
   

    .seller-details {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%; 
        height:200px;
        max-width: 600px;
    }

    .seller-details h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .seller-details p {
        font-size: 16px;
        margin: 5px 0;
    }

        /* navbar */
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    padding: 10px 20px;
    color: white;
    margin: 0; 
}

.navbar a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
    font-size: 14px;
}

.navbar-links {
    display: flex;
    align-items: center;
}

.navbar-links a i {
    margin-right: 5px;
}

.navbar-brand {
    display: flex;
    align-items: center;
}

.navbar-brand img {
    width: 40px;
    margin-right: 10px; 
}

.navbar-brand span {
    font-size: 18px;
    font-weight: bold;
}
    </style>
</head>
<body>
<nav class=\"navbar\">
<div class=\"navbar-brand\">
                <img src=\"../css/app-data/logo.png\" alt=\"Logo\">
                <span>Shahzad</span>
            </div>
        <div class=\"navbar-links\">
            <a href=\"../logout.php\"><i class=\"fas fa-sign-out-alt\"></i> Logout</a>
        </div>
    </nav>
    <div class=\"seller-details\">
        <h1>Seller Details</h1>
        <p><strong>Seller Name:</strong> {$sellerName}</p>
        <p><strong>Seller Contact:</strong> {$sellerContact}</p><br>
        <p style=\"font-size: 24px;\"><strong>Intrest has been shared with the seller</strong> </p>
    </div>
</body>
</html>";

            // Update interest table
            $buyerId = $_SESSION['buyer_id'];
            $currentDate = date('Y-m-d');

            $insertQuery = "INSERT INTO interest (buyer_id, property_id, interest_date) VALUES ('$buyerId', '$propertyId', '$currentDate')";
            if ($conn->query($insertQuery)) {
                // echo "Interest added successfully!";
            } else {
                echo "Error adding interest: " . $conn->error;
            }
        } else {
            echo "Seller details not found.";
        }
    } else {
        echo "Property not found.";
    }
}
else{
    echo "lol";
}
?>
