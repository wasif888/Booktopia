<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    // Perform validation on the form data (add your own validation rules)

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Connect to the database (replace with your own database connection code)
    $conn = mysqli_connect("localhost", "root", "", "booktopiamain");

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare the query to insert the user into the database
    $query = "INSERT INTO members (name, email, address, phone, password) VALUES ('$name', '$email', '$address', '$phone', '$hashedPassword')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // User account created successfully
        echo "User account created successfully!";
        // Redirect to the login page or desired page
        header("Location: login.php");
        exit();
    } else {
        // Error occurred while creating the user account
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
