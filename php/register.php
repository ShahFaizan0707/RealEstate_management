<!-- register.php -->
<?php
// Establish a database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "dbms";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Collect user input
$userName = $_POST['userName'];
$email = $_POST['email'];
$password = $_POST['password'];
$userContact = $_POST['userContact'];
$userType = $_POST['userType']; // Added user type

// Insert user details into the user table
$sql = "INSERT INTO user (user_name, email, password, user_contact, user_type)
        VALUES ('$userName', '$email', '$password', '$userContact', '$userType')";

if (mysqli_query($conn, $sql)) {
    $user_id = mysqli_insert_id($conn); // Get the inserted user ID

    if ($userType === 'seller') {
        // Insert into seller table
        $insert_seller_sql = "INSERT INTO seller (seller_name, seller_contact, user_id)
                              VALUES ('$userName', '$userContact', '$user_id')";
        mysqli_query($conn, $insert_seller_sql);
    } elseif ($userType === 'buyer') {
        // Insert into buyer table
        $insert_buyer_sql = "INSERT INTO buyer (buyer_name, buyer_contact, user_id)
                             VALUES ('$userName', '$userContact', '$user_id')";
        mysqli_query($conn, $insert_buyer_sql);
    }

   // Show a message and redirect to login page
   echo '<script>alert("Registration successful!"); window.location.href = "../login.html";</script>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>