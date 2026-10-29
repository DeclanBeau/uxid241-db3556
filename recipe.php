<?php declare(strict_types=1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require "config.php";
$conn = mysqli_connect($host, $user, $pass, $db);

$id = (int) $_GET["id"];

$sql = "SELECT * FROM recipes WHERE recipe_id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$recipe = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe</title>
    <link rel="normalize" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <main>
        <h1>
            <?php echo htmlspecialchars($recipe["title"]); ?>
        </h1>
        <h2>
            <?php echo htmlspecialchars($recipe["subtitle"]); ?>
        </h2>
        <img src="<?php echo htmlspecialchars($recipe["main_image"] ?? ""); ?>"
        alt="<?php echo htmlspecialchars($recipe["title"] ?? ""); ?>">
        <p>
            <?php echo htmlspecialchars($recipe["description"]); ?>
        </p>
        <div class="button-container">
            <a class="button" href="index.php"> Back </a>
    </main>
</body>

</html>