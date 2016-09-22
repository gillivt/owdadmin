<?php
//error_reporting(E_ERROR);
/* File: index.php
 *
 * Copyright © 20'6 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 *
 * Created: September 20'6
 * 
 * Purpose: Home Page
 *
 * Modification History:
 *
 * 
 */
require_once('../database/initialize.php');
// if not logged in redirect to login page
if (!$session->is_logged_in()) {
    redirect_to('login.php');
}

$max_file_size = 10485760;   // expressed in bytes (10MB)
//     '0240 =  '0 KB
//    '02400 = '00 KB
//   '048576 =   ' MB
//  '0485760 =  '0 MB

if (isset($_POST["submitinstructors"])) {
    $result = uploadCSV("instructor.csv");
    if ($result) {
//any other processing for success
        log_action('Upload', 'instructor file uploaded by ' . $name);
        redirect_to($_SERVER["PHP_SELF"]);
    } else {
//any other processing for fail
        log_action('Upload', 'instructor file upload failed. Attempt by ' . $name);
        redirect_to($_SERVER["PHP_SELF"]);
    }
} elseif (isset($_POST["submitcourses"])) {
    $result = uploadCSV("course.csv");
    if ($result) {
//any other processing for success
        log_action('Upload', 'Course file uploaded by ' . $name);
        redirect_to($_SERVER["PHP_SELF"]);
    } else {
//any other processing for fail
        log_action('Upload', 'Course file upload failed. Attempt by ' . $name);
        redirect_to($_SERVER["PHP_SELF"]);
    }
}

include_layout_template('header.php');
?>
<main>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-xs-12'>
                <?php echo output_message($message); ?>
            </div>
        </div>        
        <div class='row'>
            <!-- <div class='col-xs-'2 col-sm-">
                <br><br>
                <a href='https://www.facebook.com//'><img data-toggle='tooltip' title='Find us on Facebook' class='img-responsive' src='assets/images/facebook.png' alt='facebook'></a>
            </div> -->
            <div class='col-xs-12 col-sm-6 text'>
                <h3>Upload Instructors</h3>
                <form id='uploadinstructors' data-toggle='validator' role='form' action='<?php echo $_SERVER["PHP_SELF"]; ?>' enctype='multipart/form-data' method='POST'>
                    <input type='hidden' name='MAX_FILE_SIZE' value='<?php echo $max_file_size; ?>'>
                    <fieldset class='form-group'>
                        <label class='control-label' for='fileupload'>File to Upload</label>
                        <input class='form-control' type='file' required data-image='image' data-error='Please choose a csv file (.csv)' id='fileupload' name='file_upload'>
                        <span class='help-block with-errors'></span>
                    </fieldset>
                    <fieldset class='form-group'>
                        <span class='icon-input-btn'><span class='glyphicon glyphicon-cloud-upload'></span><input class='btn btn-primary' type='submit' name='submitinstructors' value='Upload' /></span>
                    </fieldset>
                </form>
            </div>
            <div class='col-xs-12 col-sm-6 text'>
                <h3>Upload Courses</h3>
                <form id='uploadcourses' data-toggle='validator' role='form' action='<?php echo $_SERVER["PHP_SELF"]; ?>' enctype='multipart/form-data' method='POST'>
                    <input type='hidden' name='MAX_FILE_SIZE' value='<?php echo $max_file_size; ?>'>
                    <fieldset class='form-group'>
                        <label class='control-label' for='fileupload'>File to Upload</label>
                        <input class='form-control' type='file' required data-image='image' data-error='Please choose a csv file (.csv)' id='fileupload' name='file_upload'>
                        <span class='help-block with-errors'></span>
                    </fieldset>
                    <fieldset class='form-group'>
                        <span class='icon-input-btn'><span class='glyphicon glyphicon-cloud-upload'></span><input class='btn btn-primary' type='submit' name='submitcourses' value='Upload' /></span>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</main>
<script src='bootstrap-validator-master/dist/validator.min.js'></script>
<script src='assets/js/index.js'></script>
<?php
include_layout_template('footer.php');
?>