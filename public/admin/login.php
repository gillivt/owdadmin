<?php
    require_once("../../database/initialize.php");
    // if not logged in redirect to login page
    if ($session->is_logged_in()) {redirect_to("admin.php");}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check database to see if username/password exist.
    $found_user = User::authenticate($username, $password);

    if ($found_user) {
        $session->login($found_user);
        log_action('Login', "{$found_user->username} logged in.");
        $ucLogin = ucfirst($found_user->username);
        $session->message("<div class='alert alert-success'><span class='glyphicon glyphicon-ok-sign'></span>&nbsp&nbsp;Welcome " . $ucLogin . "</div>");
        redirect_to("admin.php");
    } else {
        // username/password combo was not found in the database
        $message = "<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp&nbsp;Username/password combination incorrect.</div>";
    }
} else { // Form has not been submitted.
    $username = "";
    $password = "";
}
    include_layout_template("header.php");

?>
<!--
File: login.php

Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions

Created: 26-Jan-2016 16:41:31

Purpose: login page


Modification History:

-->
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-1">
                <br><br>
                <a href="https://www.facebook.com/The-Plough-Ashby-De-La-Zouch-1409446652610698/"><img class="img-responsive" src="../assets/images/facebook.png" alt="facebook"></a>
            </div>
            
            <div class="col-sm-12 col-md-11">
                <h2>Login</h2>
                <?php echo output_message($message); ?>
                <form data-toggle="validator" role="form" action="login.php" method="post">
                    <div class="form-group">
                        <label for="username" class="control-label">Username:</label>
                        <input class="form-control" id="username" name="username" required data-error="Username is Required" type="text" value="<?php echo htmlentities($username); ?>" maxlength="30" placeholder="enter username">
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password">Password:</label>
                        <input class="form-control" id="password" name="password" required data-error="Password is Required" type="password" value="<?php echo htmlentities($password); ?>" maxlength="30" placeholder="enter password">
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <span class="icon-input-btn"><span class="glyphicon glyphicon-log-in"></span><input class="btn btn-primary" type="submit" name="submit" value="Login"></span>
                    </div>
                </form>
            </div>        
        </div>
    </div>
</main>
<script src="../bootstrap-validator-master/dist/validator.min.js"></script>
<script src="../assets/js/hideShowPassword.min.js"></script>
<script src="../assets/js/modernizr.custom.js"></script>
<script src="../assets/js/login.js"></script>
<?php
include_layout_template("footer.php");
?>