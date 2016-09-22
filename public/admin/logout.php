<?php require_once("../../database/initialize.php"); ?>
<?php	
    $session->message("<div class='alert alert-success'><span class='glyphicon glyphicon-ok-sign'></span>&nbsp&nbsp;Succesfully logged out.</div>");
    $session->logout();
    redirect_to("login.php");
?>
