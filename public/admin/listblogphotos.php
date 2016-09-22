<?php require_once("../../database/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $blogPhotos = BlogPhotos::find_all();
?>
<?php include_layout_template('header.php'); ?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h2>Blog Photographs</h2>
                <?php echo output_message($message); ?>
                <table class="table table-striped table-bordered table-responsive">
                    <tr>
                        <th>Image</th>
                        <th>Filename</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Type</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?php foreach($blogPhotos as $blogPhoto): ?>
                    <tr>
                        <td><img src="../<?php echo $blogPhoto->image_path(); ?>" width="100" /></td>
                        <td><?php echo $blogPhoto->filename; ?></td>
                        <td><?php echo $blogPhoto->description; ?></td>
                        <td><?php echo $blogPhoto->size_as_text(); ?></td>
                        <td><?php echo $blogPhoto->type; ?></td>
                        <td>
                            <a class="btn btn-danger" role="button" href="deleteblogphoto.php?id=<?php echo $blogPhoto->id; ?>"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</a>
                        </td>
                        <td>
                            <a class="btn btn-warning" role="button" href="editblogphoto.php?id=<?php echo $blogPhoto->id; ?>"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <br>
                <a class="btn btn-primary" role="button" href="blogphotoupload.php"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;Upload a new photograph</a>
            </div>
        </div>
    </div>
</main>

<script src="../assets/js/list_photos.js"></script>
<?php include_layout_template('footer.php'); ?>
