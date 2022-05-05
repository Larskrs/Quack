<?php 

if (isset($_POST["submit"])) { // this checks if the user entered this page by clicking submit and not just moving into the page.

    session_start();

    $Bio = $_POST['bio'];
    $ppicture = $_FILES['profile'];
    $banner = $_FILES['banner'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (!empty($Bio)) {
        updateBio($conn, $Bio);
    }
    if (!empty($banner)) {
        uploadImageFile('uploads/profileBanners', $_SESSION['userUid'], $banner);
    }
    if (!empty($ppicture)) {
        alert(var_dump($ppicture));
        uploadImageFile('uploads/profileImages', $_SESSION['userUid'], $ppicture);
    }

    //header('location: ../account.php');

} else {
    header("location: ../index.php");
}