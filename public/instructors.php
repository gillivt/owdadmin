<?php
require_once("../database/initialize.php");
// if not logged in redirect to login page
if (!$session->is_logged_in()) {redirect_to("login.php");}include_layout_template("header.php");

/* File: Instructors.php
 *
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 *
 * Created: 2016
 * 
 * Purpose: Instructors Page
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
                    <a class="list-group-item list-group-item-info disabled" href="#">Instructors Upload</a>
                    <a class="list-group-item list-group-item-warning" id="viewuploadinstructor" href="#"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View Unregistered Instructors</a>
                    <a class="list-group-item list-group-item-warning" id="edituploadinstructor" href="#"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit Unregistered Instructors</a>
                    <a class="list-group-item list-group-item-info disabled" href="#">Instructors</a>
                    <a class="list-group-item list-group-item-warning" id="viewinstructor" href="#"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View Registered Instructor</a>
                    <a class="list-group-item list-group-item-warning" id="editinstructor" href="#"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit Registered Instructor</a>
                    <a class="list-group-item list-group-item-info disabled" href="#">Push Notifications</a>
                    <a class="list-group-item list-group-item-warning" id="sendpush" href="#"><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;Send Push Notification to Instructor</a>
                </div>
            </div>
            <div id="result" class="col-xs-12 col-sm-8 text">
                <!--page is loaded here using ajax-->
            </div>
        </div>
    </div>
</main>

<script src="assets/js/instructors.js"></script>
<?php
include_layout_template("footer.php");
?>