<?php

if (isset($_POST["submit"])) { // this checks if the user entered this page by clicking submit and not just moving into the page.

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // error handling.

    echo $fileName;

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                session_start();
                $fileNameNew = $_SESSION['userUid'] . ".png";
                $fileDestination = '../uploads/profileImages/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                
                header("location: ../account.php?upload=success");
                exit();
            } else {
                echo "Your file is too big";
                header("location: ../account.php?error=toobigprofilepicture");
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




} else {
    header("location: ../index.php");
}