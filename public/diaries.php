<?php
require_once("../database/initialize.php");
// if not logged in redirect to login page
if (!$session->is_logged_in()) {redirect_to("login.php");}include_layout_template("header.php");

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
                <h3>Diary</h3>
                <div class="list-group">
                    <a class="list-group-item list-group-item-info disabled" href="#">Diaries</a>
                    <a class="list-group-item list-group-item-warning" id="viewinstructordiary" href="#"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View Diaries</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 text">
            </div>
        </div>
    </div>
</main>

<script src="assets/js/diaries.js"></script>
<?php
include_layout_template("footer.php");
?>