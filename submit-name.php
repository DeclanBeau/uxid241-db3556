<?php declare(strict_types=1); 
function post_value(string $key): string
{
    return trim($_POST[$key] ?? ' ');
}

function e(string $value): string{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF_8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<h1>Welcome!</h1>
 <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = post_value('name');
        echo "Welcome $name!";
    }
   /*  if (isset($_POST['name'])){
    $name = $_POST['name'];
    echo "Welcome $name!";
    } */
    ?>
<body>
    
</body>
</html>