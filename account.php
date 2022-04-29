<div class="grid-container">
    
    
    <?php
include 'page-includes/header.php';
?>

<div class="mid">

<?php
        if (!isset($_SESSION['userUid'])) {
            header("location: index.php");
        } else {
            echo"<p>You are logged in!</p>";
        }
?>
        <ul>

            <?php
                echo '<h2>'.$_SESSION['userUid'].'</h2>';
            ?>
            <div class="grid-container">
                <div class="grid-item" style="grid-area: left; margin-left: auto">

                    <?php 
                $profileImgFullName = "uploads/profileImages/".$_SESSION['userUid'].".png";
                if (!file_exists($profileImgFullName)) {
                    $profileImgFullName = "";
                }
                echo('<img style="border-radius: 50%" id="output" src="'.$profileImgFullName.'" width="200" height="200">');
                ?>
                </div>
                <div class="grid-item" style="grid-area: mid;">

                    <form action="includes/setprofilepicture.inc.php" method="post" enctype="multipart/form-data">
                        <li><input name="file" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"></li>
                        <li><button style="margin:auto;height:40px" name="submit" type="submit">Upload</button></li>
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