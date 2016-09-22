<?php
/*
 * File: edittestimonial.php
 * 
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 * 
 * Created: 04-Mar-2016 20:44:55
 * 
 * Purpose: Edit testimonial item
 * 
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
    //Get for data
    $title = strip_tags($_POST['title']);
    $comment = strip_tags($_POST['comment']);
    $name = $_POST['name'];
    date_default_timezone_set("Europe/London");
    $date = date('Y-m-d');
    //form has been submitted... update
    $id = $_GET['id'];

    $testimonial = Testimonial::find_by_id($id);
    $testimonial->title = $title;
    $testimonial->comment = $comment;
    $testimonial->name = $name;
    $testimonial->date = $date;
   
    if ($testimonial->save()) {
        $session->message("<div class='alert alert-success' role='alert'>Comment Updated Successfully</div>");
        $user = User::find_by_id($session->user_id);
        log_action("Testimonial Updated", "By: ".$user->full_name());   
        redirect_to('listtestimonials.php');
        
    } else {
        $session->message("<div class='alert alert-danger' role='alert'>Failed To Update Comment</div>");
        redirect_to('edittestimonial.php?id='.$id);
    }
} elseif (empty($_GET['id'])) {
    $session->message("<div class='alert alert-danger' role='alert'>no testimonial id was provided</div>");
    redirect_to('listtestimonials.php');
}

$testimonial = Testimonial::find_by_id($_GET['id']);
include_layout_template("header.php");
?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h2>Update Comment</h2>
                <?php echo output_message($message); ?>
                <form id ="createtestimonial" data-toggle="validator" action="edittestimonial.php?id='<?php echo $testimonial->id; ?>'" role="form" method="post">
                    <div class="form-group">
                        <label class="control-label" for="title">Title:</label>
                        <input class="form-control" 
                               type="text" 
                               name="title" 
                               placeholder="enter comment title" 
                               id="title"
                               data-error="You must enter a title"
                               required 
                               value="<?php echo $testimonial->title; ?>">
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
                               required
                               value="<?php echo $testimonial->name; ?>">
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="comment">Comment:</label>
                        <textarea class="form-control"
                                  style="height: 300px;"
                                  name="comment" 
                                  id="comment"
                                  data-check="check"
                                  data-error="You must enter a comment"><?php echo $testimonial->comment; ?></textarea>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <span class="icon-input-btn"><span class="glyphicon glyphicon-cloud-upload"></span><input class="btn btn-warning" type="submit" name="submit" value="Update Comment"></span>
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
