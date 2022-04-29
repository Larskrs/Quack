<div class="grid-container">
    
    
    <?php
include 'page-includes/header.php';
?>

<div class="mid">

<?php

require 'includes/functions.inc.php';
require 'includes/dbh.inc.php';

        if (isset($_SESSION['userUid'])) {
            echo"<p>You are logged in!</p>";
            require 'post.php';
        }

        require 'page-includes\post-page.php';
        display_all($conn);
?>

</div>

<!-- Page Content -->

<?php
include 'page-includes/footer.php';
?>