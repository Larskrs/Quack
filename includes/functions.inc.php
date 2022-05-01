<?php

function getIdFromUsername($conn, $username) {
        $sql = "SELECT * FROM users WHERE usersUid = ?";
        $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
        mysqli_stmt_bind_param($stmt, "s", $username);
        
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $post = mysqli_fetch_assoc($result);

        $username = $post['usersId'];

        return $username;
} 
function updateBanner($file) {
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // error handling.

    echo $fileName;

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 4000000) {
                session_start();
                $fileNameNew = $_SESSION['userUid'] . ".png";
                $fileDestination = '../uploads/profileBanners/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                

            } else {
                echo "Your file is too big";
                header("location: ../account.php?error=toobigprofilebanner");
                exit();
            }
        } else {
            echo "There was an error uploading your file";
                header("location: ../account.php?error=unknown");
                exit();
        }
    } else {
                echo "You cannot upload files of this type";
                header("location: ../account.php?error=wrongtype");
                exit();
    }
}
function updateProfilePicture($file) {
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // error handling.

    echo $fileName;

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 4000000) {
                session_start();
                $fileNameNew = $_SESSION['userUid'] . ".png";
                $fileDestination = '../uploads/profileImages/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                
            } else {
                echo "Your file is too big";
                header("location: ../account.php?error=toobigprofilebanner");
                exit();
            }
        } else {
            echo "There was an error uploading your file";
                header("location: ../account.php?error=unknown");
                exit();
        }
    } else {
                echo "You cannot upload files of this type";
                header("location: ../account.php?error=wrongtype");
                exit();
    }
}
function getBio($conn, $userUid) {
    $sql = "SELECT usersBio FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../account.php?error=stmtfailed");
        exit();
    }
        mysqli_stmt_bind_param($stmt, "s", $userUid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $userBio = $row['usersBio'];
        return $userBio;
}
function updateBio($conn, $content) {

    session_start();

    $sql = "UPDATE users SET usersBio = ? WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../account.php?error=stmtfailed");
        exit();
    }
        mysqli_stmt_bind_param($stmt, "ss", $content, $_SESSION['userUid']);
        
        mysqli_stmt_execute($stmt);
        echo $_SESSION['userUid'];
        echo $content;
}
function getUserFromPost($conn, $row) {
        $sql = "SELECT * FROM users WHERE usersId = " . $row['postsOwnerId'];
        $result = mysqli_query($conn, $sql);

        $post = mysqli_fetch_assoc($result);

        $username = $post['usersUid'];

        return $username;
}
function postEmptyFields($content, $title) {
    if (empty($content) || empty($title)) {
        return true;
    } else {
        return false;            
    }
}
function emptyInputSetProfilePicture($file) {
    if (empty($file)) {
        return true;
    } else {
        return false;
    }
}
function emptyInputSignup($name, $email, $username, $password, $passwordrepeat) {
    $result = false;
    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($passwordrepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function emptyInputLogin($username, $password) {
    $result = false;
    if (empty($username) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function emptyInputChangePass($username, $password, $newpassword) {
    $result = false;
    if (empty($username) || empty($password) || empty($newpassword)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidUid($username) {
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username && strlen($username) > 5)) { // checks if the user is using only letters and numbers and if the username is longer than 5 characters.
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidEmail($email) {
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // checks if the user entered a valid email.
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function pwdMatch($password, $passwordrepeat) {
    $result = false;
    if ($password !== $passwordrepeat) { // checks if the passwords match.
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function userExists($conn, $username, $email) {
    $result = false;

    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) { // Did the sql connection fail? if so we will send an stmtfailed error.
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email); // binds the parameters to the sql statement. the "ss" means that the parameters are two strings. we then add the parameters to the sql statement.
    mysqli_stmt_execute($stmt); // executes the sql statement.

    $resultData = mysqli_stmt_get_result($stmt); // gets the result of the sql statement.

    if ($row = mysqli_fetch_assoc($resultData)) { 
        return $row; //returns all the data of the user we found, can be used to automaticly login if everything is as it should be.
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt); // closes the sql statement.
}
function post($conn, $userId, $content, $title) {
    $sql = "INSERT INTO posts (postsOwnerId, postsContent, postsTitle) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "iss", $userId, $content, $title);
        mysqli_stmt_execute($stmt);
        header("location: ../index.php?post=success"); // if the sql statement is successful, we send the user to the signup page.
        exit();
    }
}
function createUser($conn, $name, $email, $username, $password) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?)"; // this is the sql statement that will be used to create the user.
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=sqlerror");
        exit();
    } else {
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT); // we make a new variable that hashes the password.
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd); // binds the parameters to the sql statement. the "ssss" means that the parameters are four strings. we then add the parameters to the sql statement.
        mysqli_stmt_execute($stmt); // executes the sql statement.
        header("location: ../index.php?signup=success"); // if the sql statement is successful, we send the user to the signup page.
        exit();
    }
}
function loginUser($conn, $username, $password) {
    $uidExists = userExists($conn, $username, $username); // if username is an email, it will return true aswell.

    if ($uidExists === false) {
        header("location: ../login.php?error=nouser");
        exit();
    } else {


        $pwdHashed = $uidExists['usersPwd']; // uidExists is an associative array, so we use the usersPwd key to get the hashed password.
        $checkPwd = password_verify($password, $pwdHashed); // we check if the password is correct.

        if ($checkPwd === false) { // is the password = to the stored password in the database?
            header("location: ../login.php?error=wrongpwd");
            exit();
        } else if ($checkPwd === true) {

                /* 
                *   We will store the user in a session.
                *   We can store the username and their id in the session.
                *   We can then use the session to check if the user is logged in, in other parts of the website.
                */

            session_start();
            $_SESSION['userId'] = $uidExists['usersId']; // if the password is correct, we store the users id in a session.
            $_SESSION['userUid'] = $uidExists['usersUid']; // we store the users uid in a session.
            header("location: ../index.php?login=success");
            exit();
        } else {
            header("location: ../login?error=wrongpwd");
            exit();
        }
    }
}
function passwordCorrect($conn, $username, $password) {
    $uidExists = userExists($conn, $username, $username); // if username is an email, it will return true aswell.

    if ($uidExists === false) {
        $result = $uidExists;
    } else {


        $pwdHashed = $uidExists['usersPwd']; // uidExists is an associative array, so we use the usersPwd key to get the hashed password.
        $checkPwd = password_verify($password, $pwdHashed); // we check if the password is correct.

        if ($checkPwd === false) { // is the password = to the stored password in the database?
            $result = false;
        } else if ($checkPwd === true) {
            $result = true;
        } else {
            $result = false;
        }
    }
}
function changePassword($conn, $username, $newPassword) {
    $sql = "UPDATE users SET usersPwd = ? WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../changepassword?error=sqlerror");
        exit();
    } else {
        $hashedPwd = password_hash($newPassword, PASSWORD_DEFAULT); // we make a new variable that hashes the password.
        mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $username); // binds the parameters to the sql statement. the "ss" means that the parameters are two strings. we then add the parameters to the sql statement.
        mysqli_stmt_execute($stmt); // executes the sql statement.
        header("location: ../changepassword?change=success");
        exit();
    }
}
function logoutUser() {
    session_start();
    session_unset();
    session_destroy();
    header("location: ../index.php?logout=success");
    exit();
}