<?php
require_once(__DIR__.'/../constants.php');
require_once(__DIR__.'/../dbConnection.php');
require __DIR__ . '/../twig.php';
require_once('sessionManage.php');

checkLogin($conn, $twig);

function checkLogin(PDO $conn, \Twig\Environment $twig)
{
    $result = checkSessionExist($conn);
    if($result)
    {
        header(sprintf("Location: %s%s", ADMIN_PATH, 'dashboard.php'));
    }
    else
    {
        if($_SERVER['REQUEST_METHOD'] == POST_METHOD)
        {
            $result = createRegistration($conn);
            if($result['status'])
            {
                header(sprintf("Location: %s%s", ADMIN_PATH, 'dashboard.php'));
            }
            else
            {
                $result['registrationError'] = true;
                redirectRegistration($twig, $result);
            }
        }
        else
        {
            redirectRegistration($twig);
        }

    }
}

function redirectRegistration(\Twig\Environment $twig, $result = [])
{
    try
    {
        echo $twig->render('admin/registration.html.twig', $result);
    }
    catch (\Exception $exception)
    {
        die(sprintf("Error occurred: %s", $exception->getMessage()));
    }
}

function createRegistration(PDO $conn)
{
    $result = ['status' => false, 'message' => ""];
    try
    {
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $records = $conn->prepare('INSERT INTO users (email, password, first_name, last_name) VALUES (:email, :password, :first_name, :last_name)');
        $records->bindParam(':email', $email);
        $records->bindParam(':password', $password);
        $records->bindParam(':first_name', $firstName);
        $records->bindParam(':last_name', $lastName);
        $result['status'] = $records->execute();
        $result['status'] = true;
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