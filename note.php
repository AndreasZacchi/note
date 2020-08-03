<?php
    require "header.php";
    if(!isset($_SESSION['userId'])) {
        header("Location: index.php");
        exit();
    }
?>
<script src="includes/folders.js"></script>
<script src="includes/notes.js"></script>
<script>
    $(document).ready(function () {
        getAll(path);
    });
</script>
<div class="grid-container">
    <div class="folderBar">
        <div class="navHeader"></div>
        <div id="foldersandfiles"></div>
    </div>
    <div id="noteContainer" class="note">
        <div id="noteTextFormat">
            <input type="button" value="B" style="font-weight:bold;" onclick='add_tag("b");'>
            <input type="button" value="I" style="font-style:italic;" onclick='add_tag("i");'>
            <input type="button" value="U" style="text-decoration:underline;" onclick='add_tag("u");'>
            <input type="button" value="S" style="text-decoration:line-through;" onclick='add_tag("s");'>
        </div>
        <div id="noteContent" contenteditable="false"></div>
    </div>
    <div class="noteNavbar">
        <div id="newContainer" class="noteNavbarContent"></div>
        <div id="newContainer1" class="noteNavbarContent"></div>
        <div class="noteNavbarContent"><a title="Steam Group" href="https://steamcommunity.com/groups/watdoink" target="_blank"><i class="fab fa-steam-symbol buttonNote"></i></a></div>
        <div class="noteNavbarContent"><a title="Podcast" href="#" target="_blank"><i class="fas fa-podcast buttonNote"></i></a></div>
        <div class="noteNavbarContent"><a title="Home" href="index.php"><i class="fas fa-home buttonNote"></i></a></div>
        <div class="noteNavbarContent"><form action="includes/logout.inc.php" method="post"><button title="Log Out" class="logoutNoteButton" type="submit" name="logout-submit"><i id="buttonNote" class="fas fa-sign-out-alt"></i></button></form></div>
    </div>
</div>
<?php

    require "footer.php"
    // LABEL & FOLDER MAX 32 CHARS!
            
?>