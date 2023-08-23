<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted email and password
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];

    // Validate the email and password
    // Connect to the database (replace with your own database connection code)
    $conn = mysqli_connect("localhost", "root", "", "booktopiamain");

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare the query to fetch the hashed password for the given email
    $query = "SELECT password FROM admin WHERE email = '$email'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if a matching record was found
    if (mysqli_num_rows($result) === 1) {
        // Fetch the hashed password from the result
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        // Verify the submitted password against the hashed password
        if (password_verify($password, $hashedPassword)) {
            // Successful login
            // Store the username in the session
            $_SESSION['admin_username'] = $email;
            
            // Redirect to the admin dashboard
            header('Location: admin_dashboard.php');
            exit;
        }
    }

    // Invalid credentials
    $error = 'Invalid email or password';

    // Close the database connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Booktopia - Admin Login</title>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
            transition: background-color 0.5s ease;
        }

        body.night-mode {
            background-color: #fff;
            color: #000;
        }

        .container {
            width: 300px;
            height: 300px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #0f4c75;
            border-radius: 5px;
        }

        h2 {
            margin-top: 0;
            color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            color: #fff;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: none;
        }

        .btn {
            display: inline-block;
            background-color: #3282b8;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #1a6493;
        }

        .mode-toggle {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .mode-toggle button {
            background-color: transparent;
            color: #fff;
            border: none;
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .mode-toggle button:hover {
            color: #1a6493;
        }
    </style>
</head>
<body>
    <script>
        function toggleMode() {
            var body = document.querySelector('body');
            body.classList.toggle('night-mode');
        }
    </script>

    <div class="mode-toggle">
        <button onclick="toggleMode()">Change Mode</button>
    </div>

    <div class="container">
        <h2>Admin Login</h2>
        <form action="admin_login.php" method="POST">
            <div class="form-group">
                <label for="admin_email">Email</label>
                <input type="text" id="admin_email" name="admin_email" required>
            </div>
            <div class="form-group">
                <label for="admin_password">Password</label>
                <input type="password" id="admin_password" name="admin_password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Admin Login">
            </div>
        </form>
    </div>

</body>
</html>
