<?php
session_start();

// Check if the member is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle the case when the member is not logged in
    // For example: header("Location: login.php");
    exit("Unauthorized access");
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["book_id"])) {
    // Get the book ID from the query parameter
    $bookId = $_GET["book_id"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booktopia - Add Review</title>
</head>
<style>
        /* Add your CSS styles here */

        *{
    padding: 0;
    margin: 0;
    text-decoration: none;
    box-sizing: border-box;
}
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
    line-height: 0px;
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
            text-align: center;
            transition: background-color 0.5s ease;
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
            background-color: #0f4c75;
            border-radius: 5px;
        }

        h2 {
            margin-top: 0;
            color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            text-align: left;
            color: #fff;
            margin-bottom: 5px;
        }

        input[type="number"],
        textarea {
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
<body>

<nav>
        <label class = "logo">Booktopia</label>
    <ul>
    <li><a href="dashboard.php">Home</a></li>
  <li><a href="profile.php">Profile</a></li>
  <li><a href="Logout.php">Logout</a></li>
   </ul> 
    </nav>

    <div class="container">
        <h2>Add Review</h2>

        <form action="add_review.php" method="POST">
            <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
            <div class="form-group">
                <label for="rating">Rating</label>
                <input type="number" class="rating" id="rating" name="rating" min="1" max="5" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Submit Review">
            </div>
        </form>
        
    </div>
</body>
</html>

<?php
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];
    $bookId = $_POST["book_id"];

    // Perform validation on the form data (add your own validation rules)

    // Connect to the database (replace with your own database connection code)
    $conn = mysqli_connect("localhost", "root", "", "booktopiamain");

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL query
    $query = "INSERT INTO reviews (book_id, member_id, rating, comment) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "iiis", $bookId, $_SESSION['user_id'], $rating, $comment);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Review added successfully.";
    } else {
        echo "Error adding review: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Invalid request
    echo "Invalid request.";
}
?>
