<?php
declare(strict_types=1);

ini_set('error_reporting', (string)E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$db = mysqli_connect("localhost", "root", "root", "php2");
mysqli_query ($db, 'set character_set_results = "utf8"');

$select = mysqli_query($db, "SELECT * FROM `products` ORDER BY `id` LIMIT 25");

$products = array();
while($row = mysqli_fetch_assoc($select))
{
    $products[] = $row;
}

$select1 = mysqli_query($db, "SELECT COUNT(*) FROM `products`");
$total = (mysqli_fetch_row($select1)[0]);
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
	<title>PHP Pro | AJAX</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="scripts.js"></script>
</head>
<body>
    <main>
        <div id="products_box">
            <?php foreach ($products as $p) {
                echo "
                <div class='product'>
                    <span class='prod_name'>{$p['name']}</span>
                    <span class='prod_cost'>{$p['cost']} руб.</span>
                    <span class='prod_desc'>{$p['description']}</span>
                </div>
                ";
            }
            ?>
        </div>
        <button id="more">Ещё</button>
        <div class="data-php" data-attr="<?=$total; ?>"></div>
    </main>
</body>
</html>
