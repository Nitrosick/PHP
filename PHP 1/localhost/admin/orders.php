<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    include '../functions.php';

    session_start();

    if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
        die('Отказано в доступе');
    }

    $db = db_connect();

    if (!$db) {
        die("Не удалось соединиться:" . mysqli_error($db));
    }

    $select = mysqli_query($db, "SELECT o.*, SUM(oi.quantity) AS qty, SUM(oi.cost) AS cost FROM orders o
                                 JOIN order_items oi ON o.id = oi.order_id
                                 GROUP BY o.id, `user_name`, user_phone, user_address, `status`");

    if (isset($_GET['send'])) {
        mysqli_query($db, "UPDATE `orders` SET `status` = 'отправлено' WHERE `id` = {$_GET['id']}");
        header('Location: orders.php');
    }

    if (isset($_GET['cancel'])) {
        mysqli_query($db, "UPDATE `orders` SET `status` = 'отменено' WHERE `id` = {$_GET['id']}");
        header('Location: orders.php');
    }

    if (isset($_POST['edit_form'])) {
        $name = safe_cont($db, 'str', $_POST['name']);
        $phone = safe_cont($db, 'int', $_POST['phone']);
        $address = safe_cont($db, 'str', $_POST['address']);

        if (user_info_val($name, $phone, $address)) {
            echo "<script>alert('Поля формы заполнены некорректно')</script>";
        } else {
            mysqli_query($db, "UPDATE `orders` SET
                               `user_name` = '$name',
                               `user_phone` = '$phone',
                               `user_address` = '$address'
                               WHERE `id` = {$_GET['id']}");

            header('Location: orders.php');
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
    <link rel="stylesheet" href="../style.css">
    <title>PHP | Orders</title>
</head>
<body>
    <header>
        <a class="icon_link" href="../index.php"><img src="../icons/home.png" alt="icon"></a>
        <div class="plug"></div>
        <?php
            if (isset($_SESSION['login'])) {
                echo '<a class="icon_link" href="../cart.php"><img src="../icons/cart.png" alt="icon"></a>';
                if ($_SESSION['role'] == 'admin') {
                    echo '<a class="icon_link" href="admin.php"><img src="../icons/admin.png" alt="icon"></a>';
                    echo '<a class="icon_link" href="#" style="opacity: 0.5"><img src="../icons/orders.png" alt="icon"></a>';
                }
                echo "<span class='user_name'>{$_SESSION['login']}</span>";
                echo '<a class="icon_link" href="../index.php?logout"><img src="../icons/logout.png" alt="icon"></a>';
            }
        ?>
    </header>
    <main class="orders_page">
        <table>
            <tr>
                <th>№ Заказа</th>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Адрес</th>
                <th>Статус</th>
                <th colspan="4">Содержимое заказа</th>
            </tr>
        <?php
            while ($order = mysqli_fetch_assoc($select)) {
                if ($order['status'] == 'заказано') {
                    echo "<form method='post' enctype='multipart/form-data' action='orders.php?id={$order['id']}'>
                          <tr>
                          <td>{$order['id']}</td>
                          <td class='button_cell'>
                          <input type='text' name='name' value='{$order['user_name']}'>
                          </td>
                          <td class='button_cell'>
                          <input type='text' name='phone' value='{$order['user_phone']}'>
                          </td>
                          <td class='button_cell'>
                          <input type='text' name='address' value='{$order['user_address']}'>
                          </td>
                          <td>{$order['status']}</td>
                          <td>{$order['qty']} ед. товара на сумму {$order['cost']} золотых</td>
                          <td class='button_cell'><a href='orders.php?id={$order['id']}&send' class='order_button'>Отправить заказ</a></td>
                          <td class='button_cell'><a href='orders.php?id={$order['id']}&cancel' class='order_button'>Отменить заказ</a></td>
                          <td class='button_cell'>
                          <input type='submit' value='' name='edit_form' class='order_refresh'>
                          </td>
                          </tr>
                          </form>";
                } else if ($order['status'] == 'отправлено') {
                    echo "<tr>
                          <td>{$order['id']}</td>
                          <td>{$order['user_name']}</td>
                          <td>{$order['user_phone']}</td>
                          <td>{$order['user_address']}</td>
                          <td>{$order['status']}</td>
                          <td colspan='4'>{$order['qty']} ед. товара на сумму {$order['cost']} золотых</td>
                          </tr>";
                } else {
                    echo "<tr>
                          <td colspan='9'>Заказ №{$order['id']} отменен</td>
                          </tr>";
                }
            }
        ?>
        </table>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
