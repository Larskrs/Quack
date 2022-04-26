<?php 

if (isset($_POST["submit"])) { // this checks if the user entered this page by clicking submit and not just moving into the page.
   
    $name = $_POST["name"];
    $email = $_POST["email"];
    $uid = $_POST["uid"];
    $pws = $_POST["pws"];
    $pwsrepeat = $_POST["pwsrepeat"];

        // error handling.

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if ($name == "" || $email == "" || $uid == "" || $pws == "" || $pwsrepeat == "") {
        echo "Please fill in all fields.";
    } else {
        if ($pws != $pwsrepeat) {
            echo "Passwords do not match.";
        } else {
            if (strlen($pws) < 8) {
                echo "Password must be at least 8 characters.";
            } else {
                if (preg_match('/[A-Z]/', $pws) && preg_match('/[a-z]/', $pws) && preg_match('/[0-9]/', $pws)) {
                    $sql = "SELECT * FROM users WHERE usersUid='$uid'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        echo "Username already exists.";
                    } else {
                        $hashedPws = password_hash($pws, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES ('$name', '$email', '$uid', '$hashedPws')";
                        mysqli_query($conn, $sql);
                        header("Location: ../index.php?signup=success");
                        exit();
                    }
                } else {
                    echo "Password must contain at least one number and one uppercase and lowercase letter.";
                }
            }
        }
    }


}  else {
    header("location: ../index.php");
}
