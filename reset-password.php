<?php
    require "header.php";
?>

    <main>
        <div class="loginDivContainer">
            <div class="resetPasswordDiv">
                <h1>Reset your password</h1>
                <a style="width: 30%;" class="loginlink" href="login.php">Click me to go back to log in</a>
                <p>An email will be sent to the specified email with instructions to reset your password.</p>
                <form action="includes/reset-request.inc.php" method="post">
                    <input class="input" type="text" name="email" placeholder="Enter your email...">
                    <button class="btn default" type="submit" name="reset-request-submit">Send password reset request</button>
                </form>
                <?php
                    if(isset($_GET['reset'])) {
                        if($_GET['reset'] == "success") {
                            echo '<p class="successmessage">An email with instructions was sent to your email!</p>';
                        }
                        else if($_GET['reset'] == "invalidemail") {
                            echo '<p class="errormessage">Invalid email!</p>';
                        }
                    }
                ?>
            </div>
        </div>
    </main>

<?php
    require "footer.php";
?>