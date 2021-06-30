<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    $db = mysqli_connect("localhost", "root", "root", "geekbrains");

    $imagesArr = mysqli_query($db, "SELECT * FROM `photos` ORDER BY `views` DESC");

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
    <link rel="stylesheet" href="style.css">
    <title>PHP</title>
</head>
<body>
    <header></header>
    <main>
        <div class="images_box">
            <?php
                while ($photo = mysqli_fetch_assoc($imagesArr)) {
                    echo "<a href='photo.php?id={$photo['id']}'><img class='picture' src='images/{$photo['file_name']}' alt='image' width='80'><span>{$photo['photo_name']}</span></a>";
                }
            ?>
        </div>
        <span></span>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
