<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
?>


    <?php
        if (isset($_SESSION['userName'])) {
            require 'includes/post.php';
        } else {

        }
        include 'addons/post.php';
        display_all($conn);
    ?>

    
