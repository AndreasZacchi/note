<?php

if(isset($_POST['reset-request-submit'])) {

    $username = "noreplynoteapp@gmail.com";
    $password = "NoteApplication";

    $userEmail = $_POST['email'];
    if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../reset-password.php?reset=invalidemail");
        exit();
    }

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://188.179.90.76:25565/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);

    $expires = date("U") + 1800;

    require 'db.inc.php';


    $sql = "DELETE FROM passwordreset WHERE resetEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "An error occured!";
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);

    $sql = "INSERT INTO passwordreset (resetEmail, resetSelector, resetToken, resetExpires) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "An error occured!";
        exit();
    }

    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;
    $subject = "Password reset mail for Note";
    $message = '<p>We have received a password reset request. The link to reset your password is below. If you did not make this request you can ignore this email.</p>';
    $message .= '<p>Here is your password reset link: </br>';
    $message .= '<a href="'.$url.'">'.$url.'</a></p>';

    require_once('../phpmailer/PHPMailerAutoload.php');

    $mail = new PHPMailer(true);

    // SMTP Settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Username = $username;
    $mail->Password = $password;

    // Email Settings
    $mail->isHTML(true);
    $mail->SetFrom('no-reply@note.com');
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->addAddress($to);

    $mail->send();

    header("Location: ../reset-password.php?reset=success");
}
else {
    header("Location: ../index.php");
    exit();
}