<?php
require_once '../classes/dbh.class.php';
require_once '../classes/user.class.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $connection = new Dbh();
    $dbh = $connection->connect();

    $obj = new User($dbh);
    $result = $obj->Login($email, $pwd);

    if ($result === true)
        header('Location: home.inc.php');
    else{
        echo $result . '<br>';
        // to move to the main page and show the errors
        header('Location: ../index.php?result='. $result);
    }
    $dbh = null;
    die();
}
