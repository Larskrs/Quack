<?php 

if (isset($_POST["submit"])) { // this checks if the user entered this page by clicking submit and not just moving into the page.

    session_start();
    
    $content = $_POST['content'];
    $title = $_POST['title'];
    $userId = $_SESSION['userId'];
    $file = $_FILES['file'];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    if (postEmptyFields($content, $title) !== false) {
        header("location: ../index.php?error=emptyfields");
        exit();
    }
    if (!empty($file)) {

        $fileDestination = uploadPostFile('uploads', $file);
        echo ($fileDestination);
        alert($fileDestination);
        postWithFile($conn, $userId, $content, $title, $fileDestination);
        exit();
    }
    echo 'n';
    exit();
    post($conn, $userId, $content, $title);



} else {
    header("location: ../index.php");
}