<?php
if(!isset($_POST['type'])) {
    echo "error";
    exit();   
}
// Delete folder and subfolders
if($_POST['type'] == 0) {
    require 'db.inc.php';
    $sql = "DELETE FROM `folders` WHERE id=? or path LIKE ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    else {
        $path = "%/".$_POST['id']."/%";
        mysqli_stmt_bind_param($stmt, "is", $_POST['id'], $path);
        mysqli_stmt_execute($stmt);
    }
}
// Rename folder
else if($_POST['type'] == 1) {
    require 'db.inc.php';
    $sql = "UPDATE `folders` SET name=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $_POST['newname'], $_POST['id']);
        mysqli_stmt_execute($stmt);
    }
}
// Delete note
else if($_POST['type'] == 2) {
    require 'db.inc.php';
    $search = $_POST['id'];
    $sql = "DELETE FROM `notes` WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "i", $_POST['id']);
        mysqli_stmt_execute($stmt);
    }
}
// Rename note
else if($_POST['type'] == 3) {
    require 'db.inc.php';
    $sql = "UPDATE `notes` SET title=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $_POST['newtitle'], $_POST['id']);
        mysqli_stmt_execute($stmt);
    }
}
// New note
else if($_POST['type'] == 4) {
    require 'db.inc.php';
    session_start();
    $sql = "INSERT INTO notes (ownerUID, path, title) VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    else {
        $path = base64_decode($_SESSION['path64']) == "/" ? "." : base64_decode($_SESSION['path64']).".";
        echo base64_decode($_SESSION['path64']);
        echo $path;
        mysqli_stmt_bind_param($stmt, "iss", $_SESSION['userId'], $path, $_POST['title']);
        mysqli_stmt_execute($stmt);
    }
}
// New folder
else if($_POST['type'] == 5) {
    require 'db.inc.php';
    session_start();
    $sql = "INSERT INTO folders (ownerUID, path, name) VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    else {
        $path = base64_decode($_SESSION['path64']);
        mysqli_stmt_bind_param($stmt, "iss", $_SESSION['userId'], $path, $_POST['name']);
        mysqli_stmt_execute($stmt);
    }
}