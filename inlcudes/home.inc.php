<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $email = $_SESSION['user_email'];
    echo 'welcome ' . $email . '<br>';
} ?>

<form action="home.inc.php" method="post">
    <input type="submit" name="logout" value="logout">
</form>


<?php
if (isset($_POST['logout'])) {
    require_once '../classes/user.class.php';
    $obj = new User(null);
    $obj->logout();

    header('Location: ../index.php');
}
