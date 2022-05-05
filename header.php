<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="inputTools.js"></script> 
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
        <nav>
            <ul>
                <li><a href="index.php">Hjem</a></li>
                <li><a href="">Venner</a></li>
                <?php if (isset($_SESSION['userName'])) {
                    echo '<li><a href="profile.php">'.$_SESSION['userName'].'</a></li>';
                } else {
                    echo '<li><a href="login.php">Login</a></li>';
                }
                ?>
            </ul>
        </nav>
    <div class="content-page">