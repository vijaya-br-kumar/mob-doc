<?php
require __DIR__ . '/../twig.php';
require_once(__DIR__.'/../dbConnection.php');

try
{
    echo $twig->render('frontend/index.html.twig');
}
catch (\Exception $exception)
{
    die(sprintf("Error occurred: %s", $exception->getMessage()));
}