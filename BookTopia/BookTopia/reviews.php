<!DOCTYPE html>
<html>
<head>
    <title>Book Reviews</title>
    <style>
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
    line-height: 80px;
    margin: 0 5px;
}

nav ul li a {
    color: white;
    font-size: 17px;
    padding: 7px 13px;
    border-radius: 3px;
}

a.active, a:hover{
    background: blue;
    transition: 0.5s;

}
        body {
            background-color: #f0f7fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2978b5;
        }

        .review {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #eef4f9;
            border-radius: 5px;
        }

        .rating {
            color: #2978b5;
            font-weight: bold;
        }

        .username {
            color: #2978b5;
        }

        .comment {
            color: #444444;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2978b5;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #09537c;
        }
    </style>
</head>
<body>
<nav>
        <label class = "logo">Booktopia</label>
    <ul>
   </ul> 
    </nav>

    <div class="container">
        <h1>Book Reviews</h1>

        <?php
        session_start();

        // Check if the member is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect or handle the case when the member is not logged in
            // For example: header("Location: login.php");
            exit("Unauthorized access");
        }

        // Check if the book ID is provided as a query parameter
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["book_id"])) {
            $bookId = $_GET["book_id"];

            // Connect to the database (replace with your own database connection code)
            $conn = mysqli_connect("localhost", "root", "", "booktopiamain");


            // Check if the connection was successful
            if (!$conn) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            // Prepare the SQL query to retrieve reviews for the specified book
            $query = "SELECT r.rating, r.comment, m.name
            FROM reviews r
            JOIN members m ON r.member_id = m.id
            WHERE r.book_id = $bookId";

            $result = mysqli_query($conn, $query);

            // Check if there are any reviews for the book
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $rating = $row['rating'];
                    $comment = $row['comment'];
                    $name = $row['name'];

                    // Display the review information
                    echo "<div class='review'>";
                    echo "<p class='rating'>Rating: $rating</p>";
                    echo "<p class='username'>Username: $name</p>";
                    echo "<p class='comment'>$comment</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews found for this book.</p>";
            }

            // Close the database connection
            mysqli_close($conn);
        } else {
            echo "<p>Invalid book ID.</p>";
        }
        ?>

        <a href="dashboard.php" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>
