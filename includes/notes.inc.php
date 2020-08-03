<?php
session_start();
if(!isset($_POST['type'])) {
    echo "error";
    exit();   
}

if($_POST['type'] == 0) {
    loadNote($_POST['id']);
}
else if($_POST['type'] == 1) {
    saveNote($_POST['id'], $_POST['content']);
}

function loadNote($noteID) {
    require 'db.inc.php';
    $sql = "SELECT content, title FROM `notes` WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "i", $noteID);
        mysqli_stmt_execute($stmt);
        $r = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($r)) {
            echo htmlspecialchars_decode($row['content'], ENT_NOQUOTES);
        }
    }
}

function saveNote($noteID, $content) {
    require 'db.inc.php';
    $sql = "UPDATE `notes` SET content=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "si", $content, $_POST['id']);
        mysqli_stmt_execute($stmt);
    }
}
