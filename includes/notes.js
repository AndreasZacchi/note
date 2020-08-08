$(document).ready(function () {
    ifChecker();

    $('#tagB').mousedown(function() {
        event.preventDefault(); 
        document.execCommand('bold');
    });
    $('#tagI').mousedown(function(event) {
        event.preventDefault();
        document.execCommand('italic');
    });
    $('#tagU').mousedown(function() {
        event.preventDefault();
        document.execCommand('underline');
    });
    $('#tagS').mousedown(function() {
        event.preventDefault();
        document.execCommand('strikeThrough');
    });
    $('#tagJL').mousedown(function() {
        event.preventDefault();
        document.execCommand('justifyLeft');
    });
    $('#tagJC').mousedown(function() {
        event.preventDefault();
        document.execCommand('justifyCenter');
    });
    $('#tagJR').mousedown(function() {
        event.preventDefault();
        document.execCommand('justifyRight');
    });
    $('#tagJF').mousedown(function() {
        event.preventDefault();
        document.execCommand('justifyFull');
    });
});

function isSelected() {
    let isBold = document.queryCommandState("bold");
    let isItalic = document.queryCommandState("italic");
    let isUnderline = document.queryCommandState("underline");
    let isStrikeThrough = document.queryCommandState("strikeThrough");

    let isJustifyLeft = document.queryCommandState("justifyLeft");
    let isJustifyCenter = document.queryCommandState("justifyCenter");
    let isJustifyRight = document.queryCommandState("justifyRight");
    let isJustifyFull = document.queryCommandState("justifyFull");

    if(isBold) {
        $('#tagB').addClass("formatBtnActive");
    } else {
        $('#tagB').removeClass("formatBtnActive");
    }
    if(isItalic) {
        $('#tagI').addClass("formatBtnActive");
    } else {
        $('#tagI').removeClass("formatBtnActive");
    }
    if(isUnderline) {
        $('#tagU').addClass("formatBtnActive");
    } else {
        $('#tagU').removeClass("formatBtnActive");
    }
    if(isStrikeThrough) {
        $('#tagS').addClass("formatBtnActive");
    } else {
        $('#tagS').removeClass("formatBtnActive");
    }

    if(isJustifyLeft) {
        $('#tagJL').addClass("formatBtnActive");
    } else {
        $('#tagJL').removeClass("formatBtnActive");
    }
    if(isJustifyCenter) {
        $('#tagJC').addClass("formatBtnActive");
    } else {
        $('#tagJC').removeClass("formatBtnActive");
    }
    if(isJustifyRight) {
        $('#tagJR').addClass("formatBtnActive");
    } else {
        $('#tagJR').removeClass("formatBtnActive");
    }
    if(isJustifyFull) {
        $('#tagJF').addClass("formatBtnActive");
    } else {
        $('#tagJF').removeClass("formatBtnActive");
    }


}

function ifChecker() {
    if(document.getElementById("noteContent").getAttribute("data-opennote") != undefined) {
        $("#noteContent").attr("contenteditable", true);
        saveNote(document.getElementById("noteContent").getAttribute("data-opennote"));
        isSelected()
    }
    else {
        $("#noteContent").attr("contenteditable", false);
    }
    setTimeout(ifChecker, 100);
}

function loadNote(noteID) {
    $(document).ready(function () {
        jQuery.ajax({
            type: "POST",
            url: "includes/notes.inc.php",
            ContentType: "charset=utf-8",
            data: {
                    "type": 0,
                    "id": noteID, 
                },
            success: function (data) {
                document.getElementById("noteContent").innerHTML = data;
                document.getElementById("noteContent").setAttribute("data-opennote", noteID);
            },
        })
    });
}

let oldContent;
function saveNote(noteID) {
    let content = $("#noteContent").html();
    $(document).ready(function () {
        if(oldContent == undefined || oldContent != content) {
            jQuery.ajax({
                type: "POST",
                url: "includes/notes.inc.php",
                ContentType: "charset=utf-8",
                data: {
                        "type": 1,
                        "id": noteID,
                        "content": content, 
                    },
            })
            oldContent = content;
        }
    });
}
