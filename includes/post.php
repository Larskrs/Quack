<button id="toggleButton" onclick="toggle()">Post</button>
<form style="list-style: none" id="postForm" class="grid-item mid disabled" action="includes/post.inc.php" method="post" enctype="multipart/form-data">
            <li><textarea style="font-size: 20; height: 50px; width:450px"name="title" id="title" cols="40" rows="1" maxlength=35 placeholder="Title..."></textarea></li>
            <li><textarea name="content" id="content" cols="40" rows="5" maxlength=120 placeholder="Content..."></textarea></li>
            <li><input type="file" name="file" id="video/image"></li>
            <li><button style="margin:auto;" type="submit" name="submit" required>Send</button><li>
                </form>

                <script>
function toggle() {
   var element = document.getElementById("postForm");
   var button = document.getElementById("toggleButton");
   element.classList.toggle("disabled");
   button.classList.toggle("disabled");
}

</script>