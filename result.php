<!-- result.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Search Results</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/result.css">
</head>
<body>

<nav class="navbar">
<div class="navbar-brand">
                <img src="css/app-data/logo.png" alt="Logo">
                <span>Shahzad</span>
            </div>
        <div class="navbar-links">
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>
    <h1>Property Search Results</h1>

    <div class="container">
        
        <div class="property-list">
            <?php
             error_reporting(E_ALL);
             ini_set('display_errors', 1);
            session_start();

            // Retrieve property IDs from the query parameters
            $propertyIds = isset($_GET['propertyIds']) ? explode(',', $_GET['propertyIds']) : array();

            // Database connection setup (Replace with your own database credentials)
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "dbms";

            $conn = new mysqli($host, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $interestedPropertyIds = array();

            // Fetch the property IDs that the user has shown interest in
            if (isset($_SESSION['buyer_id'])) {
             $buyerId = $_SESSION['buyer_id'];
             $interestQuery = "SELECT property_id FROM interest WHERE buyer_id = $buyerId";
             $interestResult = $conn->query($interestQuery);

            if ($interestResult && $interestResult->num_rows > 0) {
                while ($row = $interestResult->fetch_assoc()) {
            $interestedPropertyIds[] = $row['property_id'];
                     }
                 }
            }

            // Loop through each property ID
            foreach ($propertyIds as $propertyId) {
                // Fetch property details from the database using $propertyId
                $propertyQuery = "SELECT * FROM property WHERE property_id = $propertyId";
                $result = $conn->query($propertyQuery);

                if ($result && $result->num_rows > 0) {
                    $property = $result->fetch_assoc();
                    $propertyImage = $property['property_image'];
                    $propertyName = $property['property_name'];
                    $propertyLocation = $property['property_location'];
                    $propertyBudget = $property['budget'];
                    $propertySize = $property['builtUpArea'];
                    $bhkType =$property['bhk_type'];
                    $propertyType = $property['property_type'];
                    $FurnishType = $property['furnish_type'];
                    $propertyAge = $property['property_age'];


                    // Display property card with fetched details
                    echo '<div class="property-card">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($propertyImage) . '" alt="' . $propertyName . '">';

                // Wrap property details in a separate div with class "property-details"
                echo '<div class="property-details">';
                echo '<h2>' . $propertyName . '</h2>';
                echo '<p>' . $propertyLocation . '</p>';
                echo '<p>Budget: ₹' . $propertyBudget . '</p>';
                echo '<p>Size: ' . $propertySize . ' sqft</p>';
                echo '<p> ' . $bhkType. ' BHK</p>';
                echo '<p>Type: ' . $propertyType . ' </p>';
                echo '<p>Furnish: ' . $FurnishType . ' </p>';
                echo '<p>Age: ' . $propertyAge . ' years</p>';

               // Check if the propertyId is in the interestedPropertyIds array
                        if (in_array($propertyId, $interestedPropertyIds)) {
                     echo '<p>Interest already shown</p>';
                    } else {
                     echo '<a class="interest-button" href="php/interest_action.php?propertyId=' . $propertyId . '" onclick="return showInterest(' . $propertyId . ')">Show Interest</a>';
                     }
                echo '</div>'; // Closing property-details div

                echo '</div>'; // Closing property-card div
                }
            }

            $conn->close();
            ?>
        </div>
    </div>
    <script>
        function showInterest(propertyId) {
            if (confirm("Are you sure you want to show interest in this property?")) {
                return true;
            }
            return false;
        }
    </script>
</body>
</html>
