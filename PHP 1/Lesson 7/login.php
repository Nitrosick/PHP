<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    session_start();

    if (isset($_POST['login_form'])) {
        $db = mysqli_connect("localhost", "root", "root", "geekbrains");

        $login = mysqli_real_escape_string($db, htmlspecialchars(strip_tags($_POST['login'])));
        $password = $_POST['password'] ?? "";

        $select = mysqli_query($db, "SELECT `password`, `role` FROM `users` WHERE login = '$login'");

        if ($user = mysqli_fetch_assoc($select)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['login'] = $login;
                $_SESSION['role'] = $user['role'];
                header('Location: index.php');
            } else {
                echo "<script>alert('Пароль неверный!')</script>";
            }
        } else {
            echo "<script>alert('Пользователь не найден')</script>";
        }
    }

    // Passwords
    // adminpass
    // userpass
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP | Login</title>
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
            <input type="submit" name="login_form" value="Авторизоваться">
            <a href="registration.php" class="button register">Регистрация</a>
        </form>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
