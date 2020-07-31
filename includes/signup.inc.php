<?php
if(isset($_POST['signup-submit'])) {
    require 'db.inc.php';

    $mail = $_POST['mailuid'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if(empty($mail)) {
        header("Location: ../signup.php?error=emptymail");
        exit(); 
    }
    else if(empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&mail=".$mail);
        exit();  
    }
    else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail");
        exit();
    }
    else if($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&mail=".$mail);
        exit();
    }
    else {
        $sql = "SELECT mail FROM users WHERE mail=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0) {
                header("Location: ../signup.php?error=mailtaken");
                exit();
            }
            else {
                $sql = "INSERT INTO users (mail, pwd) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ss", $mail, $hashedPassword);
                    mysqli_stmt_execute($stmt);

                    // Log the user in once signed up
                    $sql = "SELECT * FROM users WHERE mail=?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "s", $mail);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if($row = mysqli_fetch_assoc($result)) {
                            session_start();
                            $_SESSION['userId'] = $row['id'];
                            $_SESSION['mail'] = $row['mail'];
                            header("Location: ../note.php");
                            exit();
                        }
                    }
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../index.php");
    exit();
}