<?php
/*
Sean Hwang
2/2/2024
Deletes the desired file by unlinking them from the system. 
Since the user's file is not referenced anywhere else in the system, 
it will be completely terminated.
*/

session_start();
include 'operationLog.php';
//Blocks unauthorized access
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$eliminateFile = "/home/BearChopsticks/private/userFiles/".$_SESSION['username']."/".$_GET['file'];
//Grants permission to delete given files
chmod($eliminateFile, 0777);
//Delete file if exists
if (file_exists($eliminateFile)) {
    if (unlink($eliminateFile)) {
        echo "File Deleted!";
        logOperation('Delete', $_FILES['eliminateFile']['name']);
    } else {
        echo "Error Deleting...";
    }
} else {
    echo "Couldn't find file...";
}

?>
