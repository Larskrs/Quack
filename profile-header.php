<?php

function displayProfile($conn, $userUid) {

    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
        mysqli_stmt_bind_param($stmt, "s", $userUid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        $userUid    = $row['usersUid'];
        $userEmail  = $row['usersEmail'];
        $userPwd    = $row['usersPwd'];
        $userBio    = $row['usersBio'];
        
        
        $profileImgFullName = "uploads/profileImages/".$userUid.".png";
        if (!file_exists($profileImgFullName)) {
            $profileImgFullName = "";
        }
        $profileBannerFullName = "uploads/profileBanners/".$userUid.".png";
        if (!file_exists($profileImgFullName)) {
            $profileBannerFullName = "";
        }
        
        
        echo('<div id="profile-section" class="profile-section" style="padding: 20px; background-size: cover; background-image: url('.$profileBannerFullName.');">');
        echo('<img style="border-radius: 50%; margin:auto; " id="output" src="'.$profileImgFullName.'" width="200" height="200">');
        echo('<div>');
        echo '<h2 font-size: 50;" >'.$userUid.'</h2>';
        echo '<textarea class="biographyTextArea" disabled font-size: 15; border-style: none;" >'.$userBio.'</textarea>';
        echo('</div>');
        echo('</div>');
    
}