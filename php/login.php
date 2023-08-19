<!-- login.php -->
<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "dbms";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Assuming you have received user's email and password from the form
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT user_id, user_name, user_contact, user_type FROM user WHERE email = :email AND password = :password");
    $stmt->bindParam(':email', $user_email);
    $stmt->bindParam(':password', $user_password);
    $stmt->execute();

    // Fetch the user data from the result
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user_data) {
        $user_id = $user_data['user_id'];
        $user_type = $user_data['user_type']; // Assuming the user type attribute is present in $user_data
        
        if ($user_type === "seller") {
            $seller_id_query = "SELECT seller_id FROM seller WHERE user_id = :user_id";
            $seller_stmt = $conn->prepare($seller_id_query);
            $seller_stmt->bindParam(':user_id', $user_data['user_id']);
            $seller_stmt->execute();
            $seller_id_data = $seller_stmt->fetch(PDO::FETCH_ASSOC);

            if ($seller_id_data) {
                $_SESSION['seller_id'] = $seller_id_data['seller_id']; // Set the seller_id in the session
                }
             header("Location: ../add_property.php"); // Redirect to add_property.html for sellers

        } elseif ($user_type === "buyer") {

            $buyer_id_query = "SELECT buyer_id FROM buyer WHERE user_id = :user_id";
            $buyer_stmt = $conn->prepare($buyer_id_query);
            $buyer_stmt->bindParam(':user_id', $user_data['user_id']);
            $buyer_stmt->execute();
            $buyer_id_data = $buyer_stmt->fetch(PDO::FETCH_ASSOC);

            if ($buyer_id_data) {
                $_SESSION['buyer_id'] = $buyer_id_data['buyer_id']; // Set the buyer_id in the session
                }
             header("Location: ../selection.php"); // Redirect to selection.php for buyers      
        }       
        else {
            echo "Invalid user type";
        }
    } else {
        // echo "Invalid credentials";
        header("Location: ../login.html");
    }
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
