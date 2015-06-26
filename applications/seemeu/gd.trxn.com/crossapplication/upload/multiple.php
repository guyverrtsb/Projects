<?php require_once("../../../gd.trxn.com/_controls/classes/_syscore.php");
zAppSysIntegration()->setDefaultPageTitle("Task Control Output");
?>
<?php zInc("/gd.trxn.com/_controls/ui/templates/upload/head.php"); ?>
<style>
#uploadbox { 
    margin-top:10px;
    }
</style>
<!-- START - Content ================================================== -->
<!-- START - Container ================================================== -->
<div class="container">
    <div id="uploadbox" class="row">
        <div class="col-lg-12">
            <span class="btn btn-success fileinput-button">
                <span class="glyphicon glyphicon-plus"></span>
                <span>Add files...</span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="fileupload" type="file" name="files[]" multiple>
            </span>
        </div>
        <div class="col-lg-12">
            <!-- The global progress bar -->
            <div id="progress" class="progress">
                <div class="progress-bar progress-bar-success"></div>
            </div>
        </div>
        <div class="col-lg-12">
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