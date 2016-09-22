<?php
require_once('../../database/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
redirect_to("admin.php");
?>
