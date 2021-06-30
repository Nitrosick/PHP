<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    session_start();

    $db = mysqli_connect("localhost", "root", "root", "geekbrains");

    $id = $_GET['id'];

    if (isset($id)) {
        if (!isset($_GET['no_view'])) {
            mysqli_query($db, "UPDATE `products` SET `views` = `views` + 1 WHERE `id` = {$id}");
        }
        $info = mysqli_query($db, "SELECT * FROM `products` WHERE `id` = {$id}");
    } else {
        die("Неверный id товара");
    }

    $userId;
    if (isset($_SESSION['login'])) {
        $userIdSelect = mysqli_query($db, "SELECT `id` FROM `users` WHERE `login` = '{$_SESSION['login']}'");
        $userId = mysqli_fetch_assoc($userIdSelect)['id'];
    }

    if (isset($_GET['to_cart']) && isset($_SESSION['login'])) {
        $cartArr = mysqli_query($db, "SELECT * FROM cart
                                      WHERE `user_id` = $userId
                                      AND `product_id` = $id");

        $row_cnt = mysqli_num_rows($cartArr);
        if ($row_cnt == 0) {
            mysqli_query($db, "INSERT INTO `cart` (`user_id`, `product_id`) VALUES ($userId, $id)");
            header("Location: product.php?id=$id&no_view");
        } else {
            mysqli_query($db, "UPDATE `cart` SET `quantity` = `quantity` + 1
                               WHERE `user_id` = $userId
                               AND `product_id` = $id");
            header("Location: product.php?id=$id&no_view");
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
    <title>PHP | Product</title>
</head>
<body>
    <header>
        <a class="icon_link" href="index.php"><img src="icons/home.png" alt="icon"></a>
        <div class="plug"></div>
        <?php
            if (isset($_SESSION['login'])) {
                echo '<a class="icon_link" href="cart.php"><img src="icons/cart.png" alt="icon"></a>';
                if ($_SESSION['role'] == 'admin') {
                    echo '<a class="icon_link" href="admin/admin.php"><img src="icons/admin.png" alt="icon"></a>';
                }
                echo "<span class='user_name'>{$_SESSION['login']}</span>";
                echo '<a class="icon_link" href="index.php?logout"><img src="icons/logout.png" alt="icon"></a>';
            } else {
                echo '<a class="icon_link" href="login.php"><img src="icons/login.png" alt="icon"></a>';
            }
        ?>
    </header>
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

                    if (isset($_SESSION['login'])) {
                        echo "<a href='product.php?id={$i['id']}&to_cart&no_view' class='button add_to_cart'>Добавить в корзину</a>";
                    }
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
