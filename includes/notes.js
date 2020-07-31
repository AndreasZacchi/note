$(document).ready(function () {
    ifChecker();
});

function ifChecker() {
    if(document.getElementById("noteContent").getAttribute("data-opennote") != undefined) {
        saveNote(document.getElementById("noteContent").getAttribute("data-opennote"));
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
//TODO: Implement oldContent so it doesn't send requests
function saveNote(noteID) {
    $(document).ready(function () {
        jQuery.ajax({
            type: "POST",
            url: "includes/notes.inc.php",
            ContentType: "charset=utf-8",
            data: {
                    "type": 1,
                    "id": noteID,
                    "content": $("#noteContent").html(), 
                },
        })
    });
}