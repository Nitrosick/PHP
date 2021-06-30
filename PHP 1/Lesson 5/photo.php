<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    $id = $_GET['id'];

    $db = mysqli_connect("localhost", "root", "root", "geekbrains");

    if (isset($id)) {
        mysqli_query($db, "UPDATE `photos` SET `views` = `views` + 1 WHERE `id` = {$id}");
        $info = mysqli_query($db, "SELECT * FROM `photos` WHERE `id` = {$id}");
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
    <title>PHP | Photo</title>
</head>
<body>
    <header></header>
    <main class="photo_page">
        <div class="photo_info">
            <?php
                while ($i = mysqli_fetch_assoc($info)) {
                    echo "<img src='images/{$i['file_name']}' alt='photo' class='photo'><p class='photo_text'>{$i['description']}</p><span class='photo_views'>Просмотры: {$i['views']}</span>";
                }
            ?>
        </div>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
