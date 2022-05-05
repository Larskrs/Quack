<?php
include 'header.php';
?>
<section class="singup-form">
        <h2>Sign Up</h2>
        <form action="includes/login.inc.php" method="post">
            <li><input onchange="selectInput('pswField')" id="uidField" type="text" name="uid" placeholder="Username/Email..."></li>
            <li><input type="password" name="pws" id="pwsField" placeholder="Password..."></li>
            <li><button type="submit" name="submit" style="margin:auto" >Log In</button>

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
                echo '<p class="success">Log in successful!</p>';
            }
        }
        ?>
        </section>
    </section>
        not logged in? register <a href="signup.php">here</a>
    </section>