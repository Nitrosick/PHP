<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    session_start();

    if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
        die('Отказано в доступе');
    }

    if (empty($_GET['id'])) {
        die('Неверный id');
    }

    $id = (int)$_GET['id'];
    $db = mysqli_connect("localhost", "root", "root", "geekbrains");
    $product = mysqli_query($db, "SELECT * FROM `products` WHERE `id` = $id");
    $prod = mysqli_fetch_assoc($product);

    if (!$db) {
        die("Не удалось соединиться:" . mysqli_error($db));
    }

    if (!empty($_POST)) {
        $product_name = mysqli_real_escape_string($db, htmlspecialchars(strip_tags($_POST['product_name'])));
        $product_slot = mysqli_real_escape_string($db, htmlspecialchars(strip_tags($_POST['product_slot'])));
        $product_cost = (int) $_POST['product_cost'];
        $product_value = (float) $_POST['product_value'];
        $product_desc = mysqli_real_escape_string($db, htmlspecialchars(strip_tags($_POST['product_desc'])));

        if ($product_name != '' && $product_cost > 0 && $product_value > 0 && $product_desc != '') {
            mysqli_query($db, "UPDATE `products` SET
                               `product_name` = '$product_name',
                               `slot` = '$product_slot',
                               `cost` = $product_cost,
                               `value` = $product_value,
                               `description` = '$product_desc'
                               WHERE `id` = $id");
        } else {
            echo "Неверно заполнены поля формы";
        }

        if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] == 0) {
            if (preg_match("/^.*(\.jpg|\.jpeg|\.png)$/", $_FILES['image_upload']['name']) && $_FILES['image_upload']['size'] <= 3000000) {
                if (move_uploaded_file($_FILES['image_upload']['tmp_name'], '../images/' . $_FILES['image_upload']['name'])) {

                    if ($_FILES['image_upload']['name'] != $prod['file_name']) {
                        unlink("../images/{$prod['file_name']}");
                    }
                    mysqli_query($db, "UPDATE `products` SET
                               `file_name` = '{$_FILES['image_upload']['name']}'
                               WHERE `id` = $id");
                    header("Location: admin.php");
                } else {
                    echo "Ошибка при сохранении картинки";
                }
            } else {
                echo "Неправильный формат картинки!";
            }
        } else {
            header("Location: admin.php");
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
    <title>PHP | Edit product</title>
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
                }
                echo "<span class='user_name'>{$_SESSION['login']}</span>";
                echo '<a class="icon_link" href="../index.php?logout"><img src="../icons/logout.png" alt="icon"></a>';
            }
        ?>
    </header>
    <main class="add_page">
        <img class="edit_image" src="../images/<?= $prod['file_name'] ?>" alt="image">
        <form method="post" enctype="multipart/form-data" action="product_edit.php?id=<?= $id ?>">
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
            <label for="product_name">Название товара</label>
            <input type="text" name="product_name" value="<?= $prod['product_name'] ?>" required><br>
            <label for="product_slot">Слот</label>
            <select name="product_slot">
                <option value="Голова" <?= ($prod['slot'] == 'Голова') ? 'selected' : '' ?>>Голова</option>
                <option value="Шея" <?= ($prod['slot'] == 'Шея') ? 'selected' : '' ?>>Шея</option>
                <option value="Нагрудник" <?= ($prod['slot'] == 'Нагрудник') ? 'selected' : '' ?>>Нагрудник</option>
                <option value="Ноги" <?= ($prod['slot'] == 'Ноги') ? 'selected' : '' ?>>Ноги</option>
                <option value="Плащ" <?= ($prod['slot'] == 'Плащ') ? 'selected' : '' ?>>Плащ</option>
                <option value="Правая рука" <?= ($prod['slot'] == 'Правая рука') ? 'selected' : '' ?>>Правая рука</option>
                <option value="Левая рука" <?= ($prod['slot'] == 'Левая рука') ? 'selected' : '' ?>>Левая рука</option>
                <option value="Кольцо" <?= ($prod['slot'] == 'Кольцо') ? 'selected' : '' ?>>Кольцо</option>
                <option value="Разное" <?= ($prod['slot'] == 'Разное') ? 'selected' : '' ?>>Разное</option>
            </select>
            <label for="product_cost">Стоимость</label>
            <input type="number" name="product_cost" value="<?= $prod['cost'] ?>" required><br>
            <label for="product_value">Ценность</label>
            <input type="number" name="product_value" value="<?= $prod['value'] ?>" required><br>
            <label for="product_desc">Описание товара</label>
            <input type="text" name="product_desc" value="<?= $prod['description'] ?>" required><br>
            <label for="image_upload">Фотография товара</label>
            <input type="file" name="image_upload"><br>
            <input type="submit" value="Сохранить">
            <a href="admin.php" class="button cancel">Отмена</a>
        </form>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
