<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page or desired page
    header("Location: login.php");
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION["user_id"];

// Connect to the database (replace with your own database connection code)
$conn = mysqli_connect("localhost", "root", "", "booktopiamain");

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Prepare the query to fetch user data
$query = "SELECT * FROM members WHERE id = '$user_id'";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the user exists
if (mysqli_num_rows($result) > 0) {
    // Fetch the user data
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $email = $row['email'];
    $address = $row['address'];
    $phone = $row['phone'];
} else {
    // User does not exist
    // Handle the case appropriately (e.g., display an error message)
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
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
            background-color: #0f4c75;
            font-family: Arial, sans-serif;
            color: #fff;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #3282b8;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-success {
            color: green;
        }

        .update-error {
            color: red;
        }
    </style>
</head>
<body>
<nav>
        <label class = "logo">Booktopia</label>
    <ul>
    <li><a href="dashboard.php">Home</a></li>
  <li><a href="Logout.php">Logout</a></li>
  
   </ul> 
    </nav>

    <h1>Profile</h1>
    <p>Name: <?php echo $name; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Address: <?php echo $address; ?></p>
    <p>Phone: <?php echo $phone; ?></p>

    <h2>Update Information</h2>
    <form action="update_profile.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>

        <label for="address">Address:</label>
        <textarea name="address" id="address" required><?php echo $address; ?></textarea>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>" required>

        <input type="submit" value="Update">
    </form>

    <!-- Add your HTML content and other body elements here -->
</body>
</html>
