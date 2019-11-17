<?php
require __DIR__ . '/../../twig.php';
require __DIR__ . '/../../dbConnection.php';

try
{
    $result = getListData($conn);
    echo $twig->render('admin/BodyParts/list.html.twig', $result);
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
        $records = $conn->prepare('SELECT bp.id, bp.name FROM body_parts bp');
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