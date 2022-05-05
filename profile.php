<?php 
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
    include 'profile-header.php';
    displayProfile($conn, $_SESSION['userUid']);
?>


<form action="includes/saveProfileSettings.php" method="post" enctype="multipart/form-data">

<li class="grid-container">
        <h5>Profile Image</h5>
        <input name='profile' type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
    </li>
    <hr class="solid">
    <li class="grid-container">
    <h5>Profile Banner</h5>
        <input name='banner' type="file" accept="image/*" onchange="document.getElementById('profile-section').style = 'background-size: cover;background-image: url(' + window.URL.createObjectURL(this.files[0]) + ')'">
    </li>
    <hr class="solid">
    <li class="grid-container">
        <h5 class="underline">Bio</h5>
        <textarea name="bio" id="bio" class="textInputArea" cols="15" rows="1" maxlength=48 placeholder="Content..."></textarea>
    </li>
    <hr class="solid">

    <li><button style="height:40px" name="submit" type="submit">Save Changes</button></li>

</form>
<form action="includes/logout.inc.php" method="post">
                <li><Button name="submit" type="submit" >Logout</Button></li>
            </form>