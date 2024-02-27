function getAllTable(path) {
  $(document).ready(function () {
    jQuery.ajax({
      type: "POST",
      url: "includes/folders.inc.php",
      ContentType: "charset=utf-8",
      data: {
        type: 1,
        path: path,
      },
      success: function (data) {
        document.getElementById("foldersandfiles").innerHTML = data;
      },
    });
    $("#newContainer").empty();
    $("#newContainer1").empty();
    if (path == undefined) {
      path = "Lw==";
    }
    $("#newContainer").append(
      '<a title="New Note" href="#" onclick="newNote(\'' +
        path +
        '\');"><i class="fa fa-file-text buttonNote" aria-hidden="true"></i></a>'
    );
    $("#newContainer1").append(
      '<a title="New Folder" href="#" onclick="newFolder(\'' +
        path +
        '\');"><i class="fas fa-folder-plus buttonNote"></i></a>'
    );
    $("#addNote").append(
      '<a title="New Note" href="#" onclick="newNote(\'' +
        path +
        '\');"><i class="fa fa-file-text buttonNote" aria-hidden="true"></i></a>'
    );
  });
}
function getAll(path) {
  setTimeout(function () {
    getAllTable(path);
  }, 10);
}

function newNote(currentpath) {
  var title = prompt("New note", "New Note");
  if (title !== null && title !== "") {
    $(document).ready(function () {
      jQuery.ajax({
        type: "POST",
        url: "includes/folderUpdates.inc.php",
        ContentType: "charset=utf-8",
        data: {
          type: 4,
          title: title,
        },
      });
    });
    getAll(currentpath);
  }
}
function newFolder(currentpath) {
  var name = prompt("New Folder", "New Folder");
  if (name !== null && name !== "") {
    $(document).ready(function () {
      jQuery.ajax({
        type: "POST",
        url: "includes/folderUpdates.inc.php",
        ContentType: "charset=utf-8",
        data: {
          type: 5,
          name: name,
        },
      });
    });
    getAll(currentpath);
  }
}

function deleteFolder(id, currentpath) {
  if (confirm("Are you sure you want to the delete this?")) {
    $(document).ready(function () {
      jQuery.ajax({
        type: "POST",
        url: "includes/folderUpdates.inc.php",
        ContentType: "charset=utf-8",
        data: {
          type: 0,
          id: id,
        },
      });
    });
    getAll(currentpath);
  }
}

function renameFolder(id, name, currentpath) {
  var newName = prompt("New name", name);
  if (newName !== null && newName !== "" && newName != name) {
    $(document).ready(function () {
      jQuery.ajax({
        type: "POST",
        url: "includes/folderUpdates.inc.php",
        ContentType: "charset=utf-8",
        data: {
          type: 1,
          id: id,
          newname: newName,
        },
      });
    });
    getAll(currentpath);
  }
}

function deleteNote(id, currentpath) {
  if (confirm("Are you sure you want to the delete this?")) {
    $(document).ready(function () {
      jQuery.ajax({
        type: "POST",
        url: "includes/folderUpdates.inc.php",
        ContentType: "charset=utf-8",
        data: {
          type: 2,
          id: id,
        },
      });
    });
    getAll(currentpath);
  }
}

function renameNote(id, title, currentpath) {
  var newTitle = prompt("New name", title);
  if (newTitle !== null && newTitle !== "" && newTitle != title) {
    $(document).ready(function () {
      jQuery.ajax({
        type: "POST",
        url: "includes/folderUpdates.inc.php",
        ContentType: "charset=utf-8",
        data: {
          type: 3,
          id: id,
          newtitle: newTitle,
        },
      });
    });
    getAll(currentpath);
  }
}
