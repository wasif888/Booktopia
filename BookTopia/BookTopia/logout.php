<?php
// Start the session
session_start();

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the index.html page or desired page
header("Location: index.php");
exit();
?>
