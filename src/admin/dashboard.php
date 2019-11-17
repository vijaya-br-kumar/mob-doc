<?php
require __DIR__ . '/../twig.php';
require __DIR__ . '/sessionManage.php';

if(is_null(checkSessionExist($conn)))
{
    header(sprintf("Location: %s%s", ADMIN_PATH, 'login.php'));
}
try
{
    echo $twig->render('admin/dashboard.html.twig', ['name' => 'John Doe',
        'occupation' => 'gardener']);
}
catch (\Exception $exception)
{
    die(sprintf("Error occurred: %s", $exception->getMessage()));
}
