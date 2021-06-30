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
    } else {
        if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] == 0) {
            if (file_format()) {
                if (move_uploaded_file($_FILES['image_upload']['tmp_name'], '../images/' . $_FILES['image_upload']['name'])) {

                    $product_name = safe_cont($db, 'str', $_POST['product_name']);
                    $product_slot = safe_cont($db, 'str', $_POST['product_slot']);
                    $product_desc = safe_cont($db, 'str', $_POST['product_desc']);
                    $product_cost = safe_cont($db, 'int', $_POST['product_cost']);
                    $product_value = safe_cont($db, 'float', $_POST['product_value']);

                    if ($product_name != '' && $product_cost > 0 && $product_value > 0 && $product_desc != '') {
                        mysqli_query($db, "INSERT INTO `products` (`file_name`, `product_name`, `slot`, `cost`, `value`, `description`)
                                           VALUES ('{$_FILES['image_upload']['name']}', '$product_name', '$product_slot', $product_cost, $product_value, '$product_desc')");
                        header('Location: admin.php');
                    } else {
                        echo "Неверно заполнены поля формы";
                    }
                } else {
                    echo "Ошибка при сохранении картинки";
                }
            } else {
                echo "Неправильный формат картинки!";
            }
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
    <title>PHP | Add product</title>
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
                    echo '<a class="icon_link" href="orders.php"><img src="../icons/orders.png" alt="icon"></a>';
                }
                echo "<span class='user_name'>{$_SESSION['login']}</span>";
                echo '<a class="icon_link" href="../index.php?logout"><img src="../icons/logout.png" alt="icon"></a>';
            }
        ?>
    </header>
    <main class="add_page">
        <form method="post" enctype="multipart/form-data" action="product_add.php">
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
            <label for="product_name">Название товара</label>
            <input type="text" name="product_name" required><br>
            <label for="product_slot">Слот</label>
            <select name="product_slot">
                <option value="Голова">Голова</option>
                <option value="Шея">Шея</option>
                <option value="Нагрудник">Нагрудник</option>
                <option value="Ноги">Ноги</option>
                <option value="Плащ">Плащ</option>
                <option value="Правая рука">Правая рука</option>
                <option value="Левая рука">Левая рука</option>
                <option value="Кольцо">Кольцо</option>
                <option value="Разное">Разное</option>
            </select>
            <label for="product_cost">Стоимость</label>
            <input type="number" name="product_cost" required><br>
            <label for="product_value">Ценность</label>
            <input type="number" name="product_value" required><br>
            <label for="product_desc">Описание товара</label>
            <input type="text" name="product_desc" required><br>
            <label for="image_upload">Фотография товара</label>
            <input type="file" name="image_upload" required><br>
            <input type="submit" value="Добавить">
            <a href="admin.php" class="button cancel">Отмена</a>
        </form>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
