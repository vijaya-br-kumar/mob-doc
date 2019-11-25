<?php

require __DIR__ . '/../vendor/autoload.php';
require_once('constants.php');

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);
$twig->addFunction(new \Twig\TwigFunction('asset', 'asset'));
$twig->addFunction(new \Twig\TwigFunction('admin_path', 'adminPath'));
$twig->addFilter(new \Twig\TwigFilter('var_dump', 'dumpData'));
$twig->addFunction(new \Twig\TwigFunction('current_user', 'getCurrentUser'));
$twig->addFunction(new \Twig\TwigFunction('frontend_path', 'frontendPath'));

function asset($path = "")
{
    return sprintf("%s%s", ASSET_PATH, $path);
}

function adminPath($path = "")
{
    return sprintf("%s%s", ADMIN_PATH, $path);
}

function dumpData($data)
{
    var_dump($data);
}

function getCurrentUser()
{
    return $_SESSION['user_email'] ?? "";
}

function frontendPath($path = "")
{
    return sprintf("%s%s", FRONTEND_PATH, $path);
}