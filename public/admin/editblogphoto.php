<?php require_once("../../database/initialize.php"); ?>
<?php if (!$session->is_logged_in()) {
    redirect_to("login.php");
} ?>
<?php

//get or post?
if (isset($_POST['submit'])) {
    //form has been submitted update photo caption
    $description = $database->escape_value($_POST['description']);
    $id = $_POST['id'];
    $blogPhoto = BlogPhotos::find_by_id($id);
    $blogPhoto->description = $description;
    $blogPhoto->save();
    redirect_to('listblogphotos.php');
} elseif (empty($_GET['id'])) {
    $session->message("No photograph ID was provided.");
    redirect_to('admin.php');
}

$blogPhoto = BlogPhotos::find_by_id($_GET['id']);
$description = $blogPhoto->description;
?>
<?php include_layout_template("header.php") ?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h3>Edit Photo</h3>
                <?php echo output_message($message); ?>
                <form role="form" action="editblogphoto.php" method="post">
                    <div class="form-group">
                        <label for="caption">Description:</label>
                        <input class="form-control" type="text" id="description" name="description" value="<?php echo $blogPhoto->description; ?>">
                        <input type="hidden" name="id" value="<?php echo $blogPhoto->id; ?>">
                    </div>
                    <div class="form-group">
                        <span class="icon-input-btn"><span class="glyphicon glyphicon-cloud-upload"></span><input class="btn btn-warning" type="submit" name="submit" value="Update Description"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>




<script src="../assets/js/edit_photo.js"></script>
<?php include_layout_template('footer.php'); ?>