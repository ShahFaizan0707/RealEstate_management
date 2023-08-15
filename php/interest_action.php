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
            echo "Seller Name: $sellerName<br>";
            echo "Seller Contact: $sellerContact<br>";

            // Update interest table
            $buyerId = $_SESSION['buyer_id'];
            $currentDate = date('Y-m-d');

            $insertQuery = "INSERT INTO interest (buyer_id, property_id, interest_date) VALUES ('$buyerId', '$propertyId', '$currentDate')";
            if ($conn->query($insertQuery)) {
                echo "Interest added successfully!";
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
