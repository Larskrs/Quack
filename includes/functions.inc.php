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
function getUsernameFromId($conn, $id) {
    $sql = "SELECT * FROM users WHERE usersId = ?";
    $stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php?error=stmtfailed");
    exit();
}
    mysqli_stmt_bind_param($stmt, "s", $id);
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $post = mysqli_fetch_assoc($result);

    $identity = $post['usersUid'];

    return $identity;
} 

function uploadImageFile($targetDirectory, $name, $file) {
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // error handling.

    header("location: ../account.php". $fileName) ;
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    

    if (in_array($fileActualExt, $allowed)) {
        echo 'file is image';
        if ($fileError === 0) {
            
            echo 'file has no error';
            if ($fileSize < 4000000) {
                echo 'file is not too big   ';
                $fileNameNew = $name . ".png";
                echo $fileNameNew;
                $fileDestination = '../'.$targetDirectory .'/'. $fileNameNew;
                if (file_exists($fileDestination)) {
                    unlink($fileDestination);
                }
                alert($fileDestination);
                move_uploaded_file($fileTmpName, $fileDestination);
                
            } else {
                echo "Your file is too big";
                header("location: ../profile.php?error=toobigprofilebanner");
                exit();
            }
        } else {
            echo "There was an error uploading your file";
                header("location: ../profile.php?error=unknown");
                exit();
        }
    } else {
                echo "You cannot upload files of this type";
                header("location: ../profile.php?error=wrongtype");
                exit();
    }
}
function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}
function fileTypeIs($file, $search) {
    $fileExt = explode('.', $file);
    $fileActualExt = strtolower(end($fileExt));

    return in_array($fileActualExt, $search);
}
function uploadPostFile($targetDirectory, $file) {

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // error handling.
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png','mp4','gif','mov');

    if (in_array($fileActualExt, $allowed)) {
        echo 'file is image';
        if ($fileError === 0) {
            echo 'file has no error';
            if ($fileSize < 40000000) {
                echo 'file is not too big   ';
                $fileNameNew = uniqid('', true) .'.'. $fileActualExt;
                $fileDestination = '../'.$targetDirectory .'/'. $fileNameNew;
                if (file_exists($fileDestination)) {
                    unlink($fileDestination);
                }
                $upload = move_uploaded_file($fileTmpName, $fileDestination);
                
                
                return $targetDirectory .'/'. $fileNameNew;
            } else {
                echo "Your file is too big";
                exit();
            }
        } else {
            echo "There was an error uploading your file";
                exit();
        }
    } else {
                echo "You cannot upload files of this type";
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
function getFileFromPost($conn, $postId) {
        $sql = "SELECT * FROM posts WHERE postsId = " . $postId;
        $result = mysqli_query($conn, $sql);

        $post = mysqli_fetch_assoc($result);

        $fileDestination = $post['postsFile'];

        return $fileDestination;
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
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
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
function postWithFile($conn, $userId, $content, $title, $file) {
    $sql = "INSERT INTO posts (postsOwnerId, postsContent, postsTitle, postsFile) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "isss", $userId, $content, $title, $file);
        mysqli_stmt_execute($stmt);
        header("location: ../index.php?post=success"); // if the sql statement is successful, we send the user to the signup page.
        exit();
    }
}
function getPostsLikeAmount($conn, $postsId) {
    $sql = "SELECT COUNT(*) FROM likes WHERE postId = ?";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../account.php?error=stmtfailed");
        exit();
    }
        mysqli_stmt_bind_param($stmt, "i", $postsId);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $data=mysqli_fetch_assoc($resultData);
        $result = $data['COUNT(*)'];
        return $result;
    mysqli_stmt_close($stmt); // closes the sql statement.
}
function unlikePost($conn, $userId, $postsId) {
    $sql = "DELETE FROM likes WHERE usersId = ? AND postId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ii", $userId, $postsId);
        mysqli_stmt_execute($stmt);
        header("location: ../#post".$postsId."?like=success");
        exit();
    }
}
function hasLiked($conn, $userId, $postId) {
    $result = false;

    $sql = "SELECT * FROM likes WHERE usersId = ? AND postId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=sqlerror");
        exit();
    }
        mysqli_stmt_bind_param($stmt, 'ii', $userId, $postId);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt); // gets the result of the sql statement.

    if ($row = mysqli_fetch_assoc($resultData)) { 
        return $row; //returns all the data of the user we found, can be used to automaticly login if everything is as it should be.
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt); // closes the sql statement.
}
function likePost($conn, $userId, $postId) {
    $sql = "INSERT INTO likes (postId, usersId) VALUES (?,?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ii", $postId, $userId);
        mysqli_stmt_execute($stmt);
        header("location: ../#post".$postId."?like=success");
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
            $_SESSION['userName'] = $uidExists['usersName'];
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