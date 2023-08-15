<!-- filter_query.php -->
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish a database connection (replace with your actual database credentials)
$host = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter data from the form submission
$selectedCity = $_POST['selectedCity'];
$bhkType = $_POST['bhk_type'];
$budget = $_POST['budget'];
$propertyType = $_POST['propertyType'];
$builtUpArea = $_POST['builtUpArea'];
$furnishingType = $_POST['furnishingType'];
$ageOfProperty = $_POST['ageOfProperty'];

// Build the SQL query based on the filter data and the selected city
$sql = "SELECT property_id FROM property WHERE
            city = '$selectedCity' AND
            bhk_type = '$bhkType' AND
            budget <= '$budget' AND
            property_type = '$propertyType' AND
            -- builtUpArea >= '$builtUpArea' AND      wtf is ths
            furnish_type = '$furnishingType' AND
            property_age <= '$ageOfProperty'";

$result = $conn->query($sql);

$propertyIds = array();
while ($row = $result->fetch_assoc()) {
    $propertyIds[] = $row['property_id'];
}

// Close the database connection
$conn->close();

// Redirect to result.php page with property_id values
if (!empty($propertyIds)) {
    $propertyIdsQueryString = http_build_query(array('propertyIds' => implode(',', $propertyIds)));
    header("Location: ../result.php?$propertyIdsQueryString");
} else {
    echo "No properties match the filter criteria.";
}
?>
