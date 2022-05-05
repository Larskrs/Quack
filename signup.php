<?php
include 'header.php';
?>
<section class="singup-form">
        <h2>Sign Up</h2>
        <form action="includes/signup.inc.php" method="post">
            <li><input type="email" name="email" placeholder="Email..."></li>
            <li><input type="text" name="name" placeholder="Full Name..."></li>
            <li><input type="text" name="uid" placeholder="Username..."></li>
            <li><input type="password" name="pws" placeholder="Password..."></li>
            <li><input type="password" name="pwsrepeat" placeholder="Repeat Password..."></li>
            <li><button type="submit" name="submit" >Sign Up</button>

        </form>
        
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p class="error">Fill in all fields!</p>';
            }
            else if ($_GET['error'] == "invaliduid") {
                echo '<p class="error">Invalid username!</p>';
            }
            else if ($_GET['error'] == "invalidemail") {
                echo '<p class="error">Invalid email!</p>';
            }
            else if ($_GET['error'] == "nopasswordmatch") {
                echo '<p class="error">Passwords do not match!</p>';
            }
            else if ($_GET['error'] == "usernametaken") {
                echo '<p class="error">Username already taken!</p>';
            }
        }
        else if (isset($_GET['signup'])) {
            if ($_GET['signup'] == "success") {
                echo '<p class="success">Sign up successful!</p>';
            }
        }
        ?>
        </section>