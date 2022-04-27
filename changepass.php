<div class="grid-container">
    
    
    <?php
include 'page-includes/header.php';
?>

<div class="mid">
<section class="singup-form">
        <h2>Change Password</h2>
        <form action="includes/changepass.inc.php" method="post">
            <li><input type="text" name="uid" placeholder="Username/Email..."></li>
            <li><input type="password" name="pwd" placeholder="Password..."></li>
            <li><input type="password" name="newpwd" placeholder="New Password..."></li>
            <li><button type="submit" name="submit" >Log In</button>

        </form>
        
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p class="error">Fill in all fields!</p>';
            }
            else if ($_GET['error'] == "nouser") {
                echo '<p class="error">There is no one with this name or email!</p>';
            }
            else if ($_GET['error'] == "invalidemail") {
                echo '<p class="error">Invalid email!</p>';
            }
            else if ($_GET['error'] == "wrongpwd") {
                echo '<p class="error">Missmatch >:( check your password, email or name.</p>';
            }
        }
        else if (isset($_GET['login'])) {
            if ($_GET['signup'] == "success") {
                echo '<p class="success">Sign up successful!</p>';
            }
        }
        ?>
        </section>
    </section>
        not logged in? register <a href="signup.php">here</a>
    </section>
</div>
<div class="right">
    <ul>
        <li>Monkey</li>
        <li>Monkey</li>
        <li>Monkey</li>
    </ul>
    Monkey
    Norway
    Lorum
</div>


</div>

<!-- Page Content -->

<?php
include 'page-includes/footer.php';
?>