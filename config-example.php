<?php declare(strict_types=1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "";
$user = "";
$pass = "";
$db = "";
$port = 0000;

$conn = mysqli_connect($host, $user, $pass, $db, $port);
mysqli_set_charset($conn, 'utf8mb4');

try {
    $conn = mysqli_connect($host, $user, $pass, $db);
    mysqli_set_charset($conn, 'utf8mb4');
} catch (mysqli_sql_exception $e) {
    exit('Connection failed: ' . $e->getMessage());
}

?>