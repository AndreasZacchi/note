$(document).ready(function () {
    ifChecker();
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
                document.getElementById("noteContent").setAttribute("data-opennote", noteID);
                formatNote(data);
            },
        })
    });
}

function formatNote(content) {
    var res = content
    .replace(/\[bold\]/g, "<b>")
    .replace(/\[\/bold\]/g, "</b>")
    .replace(/\[italic\]/g, "<i>")
    .replace(/\[\/italic\]/g, "</i>");

    document.getElementById("noteContent").innerHTML = res;
}

function deFormatNote(content) {
    var res = content
    .replace(/<b>/g, "[bold]")
    .replace(/<\/b>/g, "[/bold]")
    .replace(/<i>/g, "[italic]")
    .replace(/<\/i>/g, "[/italic]");
    return res;
}

let oldContent;
function saveNote(noteID) {
    let content = deFormatNote($("#noteContent").html());
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