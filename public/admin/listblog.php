<?php require_once("../../database/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all blogs
  $blog = Blog::find_all();
?>
<?php include_layout_template('header.php'); ?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h2>Blog List</h2>
                <?php echo output_message($message); ?>
                <table class="table table-striped table-bordered table-responsive">
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Link Title</th>
                        <th>Link Address</th>
                        <th>Image</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?php foreach($blog as $blogItem): ?>
                    <tr>
                        <td><?php echo date('d/m/Y',strtotime($blogItem->date)); ?></td>
                        <td><?php echo esc_quot($blogItem->blogTitle); ?></td>
                        <td><?php echo "<button class='btn btn-info' data-trigger='hover' data-html='true' data-toggle='popover' title='" . esc_quot($blogItem->blogTitle) . "' data-content='" . nl2br(esc_quot($blogItem->blogContent)) . "'><span class='glyphicon glyphicon-info-sign'></span>&nbsp;&nbsp;Hover</button>" ?></td>
                        <td><?php echo $blogItem->linkTitle; ?></td>
                        <td><?php echo $blogItem->linkAddress; ?></td>
                        <td><img src="../assets/blogimages/<?php echo $blogItem->imageURL; ?>" width="100" /></td>
                        <td>
                            <a class="btn btn-danger" role="button" href="deleteblog.php?id=<?php echo $blogItem->id; ?>"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</a>
                        </td>
                        <td>
                            <a class="btn btn-warning" role="button" href="editblog.php?id=<?php echo $blogItem->id; ?>"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</main>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});
</script>
<script src="../assets/js/listblog.js"></script>
<?php include_layout_template('footer.php'); ?>
