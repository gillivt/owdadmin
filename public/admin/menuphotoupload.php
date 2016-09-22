<?php
require_once('../../database/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
?>
<?php
$max_file_size = 10485760;   // expressed in bytes (10MB)
//     10240 =  10 KB
//    102400 = 100 KB
//   1048576 =   1 MB
//  10485760 =  10 MB

if (isset($_POST['submit'])) {
    $menuPhoto = new MenuPhotos();
    $menuPhoto->caption = $_POST['caption'];
    $menuPhoto->attach_file($_FILES['file_upload']);
    if ($menuPhoto->save()) {
        // Success        
        $session->message("<div class='alert alert-success'><span class='glyphicon glyphicon-ok-sign'></span>&nbsp&nbsp;Photograph Uploaded Successfully.</div>");
        $user = User::find_by_id($session->user_id);
        log_action("Image Uploaded ".$menuPhoto->filename, "By: ".$user->full_name());   
        redirect_to('listmenuphotos.php');
    } else {
        // Failure
        $message = join("<br />", $menuPhoto->errors);
    }
}
?>

<?php include_layout_template('header.php'); ?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h2>Menu Photo Upload</h2>
                <?php echo output_message($message); ?>
                <form id="uploadimage" data-toggle="validator" role="form" action="menuphotoupload.php" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>">
                    <fieldset class="form-group">
                        <label class="control-label" for="fileupload">File to Upload</label>
                        <input class="form-control" type="file" required data-image="image" data-error="Please choose an image file (.jpg/.png/.gif)" id="fileupload" name="file_upload">
                        <span class="help-block with-errors"></span>
                    </fieldset>
                    <fieldset class="form-group">
                        <label class="control-label" for="caption">Caption:</label>
                        <input class="form-control" type="text" id="caption" name="caption" required data-error="Caption is Required" value="">
                        <span class="help-block with-errors"></span>
                    </fieldset>
                    <fieldset class="form-group">
                        <span class="icon-input-btn"><span class="glyphicon glyphicon-cloud-upload"></span><input class="btn btn-primary" type="submit" name="submit" value="Upload" /></span>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="../bootstrap-validator-master/dist/validator.min.js"></script>
<script src="../assets/js/photo_upload.js"></script>
<?php include_layout_template('footer.php'); ?>
		
