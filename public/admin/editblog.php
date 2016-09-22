<?php
/*
 * File: editblog.php
 * 
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 * 
 * Created: 04-Mar-2016 20:44:55
 * 
 * Purpose: Edit blog item
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
    $blogTitle = strip_tags($_POST['blogtitle']);
    $blogContent = strip_tags($_POST['blogcontent']);
    $blogImageUrl = $_POST['imagesrc'];
    $blogLinkTitle = isset($_POST['linktitle']) ? strip_tags($_POST['linktitle']) : "";
    $blogLinkAddress = isset($_POST['linkurl']) ? strip_tags($_POST['linkurl']) : "";
    date_default_timezone_set("Europe/London");
    $blogDate = date('Y-m-d H:i:s');
    //form has been submitted... update
    $id = $_GET['id'];

    $blog = Blog::find_by_id($id);
    $blog->blogTitle = $blogTitle;
    $blog->blogContent = $blogContent;
    $blog->imageURL = $blogImageUrl;
    $blog->linkTitle = $blogLinkTitle;
    $blog->linkAddress = $blogLinkAddress;
    $blog->date = $blogDate;
   
    if ($blog->save()) {
        $session->message("<div class='alert alert-success' role='alert'>Blog Updated Successfully</div>");
        $user = User::find_by_id($session->user_id);
        log_action("Blog Updated", "By: ".$user->full_name());   
        redirect_to('listblog.php');
        
    } else {
        $session->message("<div class='alert alert-danger' role='alert'>Failed To Update Blog</div>");
        redirect_to('editblog.php?id='.$id);
    }
} elseif (empty($_GET['id'])) {
    $session->message("<div class='alert alert-danger' role='alert'>no blog id was provided</div>");
    redirect_to('listblog.php');
}

// Get an array of images from blogphotos table
$images = BlogPhotos::find_all();
$blog = Blog::find_by_id($_GET['id']);
include_layout_template("header.php");
?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1>Update Blog</h1>
                <?php echo output_message($message); ?>
                <form id ="createblog" data-toggle="validator" action="editblog?id='<?php echo $blog->id ?>'" role="form" method="post">
                    <div class="form-group">
                        <label class="control-label" for="blogtitle">Blog Title:</label>
                        <input class="form-control" 
                               type="text" 
                               name="blogtitle" 
                               placeholder="enter blog title" 
                               id="blogtitle"
                               data-error="You must enter a blog title"
                               required 
                               value="<?php echo $blog->blogTitle; ?>">
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="blogcontent">Blog Content:</label>
                        <textarea class="form-control"
                                  style="height: 300px;"
                                  name="blogcontent" 
                                  id="blogcontent"
                                  data-blog="blog"
                                  data-error="You must enter content for your blog"><?php echo $blog->blogContent; ?></textarea>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="imageurl">Please Select an Image for your Blog</label>
                        <select id="imageurl" class="form-control">
                            <?php $i = 0;
                            foreach ($images as $image): ?>
                                <option <?php if ($blog->imageURL === $image->filename){echo "selected='selected'";} ?> 
                                    value="<?php echo $i ?>"
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
                               placeholder="Optional Link Title (e.g. Google)"
                               value="<?php echo $blog->linkTitle; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="linkurl">Link Address</label>
                        <input type="url"
                               class="form-control" 
                               name="linkurl" id="linkurl" 
                               placeholder="Optional Link Address (e.g. http://www.google.co.uk)"
                               data-error="Must be a valid hyperink"
                               value="<?php echo $blog->linkAddress; ?>">
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <span class="icon-input-btn"><span class="glyphicon glyphicon-cloud-upload"></span><input class="btn btn-warning" type="submit" name="submit" value="Update Blog"></span>
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
