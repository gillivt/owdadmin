<?php
require_once("../../database/initialize.php");
// if not logged in redirect to login page
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
/******************************************************************************
/* File: admin.php
/*
/* Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
/*
/* Created: 26-Jan-2016 16:41:31
/*
/* Purpose: present administration options
/*
/* Modification History:
/******************************************************************************/
include_layout_template("header.php");
// get user object
$user = User::find_by_id($session->user_id);
?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h2>Admin</h2>
                    <?php echo output_message($message); ?>
                    
                    <div class="list-group">
                        <a class="list-group-item list-group-item-info disabled" href="#">Log File</a>
                        <a class="list-group-item list-group-item-warning" href="logfile.php"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View Log File</a>
                        <a class="list-group-item list-group-item-info disabled" href="#">Menu</a>
                        <a class="list-group-item list-group-item-warning" href="menuphotoupload.php"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;Upload Photo To Menus</a>
                        <a class="list-group-item list-group-item-warning" href="listmenuphotos.php"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Menu Photos</a>
                        <a class="list-group-item list-group-item-info disabled" href="#">Gallery</a>
                        <a class="list-group-item list-group-item-warning" href="galleryphotoupload.php"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;Upload Photo To Gallery</a>
                        <a class="list-group-item list-group-item-warning" href="listgalleryphotos.php"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Gallery Photos</a>
                        <a class="list-group-item list-group-item-info disabled" href="#">Blog</a>
                        <a class="list-group-item list-group-item-warning" href="blogphotoupload.php"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;Upload Photo to Blog Photo Library</a>
                        <a class="list-group-item list-group-item-warning" href="listblogphotos.php"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Blog Photos</a>
                        <a class="list-group-item list-group-item-warning" href="createblog.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Create Blog Entry</a>
                        <a class="list-group-item list-group-item-warning" href="listblog.php"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Blog Entries</a>
                        <a class="list-group-item list-group-item-info disabled" href="#">Testimonals</a>
                        <a class="list-group-item list-group-item-warning" href="createtestimonial.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Create Customer Comment / Testimonial</a>
                        <a class="list-group-item list-group-item-warning" href="listtestimonials.php"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Customer Comments / Testimonials</a>
                        <a class="list-group-item list-group-item-info disabled" href="#">Admin Exit</a>
                        <a class="list-group-item list-group-item-warning" href="logout.php"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;Log Out / Sign Off / Auf Wieder Sehen / Au Revoir / 再见 / Arrivederci / Adiós</a>
                    </div>
            </div>
        </div>
    </div>
</main>

<script src="../assets/js/admin.js"></script>
<?php
include_layout_template("footer.php");
?>