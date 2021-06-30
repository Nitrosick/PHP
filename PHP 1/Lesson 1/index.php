<?php
    $h1 = 'Заголовок страницы';
    $title = 'Тестовая страница';
    $year = date('Y');

    $a = 114;
    $b = 2;
    list($a, $b) = [$b, $a];
    echo "a = $a, b = $b";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <h1><?= $h1 ?></h1>
    <h2><?= $year ?></h2>
</body>
</html>
