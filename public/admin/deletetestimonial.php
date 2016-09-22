<?php require_once("../../database/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) {
        $session->message("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp&nbsp;No testimonial ID was provided.</div>");
    redirect_to('listtestimonials.php');
  }

  $testimonial = Testimonial::find_by_id($_GET['id']);
  if($testimonial && $testimonial->delete()) {
    $session->message("<div class='alert alert-success' role='alert'>The Comment was deleted.</div>");
    redirect_to("listtestimonials.php");
  } else {
    $session->message("<div class='alert alert-danger' role='alert'>The Comment could not be deleted.</div>");
    redirect_to('listtestimonials.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
