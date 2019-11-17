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
    $result = getData($conn);
    if($result['status'])
    {
        $result = array_merge($_GET, ['data' => $result['data']]);
        echo $twig->render('admin/Disease/view.html.twig', $result);
    }
    else
    {
        header(sprintf("Location: %s%s", ADMIN_PATH, 'Disease/list.php'));
    }
}
catch (\Exception $exception)
{
    die(sprintf("Error occurred: %s", $exception->getMessage()));
}

/**
 * @param PDO $conn
 * @return array
 */
function getData(PDO $conn)
{
    $result = ['status' => false, 'message' => ""];
    try
    {
        $id = $_GET['id'] ?? "";
        $records = $conn->prepare('SELECT bd.id, bd.name, bo.name as organName, bd.image_path as imagePath, bd.description, bd.prescription FROM body_disease bd JOIN body_organs bo ON bo.id = bd.body_organs WHERE bd.id = :id');
        $records->bindParam(':id', $id);
        $records->execute();
        $data = $records->fetch(PDO::FETCH_ASSOC);
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