<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    $id = $_GET['id'];

    $db = mysqli_connect("localhost", "root", "root", "geekbrains");

    if (isset($id)) {
        mysqli_query($db, "UPDATE `products` SET `views` = `views` + 1 WHERE `id` = {$id}");
        $info = mysqli_query($db, "SELECT * FROM `products` WHERE `id` = {$id}");
    } else {
        die("Неверный id товара");
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
    <title>PHP | Product</title>
</head>
<body>
    <header></header>
    <main class="product_page">
        <div class="product_info">
            <?php
                while ($i = mysqli_fetch_assoc($info)) {
                    echo "<img src='images/{$i['file_name']}'alt='photo' class='photo'>
                          <span class='product_name'>{$i['product_name']}</span>
                          <span class='product_slot'>Слот: {$i['slot']}</span>
                          <span class='product_cost'>Стоимость: {$i['cost']} золотых</span>
                          <span class='product_value'>Ценность: {$i['value']}</span>
                          <p class='product_text'>{$i['description']}</p>
                          <span class='product_views'>Просмотры: {$i['views']}</span>";
                }
            ?>
            <a href="index.php" class="button add_product">Закрыть</a>
        </div>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
