<?php declare(strict_types=1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function post_value(string $key): string
{
    return trim($_POST[$key] ?? ' ');
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF_8');
}
require "config.php";
$conn = mysqli_connect($host, $user, $pass, $db);

$result = mysqli_execute_query(
    $conn,
    'SELECT * FROM recipes',
);

echo "Recipes found: " . mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>My Recipes</h1>
    
    <?php while ($recipe = mysqli_fetch_assoc($result)) { ?>
    
        <div class="recipe">
    
            <h2>
                <?php echo htmlspecialchars($recipe["title"]); ?>
            </h2>
    
        </div>
    
    <?php } ?>
</body>

</html>