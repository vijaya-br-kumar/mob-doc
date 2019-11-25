<?php
require __DIR__ . '/../twig.php';
require_once(__DIR__.'/../dbConnection.php');

try
{
    $result = getData($conn);
    $result['message'] = (!$result['status'] && $result['message'] == "") ? "No Results Found" : "";
    echo $twig->render('frontend/view.html.twig', ['result' => $result]);
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