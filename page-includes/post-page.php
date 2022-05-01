<?php 

    function display_profile_posts($conn, $postsOwnerId) {
        
    //$query = 'SELECT * FROM `posts` ORDER BY `postsId` DESC LIMIT 10';
    $sql = "SELECT * FROM posts WHERE postsOwnerId = ? ORDER BY postsId DESC LIMIT 10";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
        mysqli_stmt_bind_param($stmt, "i", $postsOwnerId);
        
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

while($row = mysqli_fetch_assoc($result)) {
  

    $username = getUserFromPost($conn, $row);
    echo '<ul class="grid-container" style="background-color:white;">';
    echo '<a href="profile.php?username='.$username.'" style="display: inline" class="grid-item">';
    echo '    <li><img class="grid-item" style="border-radius: 50%;"src="uploads/profileImages/'.$username.'.png" alt="" width="50" height="50"></li>';
    echo '    <li><h4>'.   $username    .'</h4><li>';
    echo '</a>';
    echo '<li style="width: 200%"class="grid-container"><table>';
        echo '<div class="post">';
            echo '<h3 style="text-align: left; padding-left: 10px">'. $row["postsTitle"].'</h3>'; 
            
            echo '<textarea style=" width: 500px"disabled>'.$row["postsContent"].'</textarea>';
        echo '</div>';
    echo '</table></li>';
echo '</ul>';  
  }

}
    



    function display_all($conn) {


    //$query = 'SELECT * FROM `posts` ORDER BY `postsId` DESC LIMIT 10';
    $sql = "SELECT * FROM posts ORDER BY postsId DESC LIMIT 10
    ";
    $result = mysqli_query($conn, $sql);


while($row = mysqli_fetch_assoc($result)) {
  

    $username = getUserFromPost($conn, $row);
    echo '<ul class="grid-container" style="background-color:white;">';
    echo '<a href="profile.php?username='.$username.'" style="display: inline" class="grid-item">';
    echo '    <li><img class="grid-item" style="border-radius: 50%;"src="uploads/profileImages/'.$username.'.png" alt="" width="50" height="50"></li>';
    echo '    <li><h4>'.   $username    .'</h4><li>';
    echo '</a>';
    echo '<li style="width: 200%"class="grid-container"><table>';
        echo '<div class="post">';
            echo '<h3 style="text-align: left; padding-left: 10px">'. $row["postsTitle"].'</h3>'; 
            
            echo '<textarea style=" width: 500px"disabled>'.$row["postsContent"].'</textarea>';
        echo '</div>';
    echo '</table></li>';
echo '</ul>';  
  }

  

}
