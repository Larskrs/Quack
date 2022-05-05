<?php 

if (isset($_POST["submit"])) { // this checks if the user entered this page by clicking submit and not just moving into the page.
  
    $content = $_POST['content'];

    if (empty($content)) {
        header("location: ../accunt.php?error=emptyfields");
        exit();
    }

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    updateBio($conn, $content);
    alert('biography updated');


} else {
    header("location: ../account.php");
}