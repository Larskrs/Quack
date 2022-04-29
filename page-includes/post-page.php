<?php 



    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';

    
    //$query = 'SELECT * FROM `posts` ORDER BY `postsId` DESC LIMIT 10';
    $sql = "SELECT * FROM posts ORDER BY postsId DESC LIMIT 10
    ";
    $result = mysqli_query($conn, $sql);


while($row = mysqli_fetch_assoc($result)) {
  
    
    
    $username = getUserFromPost($conn, $row);
    echo '<ul class="grid-container" style="background-color:white;">';
    echo '<div style="display: inline" class="grid-item">';
    echo '    <li><img class="grid-item" style="border-radius: 50%;"src="uploads/profileImages/'.$username.'.png" alt="" width="50" height="50"></li>';
    echo '    <li><h4>'.   $username    .'</h4><li>';
    echo '</div>';
    echo '<li style="width: 200%"class="grid-container"><table>';
        echo '<div class="post">';
            echo '<h3 style="text-align: left; padding-left: 10px">'. $row["postsTitle"].'</h3>'; 
            
            echo '<p>'.$row["postsContent"].'</p>';
        echo '</div>';
    echo '</table></li>';
echo '</ul>';  
  }


?>
<ul class="grid-container" style="background-color:white;">
    <div style="display: inline" class="grid-item">
        <li><img class="grid-item" style="border-radius: 50%;"src="uploads/profileImages/Larskrs.png" alt="" width="50" height="50"></li>
        <li><h4>Larskrs</h4><li>
    </div>
    <li style="width: 200%"class="grid-item"><table>
        <div class="post">
            <h3>Why I dislike Ireland</h3>
            <p>Eveyone is hella drunk.</p>
        </div>
    </table></li>
</ul>
