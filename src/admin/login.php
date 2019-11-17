<?php
require_once(__DIR__.'/../constants.php');
require_once(__DIR__.'/../dbConnection.php');
require __DIR__ . '/../twig.php';
require_once('sessionManage.php');

checkLogin($conn, $twig);

function checkLogin(PDO $conn, \Twig\Environment $twig)
{
    $result = checkSessionExist($conn);
    if($result)
    {
        header(sprintf("Location: %s%s", ADMIN_PATH, 'dashboard.php'));
    }
    else
    {
        if($_SERVER['REQUEST_METHOD'] == POST_METHOD)
        {
            $result = verifyLogin($conn);
            if($result && count($result) > 0)
            {
                header(sprintf("Location: %s%s", ADMIN_PATH, 'dashboard.php'));
            }
            else
            {
                redirectLogin($twig, ['loginError' => true]);
            }
        }
        else
        {
            redirectLogin($twig);
        }

    }
}

function redirectLogin(\Twig\Environment $twig, $result = [])
{
    try
    {
        echo $twig->render('admin/login.html.twig', $result);
    }
    catch (\Exception $exception)
    {
        die(sprintf("Error occurred: %s", $exception->getMessage()));
    }
}