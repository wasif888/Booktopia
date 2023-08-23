<!DOCTYPE html>
<html>
<head>
    <title>eBook Store Dashboard</title>
    <style>
        /* CSS styles omitted for brevity */
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

 a:hover{
    background: blue;
    transition: 0.5s;

}
        body {
            background-color: #0f4c75;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #3282b8;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
            margin-top: 20px;
        }

        .dashboard-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .dashboard-item h2 {
            margin-top: 0;
            font-size: 24px;
            color: #0f4c75;
        }

        .dashboard-item p {
            margin-top: 10px;
            color: #333;
        }

        .dashboard-item img {
            width: 200px;
            height: 250px;
            object-fit: cover;
            object-position: center;
            margin-bottom: 10px;
        }

        .dashboard-item button {
            background-color: #3282b8;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        .dashboard-item a {
            color: #3282b8;
            text-decoration: none;
            font-weight: bold;
        }

        .dashboard-item a:hover {
            text-decoration: underline;
        }

        .footer {
            background-color: #3282b8;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .footer p {
            margin: 0;
        }
        .order-link {
            display: inline-block;
            background-color: transparent;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 10px;
        }

        .order-link:hover {
            box-shadow: 0 0 0 3px #276791;
        }
        /* Existing CSS styles */

.logout-button,
.profile-button {
    background-color: #fff;
    color: #3282b8;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.logout-button:hover,
.profile-button:hover {
    background-color: #3282b8;
    color: #fff;
}
.review-button {
    background-color: #3282b8;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
    text-decoration:
    none;
}

    </style>
</head>
<body>

<nav>
        <label class = "logo">Booktopia</label>
    <ul>
  <li><a href="profile.php">Profile</a></li>
  <li><a href="Logout.php">Logout</a></li>
   </ul> 
    </nav>

  <!--  <div class="container">
        <div class="header">
            <h1>Booktopia</h1>
            <button class="logout-button" onclick="logout()">Logout</button>
            <button class="profile-button" onclick="goToProfile()">Profile</button>
        </div>
-->
        <div class="dashboard">
            
            <?php
            // Connect to the database (replace with your own database connection code)
            $conn = mysqli_connect("localhost", "root", "", "booktopiamain");

            // Check if the connection was successful
            if (!$conn) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            // Query to fetch books data
            $query = "SELECT * FROM books";
            $result = mysqli_query($conn, $query);

            // Check if books exist
            if (mysqli_num_rows($result) > 0) {
                // Loop through each book and display its information
                while ($row = mysqli_fetch_assoc($result)) {
                    $bookId = $row['id'];
                    $title = $row['title'];
                    $author = $row['author'];
                    $isbn = $row['isbn'];
                    $publicationYear = $row['publication_year'];
                    $quantity = $row['quantity'];
                    $image = $row['image'];
                    $rentalFee = $row['rental_fee'];
                    $price = $row['price'];

                    // Display the book information
                    echo "<div class='dashboard-item'>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($image) . "' alt='Book Cover'>";
                    echo "<h2>$title</h2>";
                    echo "<p>Author: $author</p>";
                    echo "<p>ISBN: $isbn</p>";
                    echo "<p>Publication Year: $publicationYear</p>";
                    echo "<p>Quantity: $quantity</p>";
                    echo "<p>Rental Fee: $rentalFee</p>";
                    echo "<p>Price: $price</p>";
                    echo "<button onclick='confirmOrder($bookId)'>Order</button>";
                    echo"<br>";
                    echo "<button onclick='viewReviews($bookId)' class='review-button'>View Reviews</button>";
                    echo "<button onclick='addReview($bookId)'>Add Review</button>";
                    echo "<button onclick='rentBook($bookId)'>Rent Book</button>";
                    echo "</div>";
                   
                }
            } else {
                echo "<div class='dashboard-item'>";
                echo "<h2>No books found.</h2>";
                echo "</div>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>

        <div class="footer">
            <p>&copy; 2023 eBook Store. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Function to display confirmation pop-up and process the order
        function confirmOrder(bookId) {
            var result = confirm("Confirm your order?");
            if (result) {
                window.location.href = "order.php?book_id=" + bookId;
            }
        }
        function logout() {
            // Redirect to the logout script or desired logout functionality
            window.location.href = "logout.php";
        }
        function goToProfile() {
            // Redirect to the user profile page
            window.location.href = "profile.php";
        }
        function addReview(bookId) {
            // Redirect to the page for adding reviews with the book ID as a parameter
          
            window.location.href = "add_review.php?book_id=" + bookId;
        }

        function rentBook(bookId) {
            // Redirect to the page for renting books with the book ID as a parameter
            window.location.href = "rent_book.php?book_id=" + bookId;
        }

        function viewReviews(bookId) {
            // Redirect to the reviews page with the book ID as a parameter
            window.location.href = "reviews.php?book_id=" + bookId;
        }
    </script>
</body>
</html>
