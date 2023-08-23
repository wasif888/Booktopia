<!DOCTYPE html>
<html>
<head>
    <title>Booktopia - Reset Password</title>
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
            width: 300px;
            margin: 0 auto;
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
        }

        label {
            display: block;
            text-align: left;
            color: #fff;
        }

        input[type="email"],
        input[type="password"] {
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
</head>
<body>
    <script>
        function toggleMode() {
            var body = document.querySelector('body');
            body.classList.toggle('night-mode');
        }
    </script>

    <div class="mode-toggle">
        <button onclick="toggleMode()">Change Mode</button>
    </div>

    <div class="container">
        <h2>Reset Password</h2>
        <form action="reset_password_backend.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Reset Password">
            </div>
        </form>
        <p>Remember your password? <a href="login.php">Log In</a></p>
    </div>

</body>
</html>
