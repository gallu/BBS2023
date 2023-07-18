<?php  // twig_test.php

require_once __DIR__ . '/vendor/autoload.php';

/*
$loader = new \Twig\Loader\ArrayLoader([
    'index' => 'Hello {{ name }}!',
    'index2' => 'こんにちは {{ name }}!',
]);
*/
$templates_dir = __DIR__ . '/templates';
$loader = new \Twig\Loader\FilesystemLoader($templates_dir);
$twig = new \Twig\Environment($loader);

echo $twig->render('index2.twig', ['name' => 'おいちゃん']) , "\n";
