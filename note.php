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
<script>
    function folderbarToggle() {
        let bleu = document.getElementById("folderToggleId");
        bleu.classList.toggle("folderToggle");
}
</script>
<div class="grid-container">
    <div id="folderToggleId" class="folderBar">
        <div class="navHeader"></div>
        <div id="foldersandfiles"></div>
    </div>
    <div id="noteContainer" class="note">
        <div id="noteTextFormat">
        <button onclick="folderbarToggle()"><i class="fas fa-angle-double-right"></i></button>
            <div class="formatBtnGroup">
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
                <div class="formatBtnDiv"></div>
            </div>
            <div class="formatBtnGroup">
                <div class="formatBtnContainer">
                <div class="fontTypeDropdown">
                    <button onclick="toggleDropdown()" class="dropbtn formatBtn"><i class="fas fa-font"></i></button>
                    <div id="fontTypeDropdown" class="dropdown-content">
                        <input type="text" placeholder="Search.." id="fontTypeInput" onkeyup="filterFontType()">
                        <button id="fontTypeArial" style="font-family: Arial;">Arial</button>
                        <button id="fontTypeComicSans" style="font-family: Comic Sans;">Comic Sans</button>
                    </div>
                </div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn"><i class="fas fa-text-height"></i></button>
                    <div class="formatBtnDisc">Font size</div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn" id=""><i class="fas fa-chevron-up"></i></button>
                    <div class="formatBtnDisc">Increase font size</div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn" id=""><i class="fas fa-chevron-down"></i></button>
                    <div class="formatBtnDisc">Decrease font size</div>
                </div>
                <div class="formatBtnDiv"></div>
            </div>
            <div class="formatBtnGroup">
                <div class="formatBtnContainer">
                    <button class="formatBtn" id="">fC</button>
                    <div class="formatBtnDisc">Font color</div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn" id="">bC</button>
                    <div class="formatBtnDisc">Back color</div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn" id="tagB"><i class="fas fa-bold"></i></button>
                    <div style="font-weight: bold;" class="formatBtnDisc">Bold</div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn" id="tagI"><i class="fas fa-italic"></i></button>
                    <div style="font-style: italic;" class="formatBtnDisc">Italic</div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn" id="tagU"><i class="fas fa-underline"></i></button>
                    <div style="text-decoration:underline;" class="formatBtnDisc">Underline</div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn" id="tagS"><i class="fas fa-strikethrough"></i></button>
                    <div style="text-decoration:line-through;" class="formatBtnDisc">Line through</div>
                </div>
                <div class="formatBtnDiv"></div>
            </div>
            <div class="formatBtnGroup">
                <div class="formatBtnContainer">
                    <button class="formatBtn" id="tagJL"><i class="fas fa-align-left"></i></button>
                    <div class="formatBtnDisc">Align text left</div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn" id="tagJC"><i class="fas fa-align-center"></i></button>
                    <div class="formatBtnDisc">Align text center</div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn" id="tagJR"><i class="fas fa-align-right"></i></button>
                    <div class="formatBtnDisc">Align text right</div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn" id="tagJF"><i class="fas fa-align-justify"></i></button>
                    <div class="formatBtnDisc">Align text full</div>
                </div>
                <div class="formatBtnDiv"></div>
            </div>
            <div class="formatBtnGroup">
                <div class="formatBtnContainer">
                    <button class="formatBtn" id=""><i class="fas fa-list-ul"></i></button>
                    <div class="formatBtnDisc">Unordered list</div>
                </div>
                <div class="formatBtnContainer">
                    <button class="formatBtn" id=""><i class="fas fa-list-ol"></i></button>
                    <div class="formatBtnDisc">Ordered list</div>
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
        <div class="noteNavbarContent"><a title="Settings" href="#"><i class="fas fa-cog buttonNote"></i></a></div>
        <div class="noteNavbarContent"><a title="Home" href="index.php"><i class="fas fa-home buttonNote"></i></a></div>
        <div class="noteNavbarContent"><form action="includes/logout.inc.php" method="post"><button title="Log Out" class="logoutNoteButton" type="submit" name="logout-submit"><i id="buttonNote" class="fas fa-sign-out-alt"></i></button></form></div>
    </div>
</div>
<?php

    require "footer.php"
    // LABEL & FOLDER MAX 32 CHARS!
            
?>