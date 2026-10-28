<?php declare(strict_types=1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/* week 02 work */
function post_value(string $key): string
{
    return trim($_POST[$key] ?? ' ');
}

$name_err = "";
$name = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = post_value("name");
    if (empty($_POST["name"])) {
        $name_err = "Name is required";
    }
}

/* week 03 work */
require "config.php";

$conn = mysqli_connect($host, $user, $pass, $db);

$result = mysqli_execute_query(
    $conn,
    'SELECT * FROM recipes',
);
/* $recipe = mysqli_fetch_assoc($result);
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <!-- week 02 work -->
    <p>Enter Name:
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>" />
        <span class="error"> <?php echo htmlspecialchars($name_err); ?> </span>
        <button type="submit" name="submit"> submit</button>
    </form>
    <?php
    if ($name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8')) {
        echo "welcome, $name";
    } ?>
    </p>

    <!-- week 03 work -->
    <h1>My Recipes</h1>

    <!-- beginning of AI written code -->
    <?php while ($recipe = mysqli_fetch_assoc($result)) { ?>

        <div class="recipe">

            <h2>
                <?php echo htmlspecialchars($recipe["title"]); ?>
            </h2>

        </div>

    <?php } ?>
    <!-- end of AI written code -->
</body>

</html>