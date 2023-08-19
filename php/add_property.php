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
$bhk_type = $_POST['bhkType'];
$budget = $_POST['budget'];
$propertyType = $_POST['propertyType'];
$furnishType = $_POST['furnishingType'];
$propertyAge = $_POST['propertyAge'];
$builtUpArea =$_POST['builtUpArea'];

// Get the seller's ID from the session (assumes you stored it during login)
$seller_id = $_SESSION['seller_id'];

// Handle image upload
$imageData = addslashes(file_get_contents($_FILES["propertyImage"]["tmp_name"]));


$sql = "INSERT INTO property (property_name, property_location, city, bhk_type, budget, property_type,builtUpArea, furnish_type, property_age, property_image, seller_id)
        VALUES ('$propertyName', '$propertyLocation', '$city', '$bhk_type', '$budget', '$propertyType','$builtUpArea' ,'$furnishType', '$propertyAge', '$imageData', '$seller_id')";

if (mysqli_query($conn, $sql)) {
    if ($imageData) {
        //here
        header("Location: ../my_properties.php");
        exit();
exit();
    } else {
        echo "Image not available.";
    }  
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
