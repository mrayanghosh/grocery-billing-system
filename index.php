<?php
session_start();

$valid_username = "admin";
$valid_password = "12345";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION["logged_in"] = true;
        header("Location: stock.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
    header("Location: stock.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Grocery Billing System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-container">
        <h2>Grocery Billing System</h2>

        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" class="user" required>

            <label>Password</label>
            <input type="password" name="password" class="pass" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>