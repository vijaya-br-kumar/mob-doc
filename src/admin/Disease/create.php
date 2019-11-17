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
            header(sprintf("Location: %s%s", ADMIN_PATH, sprintf('Disease/show.php?id=%s&status=%s&message=%s', $result['id'] ?? "", true, "Added Successfully")));
        }
    }
    $bodyOrgans = getBodyOrgans($conn);
    $result['bodyOrgans'] = $bodyOrgans['status'] ? $bodyOrgans['data'] : [];
    echo $twig->render('admin/Disease/new.html.twig', $result);
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
        $records = $conn->prepare('INSERT INTO body_disease (name, image_path, body_organs, description, prescription) VALUES (:name, :image_path, :body_organ, :description, :prescription)');
        $records->bindParam(':name', $_POST['diseaseName']);
        $records->bindParam(':body_organ', $_POST['bodyOrganName']);
        $records->bindParam(':image_path', $_POST['imagePath']);
        $records->bindParam(':description', $_POST['diseaseDescription']);
        $records->bindParam(':prescription', $_POST['diseasePrescription']);
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

function getBodyOrgans(PDO $conn)
{
    $result = ['status' => false, 'message' => "", 'data' => []];
    try
    {
        $records = $conn->prepare('SELECT id,name FROM body_organs');
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