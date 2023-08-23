<?php
session_start();

// Check if the member is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle the case when the member is not logged in
    // For example: header("Location: login.php");
    exit("Unauthorized access");
}

// Connect to the database (replace with your own database connection code)
$conn = mysqli_connect("localhost", "root", "", "booktopiamain");

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get the book ID from the query parameter
$bookId = $_GET['book_id'];

// Get the member ID from the session
$memberId = $_SESSION['user_id'];

// Check if the book is available
$availabilityQuery = "SELECT quantity FROM books WHERE id = $bookId";
$availabilityResult = mysqli_query($conn, $availabilityQuery);

if (mysqli_num_rows($availabilityResult) > 0) {
    $row = mysqli_fetch_assoc($availabilityResult);
    $quantity = $row['quantity'];

    if ($quantity > 0) {
        // Reduce the book quantity by 1
        $updateQuery = "UPDATE books SET quantity = quantity - 1 WHERE id = $bookId";
        mysqli_query($conn, $updateQuery);

        // Insert the order into the database
        $orderDate = date('Y-m-d');
        $insertQuery = "INSERT INTO book_orders (book_id, member_id, order_date) VALUES ($bookId, $memberId, '$orderDate')";
        mysqli_query($conn, $insertQuery);

        // Close the database connection
        mysqli_close($conn);

        // Redirect to the dashboard page
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Sorry, the book is currently out of stock.');</script>";
    }
}

// Close the database connection
mysqli_close($conn);
