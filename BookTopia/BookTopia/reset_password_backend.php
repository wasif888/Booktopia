<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $email = $_POST["email"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Perform validation on the form data (add your own validation rules)

    // Check if the new password matches the confirmation password
    if ($newPassword != $confirmPassword) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Connect to the database (replace with your own database connection code)
    $conn = mysqli_connect("localhost", "root", "", "booktopiamain");

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare the query to update the password in the database
    $query = "UPDATE members SET password = '$hashedPassword' WHERE email = '$email'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Password reset successful
        echo "Password reset successfully!";
        // Redirect to the login page or desired page
        header("Location: login.php");
        exit();
    } else {
        // Error occurred while resetting the password
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
