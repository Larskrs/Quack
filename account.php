<div class="grid-container">
    
    
    <?php
include 'page-includes/header.php';
?>

<div class="mid">

<?php
        if (!isset($_SESSION['userUid'])) {
            header("location: index.php");
        } else {
            echo"<p>You are logged in!</p>";
        }
?>

        <ul>
            <form action="includes/logout.inc.php" method="post">
                <li><Button name="submit" type="submit" >Logout</Button></li>
            </form>
            <form action="includes/logout.inc.php" method="post">
                <li><Button name="submit" type="submit" style="border-color: crimson; border-style:solid;border-width:2px;color:aliceblue;background-color:red">Delete Account</Button></li>
            </form>
        </ul>

        </div>

<!-- Page Content -->

<?php
include 'page-includes/footer.php';
?>