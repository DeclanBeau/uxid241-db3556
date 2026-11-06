<?php declare(strict_types=1);
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require "config.php";
$conn = mysqli_connect($host, $user, $pass, $db);

session_destroy();

header("Location: login.php");
exit;
?>