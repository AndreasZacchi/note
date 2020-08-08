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
            <div class="noteInfo">a</div>
            <div class="formatContainer">
                <div class="btnHolder">
                    <div class="formatBtnContainer">
                        <button class="formatBtn" id=""><i class="fas fa-share" style="transform: scaleX(-1)"></i></button>
                        <div class="formatBtnDisc">Undo</div>
                    </div>
                    <div class="formatBtnContainer">
                        <button class="formatBtn" id=""><i class="fas fa-share"></i></button>
                        <div class="formatBtnDisc">Redo</div>
                    </div>
                    <div class="formatBtnContainer">
                        <button class="formatBtn" id=""><i class="far fa-copy"></i></button>
                        <div class="formatBtnDisc">Copy</div>
                    </div>
                    <div class="formatBtnContainer">
                        <button class="formatBtn" id=""><i class="fas fa-cut"></i></button>
                        <div class="formatBtnDisc">Cut</div>
                    </div>
                    <div class="formatBtnContainer">
                        <button class="formatBtn" id=""><i class="far fa-clipboard"></i></button>
                        <div class="formatBtnDisc">Paste</div>
                    </div>
                </div>
                <div class="btnHolder">
                    <div class="formatBtnContainer">
                        <input type="text" value="Font" name="fontName" class="formatInput" id="">
                    </div>
                </div>
                <div class="btnHolder">
                    <div class="formatBtnContainer"><input type="text" value="Font Size" name="fontSize" class="formatInput" id=""></div>
                    <div class="formatBtnContainer"><button class="formatBtn" id=""><i class="fas fa-chevron-up"></i></button></div>
                    <div class="formatBtnContainer"><button class="formatBtn" id=""><i class="fas fa-chevron-down"></i></button></div>
                </div>
                <div class="btnHolder">
                    <div class="formatBtnContainer"><button class="formatBtn" id="">fC</button></div>
                    <div class="formatBtnContainer"><button class="formatBtn" id="">bC</button></div>
                </div>
                <div class="btnHolder">
                    <div class="formatBtnContainer"><button class="formatBtn" id="tagB"><i class="fas fa-bold"></i></button></div>
                    <div class="formatBtnContainer"><button class="formatBtn" id="tagI"><i class="fas fa-italic"></i></button></div>
                    <div class="formatBtnContainer"><button class="formatBtn" id="tagU"><i class="fas fa-underline"></i></button></div>
                    <div class="formatBtnContainer"><button class="formatBtn" id="tagS"><i class="fas fa-strikethrough"></i></button></div>
                </div>
                <div class="btnHolder">
                    <div class="formatBtnContainer"><button class="formatBtn" id="tagJL"><i class="fas fa-align-left"></i></button></div>
                    <div class="formatBtnContainer"><button class="formatBtn" id="tagJC"><i class="fas fa-align-center"></i></button></div>
                    <div class="formatBtnContainer"><button class="formatBtn" id="tagJR"><i class="fas fa-align-right"></i></button></div>
                    <div class="formatBtnContainer"><button class="formatBtn" id="tagJF"><i class="fas fa-align-justify"></i></button></div>
                </div>
                <div class="btnHolder">
                    <div class="formatBtnContainer"><button class="formatBtn" id=""><i class="fas fa-list-ul"></i></button></div>
                    <div class="formatBtnContainer"><button class="formatBtn" id=""><i class="fas fa-list-ol"></i></button></div>
                </div>
            </div>
        </div>
        <div id="noteContent" contenteditable="false"></div>
        <div id="noteFooter"></div>
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