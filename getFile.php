<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

/*
Sean Hwang
2/2/2024
Returns the desired file path under the user's session. 
Makes sure to block unauthorized access to the url.
*/
session_start();

//Blocks unauthorized access
if (!isset($_SESSION['username']) || !isset($_GET['file'])) {
    header('Location: login.php');
    exit();
} 

$package = "/home/BearChopsticks/private/userFiles/".$_SESSION['username']."/".$_GET['file'];
    //General structure obtained from stakoverflow
    header('Content-Type: '.mime_content_type($package));
    header('Content-Disposition: attachment; filename="'.basename($package).'"');
    readfile($package);
?>