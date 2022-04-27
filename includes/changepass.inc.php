<?php

if (isset($_POST["submit"])) { // this checks if the user entered this page by clicking submit and not just moving into the page.
   
    $username = $_POST["uid"];
    $password = $_POST["pwd"];
    $newpassword = $_POST["newpwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // error handling.

    if (emptyInputChangePass($username, $password, $newpassword) !== false) {  // this checks if the user entered all the fields.
        header("location: ../changepass.php?error=emptyfields");
        exit();
    }
    if (userExists($conn, $username, $username) !== false) {  // this checks if the user entered a valid username.
        header("location: ../changepass.php?error=invaliduid");
        exit();
    }
    if (passwordCorrect($conn, $username, $password) !== false) {  // this checks if the user entered the correct username.
        header("location: ../changepass.php?error=wrongpass");
        exit();
    }

    changePassword($conn, $username, $newpassword);

} else {
    header("location: ../changepass.php?ah-ah-ah-sneaky-bastared");
}

?>