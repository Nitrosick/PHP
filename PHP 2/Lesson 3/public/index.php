<?php
require_once '../vendor/autoload.php';

$db = mysqli_connect("localhost", "root", "root", "php2");
$select = mysqli_query($db, "SELECT * FROM `images`");

$images = [];
while ($i = mysqli_fetch_assoc($select)) {
    $images[] = $i;
}

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new Twig\Environment($loader, [
    'cache' => '../cache',
    'debug' => true
]);

if (isset($_GET['id'])) {
    echo $twig->render('product.html.twig', ['id' => $_GET['id']]);
} else {
    echo $twig->render('catalog.html.twig', ['images' => $images]);
}
