<?php require_once("../../database/initialize.php"); ?>
<?php
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
?>
<?php
if (empty($_GET['id'])) {
    $session->message("No photograph ID was provided.");
    redirect_to('admin.php');
}

$photo = GalleryPhotos::find_by_id($_GET['id']);
if (!$photo) {
    $session->message("The photo could not be located.");
    redirect_to('admin.php');
}

$comments = $photo->comments();
?>
<?php include_layout_template('header.php'); ?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 text"><h3>Comments</h3>
                <a class="btn btn-primary" role="button" href="listgalleryphotos.php"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;&nbsp;Back</a><br><br>
                <h4>Comments on <?php echo $photo->filename; ?></h4>
                <?php echo output_message($message); ?>
                <div id="comments">
                    <?php foreach ($comments as $comment): ?>
                    <div class="comment" style="margin-bottom: 2em;">
                        <div class="author">
                            <?php echo htmlentities($comment->author); ?> wrote:
                        </div>
                        <div class="body">
                            <?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
                        </div>
                        <div class="meta-info" style="font-size: 0.8em;">
                            <?php echo datetime_to_text($comment->created); ?>
                        </div>
                        <div class="actions" style="font-size: 0.8em;">
                            <a class="btn btn-danger" role="button" href="delete_comment.php?id=<?php echo $comment->id; ?>"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete Comment</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php
                    if (empty($comments)) {
                        echo "No Comments.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>


<script src="../assets/js/comments.js" ></script>
<?php include_layout_template('footer.php'); ?>
