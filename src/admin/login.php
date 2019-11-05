<?php
require_once(__DIR__.'/../constants.php');
require_once(__DIR__.'/../dbConnection.php');
require_once('sessionManage.php');

$result = checkSessionExist($conn);
if($result)
{
    header('Location: ../../templates/admin/dashboard.html');
}
else
{
    if($_SERVER['REQUEST_METHOD'] == POST_METHOD)
    {
        $result = verifyLogin($conn);
        if(count($result) > 0)
        {
            header('Location: ../../templates/admin/dashboard.html');
        }
        else
        {
            redirectLogin();
        }
    }
    else
    {
        redirectLogin();
    }

}

function redirectLogin()
{
    header('Location: ../../templates/admin/login.html');
}