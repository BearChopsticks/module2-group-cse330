<?php
/*
Sean Hwang
2/2/2024
Extra functionality for the creative portion of the project.
Whenever the user Uploads or Deletes files, the operation type and date is logged.
*/
function logOperation($logAction, $loggedFile) {
    //Standard logging operations
    $timeInfo = date('Y-m-d H:i:s');
    $destination = 'operationLog.txt';
    $log = "$timeInfo: $logAction of $loggedFile\n";
    //Learned file_put_content operation from W3school php functions
    file_put_contents($destination, $log, FILE_APPEND);
}
?>