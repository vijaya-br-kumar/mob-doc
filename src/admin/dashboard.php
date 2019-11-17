<?php
require __DIR__ . '/../twig.php';
try
{
    echo $twig->render('admin/dashboard.html.twig', ['name' => 'John Doe',
        'occupation' => 'gardener']);
}
catch (\Exception $exception)
{
    die(sprintf("Error occurred: %s", $exception->getMessage()));
}
