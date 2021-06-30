<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    function db_connect() {
        return mysqli_connect("localhost", "root", "root", "geekbrains");
    }

    function get_user_id($db, $login) {
        $select = mysqli_query($db, "SELECT `id` FROM `users` WHERE `login` = '$login'");
        return mysqli_fetch_assoc($select)['id'];
    }

    function safe_cont($db, $type, $content) {
        switch ($type) {
            case 'str' :
                return mysqli_real_escape_string($db, htmlspecialchars(strip_tags($content)));
                break;
            case 'int' :
                return (int) $content;
                break;
            case 'float' :
                return (float) $content;
                break;
        }
    }

    function file_format() {
        return preg_match("/^.*(\.jpg|\.jpeg|\.png)$/", $_FILES['image_upload']['name']) && $_FILES['image_upload']['size'] <= 3000000;
    }

    function user_info_val($name, $phone, $address) {
        return (!preg_match("/^[a-zA-Zа-яёА-ЯЁ]+$/ui", $name) || !preg_match("/^[0-9]{11}$/", $phone . '') || $address == '');
    }
?>
