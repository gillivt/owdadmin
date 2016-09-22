<?php require_once("../../database/initialize.php"); ?>
<?php if (!$session->is_logged_in()) {
    redirect_to("login.php");
} ?>
<?php

//get or post?
if (isset($_POST['submit'])) {
    //form has been submitted update photo caption
    $caption = $database->escape_value($_POST['caption']);
    $id = $_POST['id'];
    $menuPhoto = MenuPhotos::find_by_id($id);
    $menuPhoto->caption = $caption;
    $menuPhoto->save();
    redirect_to('listmenuphotos.php');
} elseif (empty($_GET['id'])) {
    $session->message("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp&nbsp;No Photograph Id was provided.</div>");
    redirect_to('admin.php');
}

$menuPhoto = MenuPhotos::find_by_id($_GET['id']);
$caption = $menuPhoto->caption;
?>
<?php include_layout_template("header.php") ?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h3>Edit Photo</h3>
                <?php echo output_message($message); ?>
                <form role="form" action="editmenuphoto.php" method="post">
                    <div class="form-group">
                        <label for="caption">Caption:</label>
                        <input class="form-control" type="text" id="caption" name="caption" value="<?php echo $menuPhoto->caption; ?>">
                        <input type="hidden" name="id" value="<?php echo $menuPhoto->id; ?>">
                    </div>
                    <div class="form-group">
                        <span class="icon-input-btn"><span class="glyphicon glyphicon-cloud-upload"></span><input class="btn btn-warning" type="submit" name="submit" value="Update Caption"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>




<script src="../assets/js/edit_photo.js"></script>
<?php include_layout_template('footer.php'); ?>