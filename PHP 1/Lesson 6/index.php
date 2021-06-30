<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    $db = mysqli_connect("localhost", "root", "root", "geekbrains");

    if (!$db) {
        die("Не удалось соединиться:" . mysqli_error($db));
    } else {
        $prodArr = mysqli_query($db, "SELECT * FROM `products` ORDER BY `views` DESC");
    }

    mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP | Catalog</title>
</head>
<body>
    <header></header>
    <main>
        <div class="products_box">
            <?php
                while ($prod = mysqli_fetch_assoc($prodArr)) {
                    echo "<a class='product_tile' href='product.php?id={$prod['id']}'>
                          <img class='picture' src='images/{$prod['file_name']}' alt='image' width='80'>
                          <span class='product_title'>{$prod['product_name']}</span>
                          <span class='product_pre_cost'>{$prod['cost']} золотых</span>
                          </a>";
                }
            ?>
        </div>
        <a class="to_admin" href="admin/admin.php">Администрирование</a>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
