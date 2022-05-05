<?php

if (isset($_POST["submit"])) { // this checks if the user entered this page by clicking submit and not just moving into the page.
    
    session_start();

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

    $postsId = $_GET['postsId'];

    echo 'You liked the post of: '.$postsId;

    $userId = $_SESSION['userId'];

    if (hasLiked($conn, $userId, $postsId)) {
        unlikePost($conn, $userId, $postsId);
    } else {
        likePost($conn, $userId, $postsId);
    }
    
} else {
    header("location: ../index.php");
}