<?php
session_start(); // Start the session

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to index.html
header("Location: index.html");
exit();
?>