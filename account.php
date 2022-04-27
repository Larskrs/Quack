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
            <img id="output" src="" width="200" height="200">
            <form action="includes/setprofilepicture.inc.php" method="post" enctype="multipart/form-data">


                <li><input name="file" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"></li>
                <li><button style="margin:auto;height:40px" name="submit" type="submit">Upload</button></li>
            </form>
           
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