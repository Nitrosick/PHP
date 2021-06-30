<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    session_start();

    if (isset($_POST['reg_form'])) {
        $db = mysqli_connect("localhost", "root", "root", "geekbrains");

        $login = mysqli_real_escape_string($db, htmlspecialchars(strip_tags($_POST['login'])));
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT) ?? "";

        $select = mysqli_query($db, "INSERT INTO `users` (`login`, `password`) VALUES ('$login', '$password')");

        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP | Registration</title>
</head>
<body>
    <header>
        <a class="icon_link" href="index.php"><img src="icons/home.png" alt="icon"></a>
    </header>
    <main>
        <form method="post" enctype="multipart/form-data" action="">
            <label for="login">Логин</label>
            <input type="text" name="login" required><br>
            <label for="password">Пароль</label>
            <input type="password" name="password" required><br>
            <input type="submit" name="reg_form" value="Зарегистрироваться">
            <a href="login.php" class="button cancel">Отмена</a>
        </form>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
