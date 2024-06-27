<?php
require_once '../classes/dbh.class.php';
require_once '../classes/user.class.php';
require_once '../classes/validate.class.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $confirmPwd = $_POST['confirmPwd'];

// connect to database
    $connection = new Dbh();
    $dbh = $connection->connect();

    $validation = new Validate($email, $pwd, $confirmPwd, $dbh);

    if ($validation->validate() == 'validated') {
        $obj = new User($dbh);
        $obj->Register($email, $pwd);
        // to move to the main page and show the Signup Success message
        header('Location: ../index.php?success='. 'Signup Success!');
    } else {
        // to move to the main page and show the errors
        header('Location: ../index.php?result='. $validation->validate());
    }
    $dbh = null;
    die();
}
