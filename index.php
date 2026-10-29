<?php declare(strict_types=1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require "config.php";
$conn = mysqli_connect($host, $user, $pass, $db);


function post_value(string $key): string
{
    return trim($_POST[$key] ?? ' ');
}

$name_err = "";
$name = "";

//Search functionality
$search = trim($_GET["search"] ?? "");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = post_value("name");
    if (empty($_POST["name"])) {
        $name_err = "Name is required";
    }
}


//Limit recipes to 12 a page
$recipes_per_page = 12;

//Get page number from URL
$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;

if ($page < 1) {
    $page = 1;
}

//Where current page starts
$offset = ($page - 1) * $recipes_per_page;

//Check if there's a search, and count all recipes. If there is a search, gather all recipes with terms matching the search

//Counting Recipes
if ($search !== '') {

    $search_term = "%" . $search . "%";

    $count_sql = "SELECT COUNT(*) AS total
                  FROM recipes
                  WHERE title LIKE ? OR subtitle LIKE ?";

    $count_stmt = mysqli_prepare($conn, $count_sql);

    mysqli_stmt_bind_param(
        $count_stmt,
        "ss",
        $search_term,
        $search_term
    );

    mysqli_stmt_execute($count_stmt);

    $count_result = mysqli_stmt_get_result($count_stmt);

} else {

    $count_sql = "SELECT COUNT(*) AS total FROM recipes";

    $count_result = mysqli_query($conn, $count_sql);
}


$count_row = mysqli_fetch_assoc($count_result);

$total_recipes = $count_row["total"];

$total_pages = ceil($total_recipes / $recipes_per_page);

//Getting Recipes
if ($search !== '') {

    $sql = "SELECT * FROM recipes
            WHERE title LIKE ? OR subtitle LIKE ?
            ORDER BY recipe_id
            LIMIT ? OFFSET ?";

    $recipe_stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $recipe_stmt,
        "ssii",
        $search_term,
        $search_term,
        $recipes_per_page,
        $offset
    );

    mysqli_stmt_execute($recipe_stmt);

    $result = mysqli_stmt_get_result($recipe_stmt);

} else {

    $sql = "SELECT * FROM recipes
            ORDER BY recipe_id
            LIMIT $recipes_per_page
            OFFSET $offset";

    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="normalize" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <main>
        <h1>Recipes</h1>
        <?php

        ?>
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="search" placeholder="Search recipes"
                value="<?php echo htmlspecialchars($_GET["search"] ?? ""); ?>">

            <button type="submit">
                Search
            </button>
        </form>

        <!-- Handles building the cards with images, loops through the database to build it -->

        <div class="cards">
            <?php while ($recipe = mysqli_fetch_assoc($result)) { ?>
                <div class="card">
                    <div class="card-image">
                        <img src="<?php echo htmlspecialchars($recipe["main_image"] ?? ""); ?>"
                            alt="<?php echo htmlspecialchars($recipe["title"] ?? ""); ?> ">
                    </div>
                    <div class="card-content">
                        <h3>
                            <?php echo htmlspecialchars($recipe["title"]); ?>
                        </h3>
                        <h4>
                            <?php echo htmlspecialchars($recipe["subtitle"]); ?>
                        </h4>
                        <!--<p>
                            <?php echo htmlspecialchars($recipe["description"]); ?>
                        </p> -->
                        <div class="button-container">
                            <a class="button" href="recipe.php?id=<?php echo (int) $recipe["recipe_id"]; ?>"> View Recipe
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <a <?php if ($i == $page) { ?> class="active" <?php } ?>
                        href="index.php?page=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>

            <?php } ?>

        </div>

    </main>
</body>

</html>