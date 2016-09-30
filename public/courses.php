<?php
require_once("../database/initialize.php");
// if not logged in redirect to login page
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
include_layout_template("header.php");

/* File: index.php
 *
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 *
 * Created: 26-Jan-2016 16:41:31
 * 
 * Purpose: Home Page
 *
 * Modification History:
 *
 * 
 */
?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
<?php echo output_message($message); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4 text">
                <h3>Options</h3>
                <div class="list-group">
                    <a class="list-group-item list-group-item-info disabled" href="#">Unclaimed Courses</a>
                    <a class="list-group-item list-group-item-warning" id="viewunclaimedcourse" href="#"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View Unclaimed Course</a>
                    <a class="list-group-item list-group-item-warning" id="editunclaimedcourse" href="#"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit Unclaimed Course</a>
                    <a class="list-group-item list-group-item-info disabled" href="#">Claimed Courses</a>
                    <a class="list-group-item list-group-item-warning" id="viewclaimedcourse" href="#"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View Claimed Course</a>
                    <a class="list-group-item list-group-item-warning" id="editclaimedcourse" href="#"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit Claimed Course</a>
                </div>
            </div>
            <div id="result" class="col-xs-12 col-sm-8 text">
                <!--page is loaded here using ajax-->
            </div>
        </div>
    </div>
</div>
</main>

<script src="assets/js/courses.js"></script>
<?php
include_layout_template("footer.php");
?>