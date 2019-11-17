<?php
require __DIR__ . '/../../twig.php';
require __DIR__ . '/../../dbConnection.php';

try
{
    $result = ['status' => true, 'message' => ""];
    if($_SERVER['REQUEST_METHOD'] == POST_METHOD)
    {
        $result = insertData($conn);
        if($result['status'])
        {
            header(sprintf("Location: %s%s", ADMIN_PATH, sprintf('BodyOrgans/show.php?id=%s&status=%s&message=%s', $result['id'] ?? "", true, "Added Successfully")));
        }
    }
    $bodyParts = getBodyParts($conn);
    $result['bodyParts'] = $bodyParts['status'] ? $bodyParts['data'] : [];
    echo $twig->render('admin/BodyOrgans/new.html.twig', $result);
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
        $records = $conn->prepare('INSERT INTO body_organs (name, image_path, body_parts) VALUES (:name, :image_path, :body_parts)');
        $records->bindParam(':name', $_POST['organName']);
        $records->bindParam(':body_parts', $_POST['bodyPartName']);
        $records->bindParam(':image_path', $_POST['imagePath']);
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

function getBodyParts(PDO $conn)
{
    $result = ['status' => false, 'message' => "", 'data' => []];
    try
    {
        $records = $conn->prepare('SELECT id,name FROM body_parts');
        $records->execute();
        $data = $records->fetchAll(PDO::FETCH_ASSOC);
        if(($data !== false) && (count($data) > 0))
        {
            $result['status'] = true;
            $result['data'] = $data;
        }
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