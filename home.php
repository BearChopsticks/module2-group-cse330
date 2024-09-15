<?php
/*
Sean Hwang
2/2/2024
Beginning of the file sharing site logic. 
If no session exists, redirects to login.php. 
Otherwise, lists the files of the logged in user.
*/
session_start();

//If no session, redirect to login.php
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

//Stores all of the user's files
$userFiles = glob("/home/BearChopsticks/private/userFiles/".$_SESSION['username']."/*.*");
$logFile = 'operationLog.txt';
echo "<strong>Welcome back!  ".htmlspecialchars($_SESSION['username'])."<br><br>";
echo "<strong>Your Files<br>";

//Lists all of the user's files in userFiles
for ($i = 0; $i < count($userFiles); $i++) {
    $file = $userFiles[$i];
    $webPath = "getFile.php?file=".basename($file);
    //Delete function call method provided by chatgpt
    echo "<a href='" . htmlspecialchars($webPath)."'>".basename($file)."</a>";
    echo " <a href='delete.php?file=".basename($file)."'>Delete</a><br>";
}

//Upload new file section
echo "<br>";
echo "<strong>Upload a file<br>";
echo "<form action='upload.php' method='post' enctype='multipart/form-data'>";
echo "<input type='file' name='fileToUpload' id='fileToUpload'>";
echo "<input type='submit' value='Upload File' name='submit'>";
echo "<br>";
echo "<br>";

//Logout
echo "<a href='logout.php'>Logout</a><br>";

echo "<br>";
echo "<br>";


echo "<strong>Upload && Delete Operation Log<br>";
if (file_exists($logFile)) {
    $logEntries = file_get_contents($logFile);
    echo nl2br($logEntries);
} else {
    echo "No operation logs available.";
}
?>