<?php
require_once '../vendor/autoload.php';

$db = mysqli_connect("localhost", "root", "root", "php2");
$select = mysqli_query($db, "SELECT `title`, `author`, `publisher`, `pages`, `cathegory` FROM `books`");

$array = [];
while ($a = mysqli_fetch_assoc($select)) {
    array_push($array, $a);
}

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new Twig\Environment($loader, [
    'cache' => '../cache',
    'debug' => true
]);

echo $twig->render('book.html.twig', ['array' => $array[0]]);
