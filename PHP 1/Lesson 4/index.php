<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    $imagesArr = array_filter(scandir("./images"), function($file) {
        return !preg_match("/^\..*$/", $file) && !is_dir($file);
    });

    if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] == 0) {
        if (preg_match("/^.*(\.jpg|\.jpeg|\.gif)$/", $_FILES['image_upload']['name']) &&
            $_FILES['image_upload']['size'] <= 3000000) {
            if (move_uploaded_file($_FILES['image_upload']['tmp_name'], 'images/' . $_FILES['image_upload']['name'])) {
                header('Location: '.$_SERVER['PHP_SELF']);
            } else {
                echo "Ошибка при сохранении картинки";
            }
        } else {
            echo "Неправильный формат картинки!";
        }
    }
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
                foreach ($imagesArr as $img) {
                    echo "<a href='images/$img' target='_blank'><img class='picture' src='images/$img' alt='image' width='80'></a>";
                }
            ?>
        </div>
        <form method="post" enctype="multipart/form-data" action="index.php">
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
            <input type="file" name="image_upload" required><br>
            <input type="submit" value="Загрузить картинку">
        </form>
        <div class="modal">
            <img src="empty.png" alt="modal picture">
        </div>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
    <script>
        document.addEventListener('click', e => {
            if (e.target.className == 'picture') {
                document.querySelector('.modal img').src = e.target.src;
            }
        });
    </script>
</body>
</html>
