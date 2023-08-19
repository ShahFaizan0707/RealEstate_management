<!-- selection.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Locations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/selection.css">
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

    <div class="selection-container">
        <h1 class="page-heading">Available Cities</h1>

        <div class="locations">
            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            $locationImages = array("city1.jpg", "city2.jpg", "city3.jpg", "city4.jpg", "city5.jpg");
            
            $host = "localhost";
            $username = "root"; 
            $password = ""; 
            $database = "dbms";
            
            $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            
            $query = "SELECT DISTINCT city FROM property";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($locations as $index => $location) {
                $imageIndex = $index % count($locationImages); // Loop through images
                $imageUrl = "images/" . $locationImages[$imageIndex];
            
                echo '<div class="location-column" style="background-image: url(\'' . $imageUrl . '\');">';
                echo '<a href="filter.php?selectedCity=' . urlencode($location['city']) . '" class="location-name">' . $location['city'] . '</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
