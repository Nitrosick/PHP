<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    session_start();

    if (!isset($_SESSION['login'])) {
        die('Сначала авторизуйтесь');
    }

    $db = mysqli_connect("localhost", "root", "root", "geekbrains");

    if (!$db) {
        die("Не удалось соединиться:" . mysqli_error($db));
    } else {
        $login = $_SESSION['login'];
        $selectUserId = mysqli_query($db, "SELECT `id` FROM `users` WHERE `login` = '$login'");
        $userId = mysqli_fetch_assoc($selectUserId)['id'];

        $cartArr = mysqli_query($db, "SELECT c.*, p.file_name, p.product_name, p.cost FROM cart c
                                      INNER JOIN products p ON p.id = c.product_id
                                      WHERE `user_id` = $userId");
        $totalSelect = mysqli_query($db, "SELECT SUM(`cost` * `quantity`) AS `cost`, SUM(`quantity`) AS `quantity` FROM cart c
                                          INNER JOIN products p ON p.id = c.product_id
                                          WHERE `user_id` = $userId");
        $total = mysqli_fetch_assoc($totalSelect);

        if (isset($_GET['id']) && isset($_GET['delete'])) {
            $select = mysqli_query($db, "SELECT * FROM `cart` WHERE `product_id` = {$_GET['id']} AND `user_id` = $userId");
            $prod = mysqli_fetch_assoc($select);

            if ($prod['quantity'] != 1) {
                mysqli_query($db, "UPDATE `cart` SET `quantity` = `quantity` - 1 WHERE `product_id` = {$_GET['id']} AND `user_id` = $userId");
            } else {
                mysqli_query($db, "DELETE FROM `cart` WHERE `product_id` = {$_GET['id']} AND `user_id` = $userId");
            }
            header("Location: cart.php");
        }
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
    <title>PHP | Cart</title>
</head>
<body>
    <header>
        <a class="icon_link" href="index.php"><img src="icons/home.png" alt="icon"></a>
        <div class="plug"></div>
        <?php
            if (isset($_SESSION['login'])) {
                echo '<a class="icon_link" href="#" style="opacity: 0.5"><img src="icons/cart.png" alt="icon"></a>';
                if ($_SESSION['role'] == 'admin') {
                    echo '<a class="icon_link" href="admin/admin.php"><img src="icons/admin.png" alt="icon"></a>';
                }
                echo "<span class='user_name'>{$_SESSION['login']}</span>";
                echo '<a class="icon_link" href="index.php?logout"><img src="icons/logout.png" alt="icon"></a>';
            }
        ?>
    </header>
    <main>
        <?php
            while ($prod = mysqli_fetch_assoc($cartArr)) {
                echo "<div class='admin_product'>
                      <img class='admin_image' src='images/{$prod['file_name']}' alt='image'>
                      <span class='admin_name'>{$prod['product_name']}</span>
                      <div class='plug'></div>
                      <span class='admin_cost'>{$prod['cost']} золотых</span>
                      <span class='admin_qty'>{$prod['quantity']} шт.</span>
                      <a href='cart.php?id={$prod['product_id']}&delete' class='button delete_product'>Удалить из корзины</a>
                      </div>";
            }

            if (!$total['quantity']) {
                echo "Корзина пуста. Добавьте в нее немного товаров";
                echo "<a href='index.php' class='button cancel'>Каталог товаров</a>";
            } else {
                echo "<span class='cart_total'>В корзине {$total['quantity']} товар(а/ов) на сумму {$total['cost']} золотых</span>";
            }
        ?>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
