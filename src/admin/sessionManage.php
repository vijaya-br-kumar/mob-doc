<?php
session_start();

/**
 * Function to verify the Post Login actions
 * @param PDO $conn
 * @return null
 */
function checkSessionExist(PDO $conn)
{
    $user = null;
    if( isset($_SESSION['user_id']) )
    {
        $records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
        $records->bindParam(':id', base64_decode($_SESSION['user_id']));
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        if( count($results) > 0)
        {
            $user = $results;
        }
    }
    return $user;
}

/**
 * Function to verify the Login actions
 * @param PDO $conn
 * @return mixed|null
 */
function verifyLogin(PDO $conn)
{
    $user = null;
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
        $records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        if(is_array($results) && count($results) > 0 && password_verify($_POST['password'], $results['password']))
        {
            $_SESSION['user_id'] = base64_encode($results['id']);
        }
        $user = $results;
    }
    return $user;
}