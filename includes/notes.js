$(document).ready(function () {
    ifChecker();

    $('#tagB').click(function() {
        document.execCommand('bold');
    });
    $('#tagI').click(function() {
        document.execCommand('italic');
    });
    $('#tagU').click(function() {
        document.execCommand('underline');
    });
    $('#tagS').click(function() {
        document.execCommand('strikeThrough');
    });
    $('#tagJL').click(function() {
        document.execCommand('justifyLeft');
    });
    $('#tagJC').click(function() {
        document.execCommand('justifyCenter');
    });
    $('#tagJR').click(function() {
        document.execCommand('justifyRight');
    });
    $('#tagJF').click(function() {
        document.execCommand('justifyFull');
    });
});

function ifChecker() {
    if(document.getElementById("noteContent").getAttribute("data-opennote") != undefined) {
        $("#noteContent").attr("contenteditable", true);
        saveNote(document.getElementById("noteContent").getAttribute("data-opennote"));
    }
    else {
        $("#noteContent").attr("contenteditable", false);
    }
    setTimeout(ifChecker, 1000);
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
