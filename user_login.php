<?php declare(strict_types=1);
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require "config.php";
$conn = mysqli_connect($host, $user, $pass, $db);

if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="normalize" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h1> Login Successful </h1>  
  <a href="logout.php">Logout </a>
  <p><a href="index.php"> Back to Home</a></p>
</body>
</html>