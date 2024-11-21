<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Sanitize and validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format!";
    } elseif (empty($password)) {
        $error_message = "Password cannot be empty!";
    } else {
        // Query to check admin credentials
        Database::setUpConnection(); // Ensure connection is set up
        $email = Database::$connection->real_escape_string($email);
        $password = Database::$connection->real_escape_string($password);

        $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
        $result = Database::search($query);

        if ($result->num_rows > 0) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin'] = $email;
            $_SESSION['login_time'] = time();
            header("Location: admin_home.php");
            exit;
        } else {
            $error_message = "Invalid email or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="admin_style.css">
</head>

<body class="admin_body">
    <div class="login-container">
        <form class="login-form shadow-lg" method="POST">
            <h2 class="text-center mb-4">Admin Login</h2>
            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block login-button">Login</button>
        </form>
    </div>

    <script src="admin_scripts.js"></script>
</body>

</html>
