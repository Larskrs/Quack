<?php 
    session_start(); // this will start a session.  We will use this to store the user's id.
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quak</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="/favicon.ico?">


    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="grid-item">
    <ul>
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <!-- If user is not logged in, blah blah. -->
        <?php
        if (isset($_SESSION['userUid'])) {
            echo '<li><a href="account.php">Account</a></li>';
        }
        else {
            echo '<li><a href="login.php">Login</a></li>';
        }
        ?>
    </ul>
    </nav>
