<?php
session_start();
if(!isset($_POST['type'])) {
    exit();
}
else if($_POST['type'] == 1) {
    if(isset($_POST['path'])) { $_SESSION['path64'] = $_POST['path']; }
    listFromTree();
}

require 'debug.inc.php';
function getUsersFolders() {
    $path = base64_decode($_SESSION['path64']);
    require 'db.inc.php';
    $sql = "SELECT id, name, path FROM folders WHERE ownerUID=? AND path LIKE ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "is", $_SESSION['userId'], $path);
        mysqli_stmt_execute($stmt);
        $r = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_all($r, MYSQLI_ASSOC);
        $sort = array();
        foreach ($result as $key => $row) {
            $sort[$key]  = $row['name'];
        }
        array_multisort($sort, SORT_ASC,SORT_NATURAL|SORT_FLAG_CASE, $result);
        return $result;
    }
}

function getUsersNotes() {
    require 'db.inc.php';
    $path = base64_decode($_SESSION['path64']).".%";
    if($path == "/.%") {
        $path = ".%";
    }
    $sql = "SELECT id, path, title, DATE_FORMAT(createDate, '%d %M %Y') AS createDate FROM notes WHERE ownerUID=? AND path LIKE ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    else {
        $pathNotes = $path.".%";
        mysqli_stmt_bind_param($stmt, "is", $_SESSION['userId'], $path);
        mysqli_stmt_execute($stmt);
        $r = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_all($r, MYSQLI_ASSOC);
        $sort = array();
        foreach ($result as $key => $row) {
            $sort[$key]  = $row['title'];
        }
        array_multisort($sort, SORT_ASC,SORT_NATURAL|SORT_FLAG_CASE, $result);
        return $result;
    }
}


#region createTree
// Can be used to print all results as a HTML list

// function createTree($input, &$result = array(), $key = null) {
//     if ($key == "id") {
//         $result["temp"]["id"] = $input;
//     }
//     if ($key == "name") {
//         $result["temp"]["name"] = $input;
//     }
//     if ($key == "path") {
//         $result["temp"]["path"] = $input;
//         $levels = is_string($input) ? array_values(array_filter(explode('/', $input))) : null;
//         if ($input == "/") {
//             $result[$result["temp"]["id"]] = $result["temp"];
//         }
//         if($levels != null) {
//             if (count($levels) == 1) {
//                 $result[$levels[0]]["childs"][$result["temp"]["id"]] = $result["temp"];
//             }
//             if (count($levels) == 2) {
//                 $result[$levels[0]]["childs"][$levels[1]]["childs"][$result["temp"]["id"]] = $result["temp"];
//             }
//         }
//         unset($result["temp"]);
//     }
//     if (is_array($input)) {
//         foreach($input as $key => $value) {
//             createTree($value, $result, $key);
//         }
//     }
//     return $result;
// }
#endregion

function goBackPath($path) {
    $path = explode("/", $path);
    $backpath = null;
    for($x = 0; $x < count($path) - 2; $x++) {
        $backpath .= $path[$x]."/";
    }
    return base64_encode($backpath);
}

function listFromTree() {
    $path = base64_decode($_SESSION['path64']);
    if(basename($_SERVER['HTTP_REFERER']) == "note.php") {
        $tree = getUsersFolders();
        $notesTree = getUsersNotes();

        // If path is set and is not root, echo go back
        if(base64_decode($_SESSION['path64']) != "/") {
            echo '<a class="goBackIcon" href="#" onclick="getAll(\''.goBackPath($path).'\');"><i class="fas fa-arrow-left" aria-hidden="true"></i>..</a>';
        }

        #region fetchFolders
        // If no results were fetched, echo This folder is empty...
        if(empty($tree) && empty($notesTree)) {
            echo '
            <div>
                <i>This folder is empty...</i>
            </div>
            ';
            exit();
        }
        foreach($tree as $t) {
            $path = base64_encode($t["path"].$t["id"]."/");
            echo '
            <div tabindex="0" class="documentBox">
                <div class="documentTitle"><i class="fa fa-folder" aria-hidden="true"></i>'.$t["name"].'</div>
                    <div class="documentDetails">
                    <div style="background: var(--lightBlue);" class="editDocument openDiv" onclick="getAll(\''.$path.'\');">Open</div>
                    <div style="background: var(--flatGreen);" class="editDocument" onclick="renameFolder('.$t["id"].', \''.$t["name"].'\', \''.base64_encode($t["path"]).'\');">Edit</div>
                    <div style="background: var(--flatRed);" class="editDocument" onclick="deleteFolder('.$t["id"].');">Delete</div>
                </div>
            </div>';      
        }
        #endregion

        #region fetchNotes
        $path = $_SESSION['path64'];
        foreach($notesTree as $t) {
            echo '
            <div tabindex="0" class="documentBox">
                <div class="documentTitle"><i class="fa fa-sticky-note" aria-hidden="true"></i>'.$t["title"].'</div>
                <div class="documentDates">'.$t["createDate"].'</div>
                <div class="documentDetails">
                    <div style="background: var(--lightBlue);" class="editDocument openDiv" onclick="loadNote(\''.$t['id'].'\')">Open</div>
                    <div style="background: var(--flatGreen);" class="editDocument"><a class="editDocument" title="Rename" href="#" onclick="renameNote('.$t["id"].', \''.$t["title"].'\', \''.$path.'\');">Edit</a></div>
                    <div style="background: var(--flatRed);" class="editDocument"><a class="editDocument" title="Delete" href="#" onclick="deleteNote('.$t["id"].', \''.$path.'\');">Delete</a></div>
                </div>
            </div>';    
        }
        #endregion
    }
}
?>