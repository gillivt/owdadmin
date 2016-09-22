<?php
require_once("../database/initialize.php");
// if not logged in redirect to login page
if (!$session->is_logged_in()) {redirect_to("login.php");}

$logfile = SITE_ROOT . DS . 'logs' . DS . 'log.txt';

if (isset($_GET['clear']) && $_GET['clear'] == 'true') {
    file_put_contents($logfile, '');
    //get user name
    //$user = User::find_by_id($session->user_id);
    // Add the first log entry
    log_action('Logs Cleared', "by User {$name}");
    // redirect to this same page so that the URL won't 
    // have "clear=true" anymore
    redirect_to('logfile.php');
}
include_layout_template("header.php");
?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <br />
                <h2>Log File</h2>
                <p><a class="btn btn-danger" role="button" href="logfile.php?clear=true"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Clear log file</a><p>
                <?php
                if (file_exists($logfile) && is_readable($logfile) &&
                    $handle = fopen($logfile, 'r')) {  // read
                        echo "<ul class=\"log-entries\">";
                        while (!feof($handle)) {
                            $entry = fgets($handle);
                            if (trim($entry) != "") {
                                echo "<li>{$entry}</li>";
                            }
                        }
                        echo "</ul>";
                        fclose($handle);
                } else {
                    echo "Could not read from {$logfile}.";
                }
                ?>
            </div>
        </div>
    </div>
</main>

<script src="assets/js/logfile.js"></script>
<?php
include_layout_template("footer.php");
?>
