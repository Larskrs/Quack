<div class="grid-container">
    
    
    <?php
include 'page-includes/header.php';
require_once 'includes/dbh.inc.php';
?>

<div class="mid">

<?php
        if (!isset($_SESSION['userUid'])) {
            header("location: index.php");
            exit();
        }
?>
                
                <?php
                require 'page-includes/profile-header.php';
                displayProfile($conn, $_SESSION['userUid']);
                ?>
        
<ul>
        
        
        <div class="grid-container">
                <div class="grid-item" style="grid-area: mid;">

                    <div class="grid-item profileImg">

                        <h2>Profile Image</h2>
                        <form action="includes/setprofilepicture.inc.php" method="post" enctype="multipart/form-data">
                            <li><input name="file" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"></li>
                            <li><button style="margin:auto;height:40px" name="submit" type="submit">Upload</button></li>
                        </form>

                    </div>

                    <div class="grid-item profileBanner"> 
                    <h2>Profile Banner</h2>
                    <form action="includes/setprofilebanner.inc.php" method="post" enctype="multipart/form-data">
                        <li><input name="file" type="file" accept="image/*" onchange="document.getElementById('profile-section').style = 'background-size: cover;background-image: url(' + window.URL.createObjectURL(this.files[0]) + ')'"></li>
                        <li><button style="margin:auto;height:40px" name="submit" type="submit">Upload</button></li>
                    </form>

                    </div>
                </div>
                    <form action="includes/setprofilebio.inc.php" method="post" enctype="multipart/form-data">
                    <li><textarea name="content" id="content" class="textInputArea" cols="15" rows="2" maxlength=48 placeholder="Content..."></textarea></li>
                    <li><button style="margin:auto;" type="submit" name="submit" required>Send</button><li>
                    </form>
                    
                    <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error'] == "unknown") {
                                echo '<p class="error">uknown error occured!</p>';
                            }
                            else if ($_GET['error'] == "toobigprofilepicture") {
                                echo '<p class="error">The file you uploaded was too big!</p>';
                            }
                            else if ($_GET['error'] == "wrongtype") {
                                echo '<p class="error">Wrong file type! only use image files.</p>';
                            }
                        }
                        else if (isset($_GET['upload'])) {
                            if ($_GET['upload'] == "success") {
                                echo '<p class="success">Profile picture changed!</p>';
                            }
                        }
                        ?>
                    
           
            
        </div>
        
            <form action="includes/logout.inc.php" method="post">
                <li><Button name="submit" type="submit" >Logout</Button></li>
            </form>
            <form action="includes/logout.inc.php" method="post">
                <li><Button name="submit" type="submit" style="border-color: crimson; border-style:solid;border-width:2px;color:aliceblue;background-color:red">Delete Account</Button></li>
            </form>
        </ul>

        </div>

<!-- Page Content -->

<?php
include 'page-includes/footer.php';
?>

<script>
var loadFile = function(event) {
	var image = document.getElementById('previewImg');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>