<?php declare(strict_types=1);
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require "config.php";
$conn = mysqli_connect($host, $user, $pass, $db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? '');
    $password = $_POST["password"] ?? '';
    $confirm_password = $_POST["confirm_password"] ?? '';

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $sql = "SELECT user_id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0 ){
            $error = "Email is already registered";
        } else{ 
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO users (email, password_hash) VALUES (?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_sql);
            mysqli_stmt_bind_param($insert_stmt, "ss", $email, $password_hash);
            mysqli_stmt_execute($insert_stmt);
            echo "Account created successfully";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="normalize" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
<?php
if (isset($error)) {
    echo "<p>" . htmlspecialchars($error) . "</p>";
}
?>

    <form method="POST" action="register.php">
        <label for="email"> Email </label>
        <input type="email" id="email" name="email" required>
        
        <label for="password"> Password </label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password"> Confrim Password </label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type ="submit"> Register </button>
    </form>

    
</body>

</html>