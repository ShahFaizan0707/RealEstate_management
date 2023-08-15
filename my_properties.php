<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Properties</title>
    <link rel="stylesheet" href="css/my_properties.css">
</head>
<body>
    <div class="container">
        <h1>My Properties</h1>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        session_start();
        
        // Establish a database connection (replace with your actual database credentials)
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbms";
        
        $conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch property details linked to the seller's ID
        $sellerId = $_SESSION['seller_id'];
        $propertyQuery = "SELECT * FROM property WHERE seller_id = $sellerId";
        $propertyResult = $conn->query($propertyQuery);

        if ($propertyResult && $propertyResult->num_rows > 0) {
            while ($property = $propertyResult->fetch_assoc()) {
                $propertyId = $property['property_id'];
                $propertyName = $property['property_name'];
                // ... other property details ...

                // Fetch interested buyers for the property
                $interestQuery = "SELECT i.*, b.buyer_name, b.buyer_contact
                                  FROM interest i
                                  JOIN buyer b ON i.buyer_id = b.buyer_id
                                  WHERE i.property_id = $propertyId";
                $interestResult = $conn->query($interestQuery);

                echo '<div class="property">';
                echo '<h2>' . $propertyName . '</h2>';
                // Display other property details...

                if ($interestResult && $interestResult->num_rows > 0) {
                    echo '<div class="buyer-list">';
                    echo '<table>';
                    echo '<thead><tr><th>Buyer Name</th><th>Contact</th><th></th></tr></thead>';
                    echo '<tbody>';
                    while ($buyer = $interestResult->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $buyer['buyer_name'] . '</td>';
                        echo '<td>' . $buyer['buyer_contact'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<p>No interested buyers.</p>';
                }

                echo '</div>';
            }
        }
        ?>
        <button type="button" class="add-property-button" onclick="location.href='add_property.php';">Add Property</button>
    </div>
</body>
</html>
