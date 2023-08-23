<!DOCTYPE html>
<html>
<head>
    <title>Booktopia - Sign Up</title>
    <style>
        body {
            background-color: #0f4c75;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #3282b8;
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
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: none;
        }

        .btn {
            display: inline-block;
            background-color: #1a6493;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0f4c75;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form action="create_account_backend.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Sign Up">
            </div>
        </form>
        <p>Already have an account? <a href="index.php">Log In</a></p>
    </div>
</body>
</html>
