<?php
    $username = "";
    $userId = "";
    $postId = "";
    
    include_once 'includes/functions.inc.php';

    function display($conn, $post) {
        
        $postsId = $post['postsId'];

        $likes = getPostsLikeAmount($conn, $postsId);
        
        $postTitle = $post['postsTitle'];
        $username = getUserFromPost($conn, $post);
        $content = $post['postsContent'];
        echo '
                <div class="post post-animation">
                <div class="pf_header">
                    <img src="uploads/profileImages/'.$username.'.png" width="25px" height="25px";</img>
                    '.$username.'
                </div>
                ';

                $fileDestination = getFileFromPost($conn, $postsId);

                $imageTypes = array('png','jpg','jpeg', 'gif');
                $videoTypes = array('mp4','mov');

                    if (fileTypeIs($fileDestination, $imageTypes)) {
                        echo '<img src="'.$fileDestination.'" class="post-img">';
                    } 
                    if (fileTypeIs($fileDestination, $videoTypes)) {
                        echo '
                        <video controls>
                        <source src="'.$fileDestination.'" type="video/mp4">
                        Your browser does not support the video tag.
                        </video> 
                        ';
                    }

                echo '
                <div class="post-content">
                    <h3>'.$postTitle.'</h3>
                    <textarea name="" id="" disabled>'.$content.'</textarea>
                </div>
            </div>
        ';
        
    }
    function display_all ($conn) {
        //$query = 'SELECT * FROM `posts` ORDER BY `postsId` DESC LIMIT 10';
        $sql = "SELECT * FROM posts ORDER BY postsId DESC LIMIT 10";
        $result = mysqli_query($conn, $sql);


    while($row = mysqli_fetch_assoc($result)) {
                display($conn, $row);
            }
    }


    /*

    <div class="post">
    <div class="pf_header">
        Lars Kristian
    </div>
    <img src="https://images.pexels.com/photos/11031106/pexels-photo-11031106.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" class="post-img">
    <div class="post-content">
        <h3>Flyr etter solnedgangen</h3>
        <textarea name="" id="" disabled>This was a really fun experience</textarea>
    </div>
</div>

*/

?>

<script>
    const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    const square = entry.target.querySelector('.post');

    if (entry.isIntersecting) {
      square.classList.add('post-animation');
	  return; // if we added the class, exit the function
    }

    // We're not intersecting, so remove the class!
    square.classList.remove('post-animation');
  });
});

observer.observe(document.querySelector('.post'));
</script>