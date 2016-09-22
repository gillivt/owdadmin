<?php require_once("../database/initialize.php"); ?>
<?php	
    $session->message("Succesfully logged out", "alert-success", "glyphicon-ok-circle");
    $session->logout();
    log_action("Logout", "Logged Out");
    redirect_to("login.php");
?>
