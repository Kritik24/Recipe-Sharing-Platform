<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; // Update this to your database password
$dbname = "project"; // Update this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Fetch user data
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Compare plain-text password
        if ($password === $user['password']) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header("Location: ../homepage.php");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No account found with this email.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NightOwls Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="main">
        <form action="" method="post">
            <h1>NightOwls Login</h1>
            <?php if ($error_message): ?>
                <p style="color: red;"><?= $error_message ?></p>
            <?php endif; ?>
            <?php if ($success_message): ?>
                <p style="color: green;"><?= $success_message ?></p>
            <?php endif; ?>
            <input type="email" name="email" placeholder="E-mail" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit" class="login">LOGIN</button><br><br>
            Don't have an account? <a href="signup.html">Sign up</a>
        </form>
    </div>
</body>
</html>