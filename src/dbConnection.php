<?php
require_once('constants.php');

$conn = null;
try
{
    $conn = new PDO(sprintf("mysql:host=%s;dbname=%s;", DB_HOST, DB_NAME), DB_USERNAME, DB_PASSWORD);
}
catch(PDOException $e)
{
    die( "Connection failed: " . $e->getMessage());
}