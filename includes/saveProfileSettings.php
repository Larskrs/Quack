<?php 

if (isset($_POST["submit"])) { // this checks if the user entered this page by clicking submit and not just moving into the page.

    $Bio = $_POST['bio'];
    $ppicture = $_FILES["fileToUpload"];
    $banner = $_POST['banner'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (!empty($Bio)) {
        updateBio($conn, $Bio);
    }
    if (!empty($ppicture)) {
        updateProfilePicture($ppicture);
    }
    if (!empty($banner)) {
        updateBanner($banner);
    }

} else {
    header("location: ../index.php");
}