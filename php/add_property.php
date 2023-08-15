<!-- add_property.php -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Establish a database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "dbms";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Collect property inputs
$propertyName = $_POST['propertyName'];
$propertyLocation = $_POST['propertyLocation'];
$city = $_POST['city'];
$bhkType = $_POST['bhkType'];
$budget = $_POST['budget'];
$propertyType = $_POST['propertyType'];
$furnishType = $_POST['furnishingType'];
$propertyAge = $_POST['propertyAge'];

// Get the seller's ID from the session (assumes you stored it during login)
$seller_id = $_SESSION['seller_id'];

// Handle image upload
$imageData = addslashes(file_get_contents($_FILES["propertyImage"]["tmp_name"]));

// Insert property details into the property table
$sql = "INSERT INTO property (property_name, property_location, city, bhk_type, budget, property_type, furnish_type, property_age, property_image, seller_id)
        VALUES ('$propertyName', '$propertyLocation', '$city', '$bhkType', '$budget', '$propertyType', '$furnishType', '$propertyAge', '$imageData', '$seller_id')";

if (mysqli_query($conn, $sql)) {
    if ($imageData) {
        // yes done
    } else {
        echo "Image not available.";
    }  
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
