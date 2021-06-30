<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    $db = mysqli_connect("localhost", "root", "root", "geekbrains");

    $prodArr = mysqli_query($db, "SELECT * FROM `products`");

    if (!$db) {
        die("Не удалось соединиться:" . mysqli_error($db));
    }

    mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>PHP | Admin</title>
</head>
<body>
    <header></header>
    <main>
        <a href="product_add.php" class="button add_product">Добавить товар</a>
        <?php
            while ($prod = mysqli_fetch_assoc($prodArr)) {
                echo "<div class='admin_product'>
                      <img class='admin_image' src='../images/{$prod['file_name']}' alt='image'>
                      <span class='admin_name'>{$prod['product_name']}</span>
                      <div class='plug'></div>
                      <a href='product_edit.php?id={$prod['id']}' class='button edit_product'>Редактировать товар</a>
                      <a href='product_remove.php?id={$prod['id']}' class='button delete_product'>Удалить товар</a>
                      </div>";
            }
        ?>
        <a href="../index.php" class="button add_product">Каталог товаров</a>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
