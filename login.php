<?php declare(strict_types=1);
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require "config.php";
$conn = mysqli_connect($host, $user, $pass, $db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST['password'];
    $sql = "SELECT user_id, email, password_hash FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user["password_hash"])) {
            session_regenerate_id(true);
            $_SESSION["user_id"] = $user["user_id"];
            header("Location: user_login.php");
            exit;
        } else {
            $error = "Invalid Email or Password";
        }
    } else {
        $error = "Invalid Email or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="normalize" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php
    if (isset($error)) {
        echo "<p>" . htmlspecialchars($error) . "</p>";
    }
    ?>
    <form method="POST" action="login.php">
    <label for="email"> Email </label>
    <input type="email" id="email" name="email" required>

    <label for="password"> Password </label>
    <input type="password" id="password" name="password" required>

    <button type="submit"> Log In </button>
    </form>
    <p> No account? <a href="register.php" target="_blank"> Register Here! </a> </p>
    <p><a href="index.php"> Back </a></p>
</body>

</html>