<?php

if (isset($_POST["submit"])) { // this checks if the user entered this page by clicking submit and not just moving into the page.

    require_once 'functions.inc.php';

    logoutUser();

} else {
    header("location: ../index.php");
}