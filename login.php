<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Login</title>
</head>

<body>
    <form action='login.php' method='post'>
        <label for='username'>Username:</label><br>
        <input type='text' id='username' name='username'><br>

        <label for='password'>Password:</label><br>
        <input type='text' id='password' name='password'><br>
        <input type='submit' value='Login'>
    </form>
</body>
</html>

<?php
/*
Sean Hwang
2/2/2024
Checks if the enteredUser exists in the users.txt 
and controls the session of the user. 
*/
session_start();

if ($_POST) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    //Methodology of ignoring new lines and empty lines provided by chatGPT
    $registeredUsers = file("/home/BearChopsticks/private/users.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $registeredPasswords = file("/home/BearChopsticks/public_html/passwords.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (usernameExists($username, $registeredUsers)) {
        //Makes sure the password is correct. 
        if($password == "cse330"){
            $_SESSION["username"] = $username;
            header("Location: home.php");
            exit();
        } else {
            echo "Wrong Password!";
        }
    } else {
        echo "You are not a registered user!";
    }
}

//Returns true if the provided username is present in the registeredUsers
function usernameExists($username, $registeredUsers)
{
    $length = count($registeredUsers);
    for ($i = 0; $i < $length; $i++) {
        if ($registeredUsers[$i] === $username) {
            return true;
        }
    }
    return false;
}
?>