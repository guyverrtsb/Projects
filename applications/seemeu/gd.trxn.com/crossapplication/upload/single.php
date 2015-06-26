<?php require_once("../../../gd.trxn.com/_controls/classes/_syscore.php");
zAppSysIntegration()->setDefaultPageTitle("Task Control Output");
?>
<?php zInc("/gd.trxn.com/_controls/ui/templates/upload/head.php"); ?>
<style>
#uploadbox { 
    margin-top:30px;
    width:600px;
    }
#upload_preview {
    background: #ccc;
    height:500px; width:500px;
    /*line-height: 50px;
    text-align: center;
    font-weight: bold;
    border:5px dashed #eee;*/
    margin:auto;
    }
#upload_progress {
    width:500px;
    margin:auto;
    }
</style>
<!-- START - Content ================================================== -->
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
    <div id="row_upload_messageline" class="row hidden">
        <div class="col-lg-12 col-centered"></div>
    </div>
    <div id="row_upload_preview" class="row">
        <div class="col-lg-12 center">
            <div id="upload_preview"></div>
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
<!-- END - Content ================================================== -->
<?php zInc("/gd.trxn.com/_controls/ui/templates/upload/foot.php"); ?>