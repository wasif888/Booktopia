<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page or desired page
    header("Location: login.php");
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION["user_id"];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    // Perform validation on the form data (add your own validation rules)

    // Connect to the database (replace with your own database connection code)
    $conn = mysqli_connect("localhost", "root", "", "booktopiamain");

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare the query to update the user information
    $query = "UPDATE members SET name = '$name', email = '$email', address = '$address', phone = '$phone' WHERE id = '$user_id'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Update successful
        $update_message = "Profile updated successfully";
    } else {
        // Update failed
        $update_error = "Failed to update profile";
    }

    // Close the database connection
    mysqli_close($conn);
}

// Fetch the updated user data from the database

// Connect to the database (replace with your own database connection code)
$conn = mysqli_connect("localhost", "root", "", "booktopiamain");

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Prepare the query to fetch user data
$query = "SELECT * FROM members WHERE id = '$user_id'";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the user exists
if (mysqli_num_rows($result) > 0) {
    // Fetch the user data
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $email = $row['email'];
    $address = $row['address'];
    $phone = $row['phone'];
} else {
    // User does not exist
    // Handle the case appropriately (e.g., display an error message)
}

// Close the database connection
mysqli_close($conn);

// Redirect to the profile page
header("Location: profile.php");
exit();
?>
