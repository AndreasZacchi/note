<?php
    require "header.php";
?>

    <main>
        <div class="loginDivContainer">
            <div class="loginDiv">
                <h1>Sign up</h1>
                <?php
                    if(isset($_GET['error'])) {
                        if($_GET['error'] == "emptyfields") {
                            echo '<p class="errormessage">You need to fill all fields!</p>';
                        }
                        else if($_GET['error'] == "emptymail") {
                            echo '<p class="errormessage">You need to fill in an email!</p>';
                        }
                        else if($_GET['error'] == "invalidmail") {
                            echo '<p class="errormessage">Invalid email!</p>';
                        }
                        else if($_GET['error'] == "passwordcheck") {
                            echo '<p class="errormessage">Password does not match the password check!</p>';
                        }
                        else if($_GET['error'] == "mailtaken") {
                            echo '<p class="errormessage">A user with that email already exists!</p>';
                        }
                        else if($_GET['error'] == "sqlerror") {
                            echo '<p class="errormessage">An error occured, contact site administrator!</p>';
                        }
                    }

                    if(isset($_GET['mail'])) {
                        echo 
                            '<form action="includes/signup.inc.php" method="post">
                                <input class="input" type="text" name="mailuid" placeholder="Email..." value="'.$_GET['mail'].'">
                                <input class="input" type="password" name="pwd" placeholder="Password...">
                                <input class="input" type="password" name="pwd-repeat" placeholder="Repeat password...">
                                <button class="btn default" type="submit" name="signup-submit">Sign up</button>
                            </form>';
                    }
                    else {
                        echo 
                        '<form action="includes/signup.inc.php" method="post">
                            <input class="input" type="text" name="mailuid" placeholder="Email...">
                            <input class="input" type="password" name="pwd" placeholder="Password...">
                            <input class="input" type="password" name="pwd-repeat" placeholder="Repeat password...">
                            <button class="btn default" type="submit" name="signup-submit">Sign up</button>
                        </form>';
                    }
                ?>
            </div>
        </div>
    </main>

<?php
    require "footer.php";
?>