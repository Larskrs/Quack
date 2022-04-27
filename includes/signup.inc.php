<?php 

if (isset($_POST["submit"])) { // this checks if the user entered this page by clicking submit and not just moving into the page.
   
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $password = $_POST["pws"];
    $passwordrepeat = $_POST["pwsrepeat"];

        // error handling.

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $username, $password, $passwordrepeat) !== false) {  // this checks if the user entered all the fields.
        header("location: ../signup.php?error=emptyfields");
        exit();
    }
    if (invalidUid($username) !== false) {  // this checks if the user entered a valid username.
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if (invalidEmail($email) !== false) {  // this checks if the user entered a valid username.
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($password, $passwordrepeat) !== false) {  // this checks if passwords match.
        header("location: ../signup.php?error=nopasswordmatch");
        exit();
    }
    if (userExists($conn, $username, $email) !== false) {  // this checks if the user already exists.
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    // if all the above checks are passed, then the user can sign up.

    createUser($conn, $name, $email, $username, $password);
    loginUser($conn, $username, $password); // log the new user in.

}  else {
    header("location: ../index.php");
}
