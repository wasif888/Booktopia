<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform validation on the form data (add your own validation rules)

    // Connect to the database (replace with your own database connection code)
    $conn = mysqli_connect("localhost", "root", "", "booktopiamain");

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare the query to check if the user exists
    $query = "SELECT * FROM members WHERE email = '$email'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the user exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch the user data
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row["password"])) {
            // Password is correct, user is authenticated
            // Start the session and store user data if needed
            session_start();
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_email"] = $row["email"];

            // Redirect to the dashboard or desired page
            header("Location: dashboard.php");
            exit();
        } else {
            // Password is incorrect
            $login_error = "Invalid email or password";
        }
    } else {
        // User does not exist
        $login_error = "Invalid email or password";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
