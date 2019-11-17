<?php
require __DIR__ . '/../../twig.php';
require __DIR__ . '/../../dbConnection.php';
require __DIR__ . '/../sessionManage.php';

if(is_null(checkSessionExist($conn)))
{
    header(sprintf("Location: %s%s", ADMIN_PATH, 'login.php'));
}
try
{
    $result = ['status' => true, 'message' => ""];
    if($_SERVER['REQUEST_METHOD'] == POST_METHOD)
    {
        $result = insertData($conn);
        if($result['status'])
        {
           header(sprintf("Location: %s%s", ADMIN_PATH, sprintf('BodyParts/show.php?id=%s&status=%s&message=%s', $result['id'] ?? "", true, "Added Successfully")));
        }
    }
    echo $twig->render('admin/BodyParts/new.html.twig', $result);
}
catch (\Exception $exception)
{
    die(sprintf("Error occurred: %s", $exception->getMessage()));
}

/**
 * @param PDO $conn
 * @return array
 */
function insertData(PDO $conn)
{
    $result = ['status' => false, 'message' => ""];
    try
    {
        $records = $conn->prepare('INSERT INTO body_parts (name) VALUES (:name)');
        $records->bindParam(':name', $_POST['partName']);
        $result['status'] = $records->execute();
        $result['id'] = $conn->lastInsertId();
    }
    catch (\Exception $exception)
    {
        if($exception instanceof PDOException)
        {
            $result['message'] = $exception->errorInfo['2'] ?? $exception->getMessage();
        }
        else
        {
            $result['message'] = sprintf("Error occurred: %s", $exception->getMessage());
        }
    }
    return $result;
}