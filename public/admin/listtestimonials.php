<?php require_once("../../database/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all blogs
  $testimonials = Testimonial::find_all();
?>
<?php include_layout_template('header.php'); ?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h2>Testimonial List</h2>
                <?php echo output_message($message); ?>
                <table class="table table-striped table-bordered table-responsive">
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Comment</th>
                        <th>Name</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?php foreach($testimonials as $testimonial): ?>
                    <tr>
                        <td><?php echo date('jS F Y',strtotime($testimonial->date)); ?></td>
                        <td><?php echo esc_quot($testimonial->title); ?></td>
                        <td><?php echo "<button class='btn btn-info' data-trigger='hover' data-html='true' data-toggle='popover' title='" . esc_quot($testimonial->title) . "' data-content='" . nl2br(esc_quot($testimonial->comment)) . "'><span class='glyphicon glyphicon-info-sign'></span>&nbsp;&nbsp;Hover</button>" ?></td>
                        <td><?php echo $testimonial->name; ?></td>
                        <td>
                            <a class="btn btn-danger" role="button" href="deletetestimonial.php?id=<?php echo $testimonial->id; ?>"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</a>
                        </td>
                        <td>
                            <a class="btn btn-warning" role="button" href="edittestimonial.php?id=<?php echo $testimonial->id; ?>"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a>
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
<script src="../assets/js/listtestimonial.js"></script>
<?php include_layout_template('footer.php'); ?>
