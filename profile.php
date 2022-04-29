<div class="grid-container">
    
    
    <?php
include 'page-includes/header.php';
    require 'includes/functions.inc.php';
    require 'includes/dbh.inc.php';
?>


<div class="mid">

<?php

if (isset($_GET['error'])) {
    if ($_GET['error'] == "unknown") {
        echo '<p class="error">uknown error occured!</p>';
    }
}
    else if (isset($_GET['username'])) {

            if (invalidUid($_GET['username'])) {
                echo '<p class="error">Invalid username!</p>';
            }
            else {
                $username = $_GET['username'];
                
                require 'page-includes\profile-header.php';
                displayProfile($conn, $username);
                require 'page-includes\post-page.php';
                display_profile_posts($conn, getIdFromUsername($conn, $username));
            }
    }
?>

</div>

<!-- Page Content -->

<?php
include 'page-includes/footer.php';
?>