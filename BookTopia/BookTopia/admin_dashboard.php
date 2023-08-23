<!DOCTYPE html>
<html>
<head>
    <title>Booktopia - Upload Book</title>
    <style>
        /* Add your CSS styles here */
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

        input[type="text"],
        input[type="number"],
        input[type="file"] {
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
        .view_order_btn
        {
            position: absolute;
            top: 10px;
            right:200px;
            background-color: #3282b8;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .view_rental_btn
        {
            position: absolute;
            top: 10px;
            right:400px;
            background-color: #3282b8;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .logout_btn
        {
            position: absolute;
            top: 10px;
            right:1400px;
            background-color: #3282b8;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;

        }
        
    </style>
</head>
<body>
    <script>
        // Add your JavaScript functions here
    </script>

    <div class="mode-toggle">
        <button onclick="toggleMode()">Change Mode</button>
    </div>
    <div>
            <button class="view_order_btn" onclick="viewOrders()">View Orders</button>
            <button class="view_rental_btn" onclick="viewRentals()">View Rentals</button>
            <button class="logout_btn" onclick="admin_logout()">Logout</button>

    </div>
    <div class="container">
        <h2>Upload New Book</h2>
        
        <form action="upload_book.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" required>
            </div>
            <div class="form-group">
                <label for="publication_year">Publication Year</label>
                <input type="number" id="publication_year" name="publication_year" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="Rental_fee">Rental fee</label>
                <input type="number" id="rental_fee" name="rental_fee" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Upload">
            </div>
        </form>
        
    </div>

    <script>
        function toggleMode() {
            var body = document.querySelector('body');
            body.classList.toggle('night-mode');
        }

        function viewOrders() {
            // Redirect to the page for viewing orders
            window.location.href = "view_orders.php";
        }

        function viewRentals() {
            // Redirect to the page for viewing rentals
            window.location.href = "view_rentals.php";
        }
        function admin_logout() {
    // Redirect to the logout page or script
    window.location.href = "admin_logout.php";
}

    </script>
</body>
</html>
