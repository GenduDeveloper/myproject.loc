<?php

require __DIR__ . '/../vendor/autoload.php';

$author = new \MyProject\Models\Users\User('Илья');
$article = new \MyProject\Models\Articles\Article('Заголовок', 'Текст', $author);
var_dump($article);