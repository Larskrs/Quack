<div class="grid-container">
    
    
    <?php
include 'page-includes/header.php';
?>

<div class="mid">

<?php
        if (isset($_SESSION['userUid'])) {
            echo"<p>You are logged in!</p>";
        }
?>

    Monkey is selling lemonade for $1.00
</div>

<!-- Page Content -->

<?php
include 'page-includes/footer.php';
?>