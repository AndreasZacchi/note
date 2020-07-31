<?php
if(isset($_POST['login-submit'])) {
    require 'db.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if(empty($mailuid) && empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    }
    else if(empty($mailuid)) {
        header("Location: ../login.php?error=emptymail");
        exit();
    }
    else if(empty($password)) {
        header("Location: ../login.php?error=emptypassword&mail=".$mailuid);
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE mail=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)) {
                $passwordCheck = password_verify($password, $row['pwd']);
                if($passwordCheck == false) {
                    header("Location: ../login.php?error=wrongpassword");
                    exit();
                }
                else if($passwordCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    if(!isset($_SESSION['path64'])) {
                        $_SESSION['path64'] = "Lw==";
                    }
                    header("Location: ../note.php");
                    exit();
                }
                else {
                    header("Location: ../login.php?error=wrongpassword");
                    exit();
                }
            }
            else {
                header("Location: ../login.php?error=invalidemail");
                exit();
            }
        }
    }
}
else {
    header("Location: ../login.php");
    exit();
}