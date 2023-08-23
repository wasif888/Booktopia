<?php
session_start();

// Check if the admin is not logged in, redirect to login page
if (!isset($_SESSION['admin_username'])) {
    header('Location: admin_login.php');
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    // Get the order ID to be deleted
    $order_id = $_POST['order_id'];

    // Connect to the database (replace with your own database connection code)
    $conn = mysqli_connect("localhost", "root", "", "booktopiamain");

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Delete the order from the book_orders table
    $delete_query = "DELETE FROM book_orders WHERE id = '$order_id'";
    mysqli_query($conn, $delete_query);

    // Increase the book quantity by 1
    $update_query = "UPDATE books SET quantity = quantity + 1 WHERE id IN (SELECT book_id FROM book_orders WHERE id = '$order_id')";
    mysqli_query($conn, $update_query);

    // Close the database connection
    mysqli_close($conn);
}

// Fetch all orders from the book_orders table
// Connect to the database (replace with your own database connection code)
$conn = mysqli_connect("localhost", "root", "", "booktopiamain");

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch all orders
$query = "SELECT bo.id, bo.order_date, b.title, m.name
          FROM book_orders bo
          JOIN books b ON b.id = bo.book_id
          JOIN members m ON m.id = bo.member_id";
$result = mysqli_query($conn, $query);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Existing code and styles -->
</head>
<body>
    <!-- Existing code -->

    <div class="container">
        <h2>View Orders</h2>
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
    width: 400px;
    height: 670px;
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

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 8px;
    border-bottom: 1px solid #fff;
    color: #fff;
}

th {
    background-color: #3282b8;
}

tr:nth-child(even) {
    background-color: #1a6493;
}

form {
    display: inline-block;
}

button {
    background-color: #dc3545;
    color: #fff;
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #c82333;
}

       </style>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Book Title</th>
                <th>Member Name</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <form action="view_orders.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_order">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <script>
        // Existing JavaScript functions
    </script>
</body>
</html>
