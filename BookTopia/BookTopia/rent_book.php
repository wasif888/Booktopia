<!DOCTYPE html>
<html>
<head>
    <title>Booktopia - Rent Book</title>
    <style>


body{
    font-family: Arial, sans-serif;
}

nav{
    background: #0082e6;
    height: 80px;
    width: 100%;
}

label.logo{
    color: white;
    font-size: 35px;
    line-height: 80px;
    padding: 0 100px;
    font-weight: bold;
}

nav ul{
   float: right;
   margin-right: 20px;
}

nav ul li{
    display: inline-block;
    line-height: 10px;
    margin: 0 5px;
}

nav ul li a {
    color: white;
    font-size: 17px;
    padding: 7px 13px;
    border-radius: 3px;
}

 a:hover{
    background: blue;
    transition: 0.5s;

}


        body {
    background-color: #000;
    color: #fff;
    font-family: Arial, sans-serif;
 
}

body.night-mode {
    background-color: #fff;
    color: #000;
}

.container {
    width: 400px;
    height: 450px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    background-color: #1e88e5;
    border-radius: 10px;
}

h1 {
    margin-top: 50px;
    font-size: 24px;
}

form {
    margin-top: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    margin-bottom: 10px;
    font-size: 16px;
    color: #fff;
}

input[type="number"] {
    padding: 10px;
    width: 100%;
    margin-bottom: 20px;
    border-radius: 5px;
    border: none;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #1565c0;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0f4c;
    
}

   
    a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #1e88e5;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 20px;
        top: 10px;
        left: 100px;
    }

    a:hover {
        background-color: #1565c0;
    }


    </style>
</head>
<body>

<nav>
        <label class = "logo">Booktopia</label>
    <ul>
  <li><a class= "active" href="dashboard.php">Home</a></li>
  <li><a href="profile.php">Profile</a></li>
  <li><a href="Logout.php">Logout</a></li>
   </ul> 
    </nav>


    <div class="container">
        <h1>Booktopia - Rent Book</h1>
        <form action="rent_book.php" method="GET">
            <label for="rental_days">Rental Days:</label>
            <input type="number" name="rental_days" min="1" required>
            <input type="hidden" name="book_id" value="<?php echo isset($_GET['book_id']) ? $_GET['book_id'] : ''; ?>">
            <input type="submit" value="Rent">
        </form>
        
    </div>
    
</body>
</html>
<?php
session_start();

// Check if the member is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle the case when the member is not logged in
    // For example: header("Location: login.php");
    exit("Unauthorized access");
}

// Process the rental form submission
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["book_id"]) && isset($_GET["rental_days"])) {
    // Get the book ID and rental days from the form submission
    $bookId = $_GET["book_id"]; // Use $_GET instead of $_POST
    $rentalDays = $_GET["rental_days"];

    // Use $_GET instead of $_POST
    // Connect to the database (replace with your own database connection code)
    $conn = mysqli_connect("localhost", "root", "", "booktopiamain");

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Retrieve book details from the database
    $bookQuery = "SELECT * FROM books WHERE id = $bookId";
    $bookResult = mysqli_query($conn, $bookQuery);

    if (mysqli_num_rows($bookResult) > 0) {
        $bookRow = mysqli_fetch_assoc($bookResult);
        $title = $bookRow['title'];
        $rentalFee = $bookRow['rental_fee'];
        $quantity = $bookRow['quantity'];

        // Check if the book is available for rent
        if ($quantity > 0) {
            $memberId = $_SESSION['user_id'];

            // Calculate the rental fee
            $totalRentalFee = $rentalFee * $rentalDays;

            // Insert the rental record into the database
            $insertQuery = "INSERT INTO book_rentals (book_id, member_id, rental_date, rental_days, rental_fee) 
                            VALUES ($bookId, $memberId, CURDATE(), $rentalDays, $totalRentalFee)";
            $insertResult = mysqli_query($conn, $insertQuery);

            if ($insertResult) {
                // Update the book quantity
                $updateQuery = "UPDATE books SET quantity = quantity - 1 WHERE id = $bookId";
                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                    echo "<p>Book rented successfully!</p>";
                    echo "<p>Total Rental Fee: $totalRentalFee</p>";
                } else {
                    echo "<p>Error updating book quantity.</p>";
                }
            } else {
                echo "<p>Error renting the book.</p>";
            }
        } else {
            echo "<p>The book is currently not available.</p>";
        }
    } else {
        echo "<p>Book not found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
