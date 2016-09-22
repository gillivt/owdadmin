<?php
/*
 * File: createtestimonial.php
 * 
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 * 
 * Created: 04-Mar-2016 20:44:55
 * 
 * Purpose: Create testimonial item
 * 
 * Modification History:
 * 
 */
require_once("../../database/initialize.php");
// if not logged in redirect to login page
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}

if (isset($_POST['submit'])) {

    // Get form data
    $testimonial = new Testimonial();
    $testimonial->title = strip_tags($_POST['title']);
    $testimonial->name = strip_tags($_POST['name']);
    $testimonial->comment = strip_tags($_POST['comment']);
    date_default_timezone_set("Europe/London");
    $testimonial->date = date('Y-m-d');
    
    if ($testimonial->save()) {
        $session->message("<div class='alert alert-success' role='alert'>Comment Created Successfully</div>");
        $user = User::find_by_id($session->user_id);
        log_action("testimonial Created", "By: ".$user->full_name());   
        redirect_to('createtestimonial.php');
        
    } else {
        $session->message("<div class='alert alert-danger' role='alert'>failed to create testimonial</div>");
        redirect_to('admin.php');
    }
}
// Get an array of images from blogphotos table
// $images = BlogPhotos::find_all();

include_layout_template("header.php");
?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1>Create Comment / Testimonial</h1>
                <?php echo output_message($message); ?>
                <form id ="createtestimonial" data-toggle="validator" action="" role="form" method="post">
                    <div class="form-group">
                        <label class="control-label" for="title">Title:</label>
                        <input class="form-control" 
                               type="text" 
                               name="title" 
                               placeholder="enter comment title (usually a quote from main content e.g 'Fantastic Night')" 
                               id="title"
                               data-error="You must enter a comment title"
                               required>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="name">Name, Location:</label>
                        <input class="form-control" 
                               type="text" 
                               name="name" 
                               placeholder="enter a name & location (e.g. Bob, Ashby-de-la-Zouch, United Kingdom)" 
                               id="name"
                               data-error="You must enter a name and/or location"
                               required>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="comment">Comment:</label>
                        <textarea class="form-control"
                                  style="height: 300px;"
                                  name="comment" 
                                  id="comment"
                                  data-check="check"
                                  data-error="You must enter a comment"></textarea>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <span class="icon-input-btn"><span class="glyphicon glyphicon-plus-sign"></span><input class="btn btn-primary" type="submit" name="submit" value="Create Blog"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="../bootstrap-validator-master/dist/validator.min.js"></script>
<script src="../assets/js/createtestimonial.js"></script>
<?php
include_layout_template("footer.php");
?>
