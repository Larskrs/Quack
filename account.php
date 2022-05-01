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


                <form action="includes/saveProfileSettings.php" method="post">

                    <li class="grid-container">
                            <h5>Profile Image</h5>
                            <input name="fileToUpload" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                        </li>
                        <hr class="solid">
                        <li class="grid-container">
                        <h5>Profile Banner</h5>
                            <input name="banner" type="file" accept="image/*" onchange="document.getElementById('profile-section').style = 'background-size: cover;background-image: url(' + window.URL.createObjectURL(this.files[0]) + ')'">
                        </li>
                        <hr class="solid">
                        <li class="grid-container">
                            <h5 class="underline">Bio</h5>
                            <textarea name="bio" id="bio" class="textInputArea" cols="15" rows="1" maxlength=48 placeholder="Content..."></textarea>
                        </li>
                        <hr class="solid">

                        <li><button style="height:40px" name="submit" type="submit">Upload</button></li>
                    
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
                </div>
        
            <form action="includes/logout.inc.php" method="post">
                <li><Button name="submit" type="submit" >Logout</Button></li>
            </form>
            <form action="includes/logout.inc.php" method="post">
                <li><Button name="submit" type="submit" style="border-color: crimson; border-style:solid;border-width:2px;color:aliceblue;background-color:red">Delete Account</Button></li>
            </form>
            
        </div>
        
    </ul>

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