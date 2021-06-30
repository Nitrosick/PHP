<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    if (empty($_GET['id'])) {
        die('Неверный id');
    }

    $id = (int)$_GET['id'];
    $db = mysqli_connect("localhost", "root", "root", "geekbrains");
    $product = mysqli_query($db, "SELECT * FROM `products` WHERE `id` = $id");
    $prod = mysqli_fetch_assoc($product);

    if (!$db) {
        die("Не удалось соединиться:" . mysqli_error($db));
    } else {
        unlink("../images/{$prod['file_name']}");
        mysqli_query($db, "DELETE FROM `products` WHERE `id` = $id");
        header('Location: admin.php');
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
    <title>PHP | Remove product</title>
</head>
<body>
    <header></header>
    <main></main>
    <footer></footer>
</body>
</html>
