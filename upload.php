<?php
/*
Sean Hwang
2/2/2024
Uploads new file to the user's session. 
New files are stored in a private folder under
each user's userFiles folder.
*/

session_start();
include 'operationLog.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

//General structure of wed security qualifications from chatgpt
if ($_POST) {
    if (isset($_FILES['fileToUpload'])) {

        //Code obtained from stakoverflow username Gumbo
        if (!file_exists("/home/BearChopsticks/private/userFiles/".$_SESSION['username']."/")) {
            mkdir("/home/BearChopsticks/private/userFiles/".$_SESSION['username']."/", 0777, true);
        }
        
        $targetFile = "/home/BearChopsticks/private/userFiles/".$_SESSION['username']."/".basename($_FILES['fileToUpload']['name']);
        $uploadOk = 1;
        //PATHFINO_EXTENSION method obtained from chatgpt
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if ($uploadOk && move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
            //Change file owner permission for later deletion
            chown($targetFile, $_SESSION['username']);
            echo "Upload Successful!! ".htmlspecialchars(basename($_FILES['fileToUpload']['name']));
            logOperation('Upload', $_FILES['fileToUpload']['name']);
        } else {
            echo "Upload Error!! ".htmlspecialchars(basename($_FILES['fileToUpload']['name']));
        }
    }
}
?>
