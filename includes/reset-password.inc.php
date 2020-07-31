<?php
if(isset($_POST['reset-password-submit'])) {
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if(empty($password) || empty($passwordRepeat)) {
        header("Location: ../create-new-password.php?newpwd=empty&selector=".$selector."&validator=".$validator);
        exit();
    }
    else if($password !== $passwordRepeat) {
        header("Location: ../create-new-password.php?newpwd=pwdnomatch&selector=".$selector."&validator=".$validator);
        exit();
    }

    $currentDate = date("U");

    require 'db.inc.php';

    $sql = "SELECT * FROM passwordReset WHERE resetSelector=? AND resetExpires >= ".$currentDate;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "An error occured!";
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $selector);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if(!$row = mysqli_fetch_assoc($result)) {
        echo "Your reset request has expired or does not exist, please try resubmitting your reset request.";
        exit();
    }

    $tokenBin = hex2bin($validator);
    $tokenCheck = password_verify($tokenBin, $row['resetToken']);

    if($tokenCheck == false) {
        echo "Your reset request does not exist, please try resubmitting your reset request.";
        exit();
    }
    else if($tokenCheck === true) {
        $tokenEmail = $row['resetEmail'];

        $sql = "SELECT * FROM users WHERE mail=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "An error occured!";
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if(!$row = mysqli_fetch_assoc($result)) {
            echo "An error occured!";
            exit();
        }
        else {
            $sql = "UPDATE users SET pwd=? WHERE mail=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo "An error occured!";
                exit();
            }
            $newPasswordHashed = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ss", $newPasswordHashed, $tokenEmail);
            mysqli_stmt_execute($stmt);

            $sql = "DELETE FROM passwordreset WHERE resetEmail=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo "An error occured!";
                exit();
            }
            mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
            mysqli_stmt_execute($stmt);
            header("Location: ../login.php?passwordreset=success");
        }
    }
}
else {
    header("Location: ../index.php");
    exit();
}