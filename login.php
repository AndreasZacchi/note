<?php
    require "header.php";

    if(isset($_SESSION['userId'])) {
        header("Location: note.php");
    }
?>

    <main>
        <div class="loginDivContainer">
            <div class="loginDiv">
                <h1>Login</h1>
                <?php
                    if(isset($_GET['error'])) {
                        if($_GET['error'] == "emptyfields") {
                            echo '<p class="errormessage">You need to fill all fields!</p>';
                        }
                        else if($_GET['error'] == "emptymail") {
                            echo '<p class="errormessage">You need to enter an email!</p>';
                        }
                        else if($_GET['error'] == "emptypassword") {
                            echo '<p class="errormessage">You need to enter a password!</p>';
                        }
                        else if($_GET['error'] == "invalidemail") {
                            echo '<p class="errormessage">A user with that email does not exist!</p>';
                        }
                        else if($_GET['error'] == "wrongpassword") {
                            echo '<p class="errormessage">You entered a wrong password!</p>';
                        }
                        else if($_GET['error'] == "sqlerror") {
                            echo '<p class="errormessage">An error occured, contact site administrator!</p>';
                        }
                    }
                    if(isset($_GET['passwordreset'])) {
                        if($_GET['passwordreset'] == "success") {
                            echo '<p class="successmessage">Password was reset successfully!</p>';
                        }
                    }

                    if(isset($_GET['mail'])) {
                        echo 
                        '<form class="inputForm" action="includes/login.inc.php" method="post">
                            <label>Email</label>
                            <input class="input" type="text" name="mailuid" value="'.$_GET['mail'].'">
                            <label>Password</label>
                            <input class="input" type="password" name="pwd">
                            <button class="btn default" type="submit" name="login-submit">Login</button>
                        </form>';
                    }
                    else {
                        echo 
                        '<form class="inputForm" action="includes/login.inc.php" method="post">
                            <label>Email</label>
                            <input class="input" type="text" name="mailuid">
                            <label>Password</label>
                            <input class="input" type="password" name="pwd">
                            <button class="btn default" type="submit" name="login-submit">Login</button>
                        </form>';
                    }
                ?>
                <a class="loginlink" href="signup.php">Don't have an account?</a>
                <a class="loginlink" href="reset-password.php">Forgot your password?</a>
            </div>
        </div>
    </main>

<?php
    require "footer.php";
?>