<?php
require __DIR__ . '/../../twig.php';
require __DIR__ . '/../../dbConnection.php';

try
{
    $result = getListData($conn);
    echo $twig->render('admin/BodyOrgans/list.html.twig', $result);
}
catch (\Exception $exception)
{
    die(sprintf("Error occurred: %s", $exception->getMessage()));
}

function getListData(PDO $conn)
{
    $result = ['status' => false, 'message' => "", 'data' => []];
    try
    {
        $records = $conn->prepare('SELECT bo.id, bo.name, bp.name as partName, bo.image_path as imagePath FROM body_organs bo LEFT JOIN body_parts bp ON bp.id = bo.body_parts');
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