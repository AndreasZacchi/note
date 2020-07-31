<?php
    require "header.php";
?>

    <main>
        <div>
            <?php
                if(isset($_GET['newpwd'])) {
                    if($_GET['newpwd'] == "empty") {
                        echo '<p class="errormessage">You need to fill all fields!</p>';
                    }
                    else if($_GET['newpwd'] == "pwdnomatch") {
                        echo '<p class="errormessage">The passwords didn\'t match!</p>';
                    }
                }

                $selector = $_GET['selector'];
                $validator = $_GET['validator'];

                if(empty($selector) || empty($validator)) {
                    echo "<p class=\"errormessage\">Could not validate your request, please resubmit your reset request!</p>";
                }
                else {
                    if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                        ?>
                            <div class="createPasswordDiv">
                                <form action="includes/reset-password.inc.php" method="post">
                                    <input class="input" type="hidden" name="selector" value="<?php echo $selector; ?>">
                                    <input class="input" type="hidden" name="validator" value="<?php echo $validator; ?>">
                                    <input class="input" type="password" name="pwd" placeholder="Enter a new password...">
                                    <input class="input" type="password" name="pwd-repeat" placeholder="Repeat the new password...">
                                    <button class="btn default" type="submit" name="reset-password-submit">Reset Password</button>
                                </form>
                            </div>

                        <?php
                    }
                }
            ?>
        </div>
    </main>

<?php
    require "footer.php";
?>