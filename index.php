<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: inlcudes/home.inc.php');
}

if(isset($_GET['success'])){
    echo '<p style = "background-color: #5a5;color:#0f0;font-weight:bold">'.$_GET['success'].'</p>';
}else
if(isset($_GET['result'])){
    echo '<p style = "background-color: #fee;color:#f33;font-weight:bold">'.$_GET['result'].'</p>';
}

require_once 'html/login.html';