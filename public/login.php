<?php
/*
 * File:    login.php
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 * Created: 5 September 2016
 * Purpose: Login page
 * Modification History
 */
require_once("../database/initialize.php");
// if is logged in redirect to index page
 if ($session->is_logged_in()) {redirect_to("index.php");}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    //we have submitted our for data so need to call server to verify user
    
    $url = 'http://localhost/owddbservice/public/owd/staff/login';
    $response = \Httpful\Request::post($url)
            ->sendsJson()
            ->expectsJson()
            ->body('{"username":"'.$username.'", "password":"'.$password.'"}')
            ->send();
//    $response = '{ "token": "basic dGVycnk6cmF2aW5l", "name": "Terry Gilliver" }';
    // we have a json string now parse it
    $result = json_decode($response,true);
    if (isset($result['token'])) {
        echo $result;
        $session->login($result['token'],$result['name']);
        $name = $session->fullname();
        log_action('Login', $name.' logged in.');        
        $session->message("Welcome {$name}, logged in successfully", "alert-success", "glyphicon-ok-circle");
        redirect_to('index.php');
    } else {
        $session->message("Username/password combination incorrect", "alert-danger", "glyphicon-warning-sign");
        redirect_to('login.php');
    }
    

} else { // Form has not been submitted.
    $username = "";
    $password = "";
}
include_layout_template("header.php");
?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <?php echo output_message($message); ?>
                <h3>Login</h3>
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
<script src="bootstrap-validator-master/dist/validator.min.js"></script>
<script src="assets/js/hideShowPassword.min.js"></script>
<script src="assets/js/modernizr.custom.js"></script>
<script src="assets/js/login.js"></script>
<?php
include_layout_template("footer.php");
?>