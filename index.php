<?php declare(strict_types=1);
function post_value(string $key): string
{
    return trim($_POST[$key] ?? ' ');
}

/* function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
} */

$name_err = "";
$name = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = post_value("name");
    if (empty($_POST["name"])) {
        $name_err = "Name is required";
    }
}

require "config.php";

$sql = "SELECT * FROM cookbook_recipes WHERE recipe_id = 1";
$result = mysquli_query($conn, $sql);
$recipe = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <p>Enter Name:
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="name" value="<?php echo $name ?>" />
        <span class="error"> <?php echo $name_err; ?> </span>
        <button type="submit" name="submit"> submit</button>
    </form>
    <?php
    if ($name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8')) {
        echo "welcome, $name";
    } ?>

    <h1>
        <?php echo htmlspecialchars($recipe["title"]); ?>
    </h1>
    </p>
</body>

</html>