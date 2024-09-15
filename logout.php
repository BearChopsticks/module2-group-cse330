<?php
/*
Sean Hwang
2/2/2024
Logs out the current user session.
*/
session_start();

//Blocks unauthorized access
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

//Terminates session
session_destroy();
header('Location: login.php');
?>