<?php 

if (isset($_POST["submit"])) { // this checks if the user entered this page by clicking submit and not just moving into the page.
   
    $username = $_POST["uid"];
    $password = $_POST["pws"];

    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    // error handling.

    if (emptyInputLogin($username, $password) !== false) {  // this checks if the user entered all the fields.
        header("location: ../login.php?error=emptyfields");
        exit();
    }
    if (invalidUid($username) !== false) {  // this checks if the user entered a valid username.
        header("location: ../login.php?error=invaliduid");
        exit();
    }

    loginUser($conn, $username, $password);

}  else {
    header("location: ../login.php?ah-ah-ah-sneaky-bastared");
}