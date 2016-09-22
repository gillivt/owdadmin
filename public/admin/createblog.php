<?php
/*
 * File: createblog.php
 * 
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 * 
 * Created: 04-Mar-2016 20:44:55
 * 
 * Purpose: Create blog item
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
    $blog = new Blog();
    $blog->blogTitle = strip_tags($_POST['blogtitle']);
    $blog->blogContent = strip_tags($_POST['blogcontent']);
    $blog->imageURL = $_POST['imagesrc'];
    $blog->linkTitle = isset($_POST['linktitle']) ? strip_tags($_POST['linktitle']) : "";
    $blog->linkAddress = isset($_POST['linkurl']) ? strip_tags($_POST['linkurl']) : "";
    date_default_timezone_set("Europe/London");
    $blog->date = date('Y-m-d H:i:s');
    
    if ($blog->save()) {
        $session->message("<div class='alert alert-success' role='alert'>Blog Created Successfully</div>");
        $user = User::find_by_id($session->user_id);
        log_action("Blog Created", "By: ".$user->full_name());   
        redirect_to('createblog.php');
        
    } else {
        $session->message("<div class='alert alert-danger' role='alert'>failed to create blog</div>");
        redirect_to('createblog.php');
    }
}
// Get an array of images from blogphotos table
$images = BlogPhotos::find_all();

include_layout_template("header.php");
?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1>Create Blog</h1>
                <?php echo output_message($message); ?>
                <form id ="createblog" data-toggle="validator" action="" role="form" method="post">
                    <div class="form-group">
                        <label class="control-label" for="blogtitle">Blog Title:</label>
                        <input class="form-control" 
                               type="text" 
                               name="blogtitle" 
                               placeholder="enter blog title" 
                               id="blogtitle"
                               data-error="You must enter a blog title"
                               required>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="blogcontent">Blog Content:</label>
                        <textarea class="form-control"
                                  style="height: 300px;"
                                  name="blogcontent" 
                                  id="blogcontent"
                                  data-blog="blog"
                                  data-error="You must enter content for your blog"></textarea>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="imageurl">Please Select an Image for your Blog</label>
                        <select id="imageurl" class="form-control">
                            <?php $i = 0;
                            foreach ($images as $image): ?>
                                <option value="<?php echo $i ?>"
                                        data-description="<?php echo $image->filename ?>"
                                        data-imagesrc="<?php echo "../assets/blogimages/" . $image->filename ?>"><?php echo $image->description ?>
                                </option>
                            <?php $i++;
                            endforeach; ?>
                        </select>
                        <input type="hidden" name="imagesrc" id="imagesrc">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="linktitle">Link Title</label>
                        <input type="text" class="form-control"
                               name="linktitle"
                               id="linktitle" 
                               placeholder="Optional Link Title (e.g. Google)">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="linkurl">Link Address</label>
                        <input type="url"
                               class="form-control" 
                               name="linkurl" 
                               id="linkurl" 
                               placeholder="Optional Link Address (e.g. http://www.google.co.uk)"
                               data-error="Must be a valid hyperink">
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
<script src="../assets/js/ddslick.js"></script>
<script src="../assets/js/createblog.js"></script>
<?php
include_layout_template("footer.php");
?>
