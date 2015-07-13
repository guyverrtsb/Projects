<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); 
zAppSysIntegration()->setDefaultPageTitle("Wall");
?>
<?php zInc("/_controls/ui/templates/secure/head.php"); ?>
<style>
#uploadbox { 
    margin-top:30px;
    width:500px;
    }
#upload_preview {
    background: #ccc;
    height:470px; width:470px;
    /*line-height: 50px;
    text-align: center;
    font-weight: bold;
    border:5px dashed #eee;*/
    margin:auto;
    }
#upload_progress {
    width:470px;
    margin:auto;
    }
</style>
<!-- START - Content ================================================== -->
<div class="canvas">
<!-- START - Button Nav Toggle ================================================== -->
    <div class="navbar navbar-default navbar-fixed-top">
        <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
    </div>
<!-- END - Button Nav Toggle ================================================== -->
<!-- START - Container ================================================== -->
    <div id="uploadbox" class="container">
        <div id="row_upload_icons" class="row">
            <div class="col-lg-12">
                <span class="btn btn-success fileinput-button">
                    <span class="glyphicon glyphicon-camera"></span>
                    <input id="fileupload" type="file" name="files[]" multiple>
                </span>
            </div>
        </div>
        <div id="row_upload_header" class="row">
            <div class="col-lg-12">
                <!-- Headline Input Box -->
                <label for="inputHeadline" class="sr-only">Headline</label>
                <input type="email" id="inputHeadline" name="headline" class="form-control" placeholder="Header Line" required autofocus>
            </div>
        </div>
        <div id="row_upload_progress" class="row">
            <div class="col-lg-12 col-centered">
                <!-- The global progress bar -->
                <div id="upload_progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
            </div>
        </div>
        <div id="row_upload_messageline" class="row hidden">
            <div class="col-lg-12 col-centered"></div>
        </div>
        <div id="row_upload_preview" class="row">
            <div class="col-lg-12 center">
                <div id="upload_preview"></div>
            </div>
        </div>
        <div id="row_upload_header" class="row">
            <div class="col-lg-12">
                <!-- Description Input Box -->
                <label for="inputDescription" class="sr-only">Description</label>
                <input type="email" id="inputDescription" name="description" class="form-control" placeholder="Description" required autofocus>
            </div>
        </div>
        <div id="row_upload_button" class="row">
            <button id="upload_button" class="btn btn-lg btn-primary btn-block" type="button">Upload</button>
        </div>
        <div id="row_upload_files" class="row hidden">
            <div class="col-lg-12 col-centered">
                <!-- The container for the uploaded files -->
                <div id="files" class="files"></div>
            </div>
        </div>
<!-- START - Footer ================================================== -->
        <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
<!-- END - Footer ================================================== -->
    </div>
<!-- END - Container ================================================== -->
</div>
<!-- END - Content ================================================== -->
<?php zInc("/_controls/ui/templates/secure/foot.php"); ?>