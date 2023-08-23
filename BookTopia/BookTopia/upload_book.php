<?php
session_start();

// Check if the admin is not logged in, redirect to login page
if (!isset($_SESSION['admin_username'])) {
    header('Location: admin_login.php');
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $publication_year = $_POST['publication_year'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $rental_fee = $_POST['rental_fee'];

    // Process the uploaded photo
    $photo = $_FILES['photo'];
    $photo_tmp_name = $photo['tmp_name'];

    // Read the contents of the photo file
    $photo_content = file_get_contents($photo_tmp_name);

    // Connect to the database
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'booktopiamain';

    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to insert a new book record
    $sql = "INSERT INTO books (title, author, isbn, publication_year, quantity, image, rental_fee, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind the parameters (including the image, rental fee, and price) and execute the statement
    $stmt->bind_param("sssissdd", $title, $author, $isbn, $publication_year, $quantity, $photo_content, $rental_fee, $price);
    $stmt->execute();

    // Check if the record was inserted and image uploaded successfully
    if ($stmt->affected_rows > 0) {
        // Redirect to a success page or display a success message
        header('dashboard.php');
        exit;
    } else {
        // Handle the database error
        $error = 'Error adding the book record. Please try again.';
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
