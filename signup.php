<div class="grid-container">
    
    
    <?php
include 'page-includes/header.php';
?>

<div class="mid">
    <section class="singup-form">
        <h2>Sign Up</h2>
        <form action="includes/signup.inc.php" method="post">
            <li><input type="email" name="email" placeholder="Email..." required></li>
            <li><input type="text" name="name" placeholder="Full Name..." required></li>
            <li><input type="text" name="uid" placeholder="Username..." required></li>
            <li><input type="password" name="pws" placeholder="Password..." required></li>
            <li><input type="password" name="pwsrepeat" placeholder="Repeat Password..." required></li>
            <li><button type="submit" name="submit" >Sign Up</button>

        </form>
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