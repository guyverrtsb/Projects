<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); 
zAppSysIntegration()->setDefaultPageTitle("Your Place to Start")
?>
<?php zInc("/_controls/ui/templates/secure/head.php"); ?>
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
    <div class="container">
        <div class="page-header">
            <h1>Choose the file to upload...</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form id="GDUploadForm" class="upload-form" action="/_controls/ajax/WALL_MESSAGE.php" method="post" enctype="multipart/form-data" >
                <button class="btn btn-lg btn-primary btn-block" type="button" onclick="UserSafety_Login(this);">Sign in</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="GDUploadProgressBox"><div id="GDUploadProgressBar"></div><div id="GDUploadProgressBarStatusTxt">0%</div></div>
            </div>
        </div>
    </div>
<!-- END - Container ================================================== -->
</div>
<!-- END - Content ================================================== -->
<?php zInc("/_controls/ui/templates/secure/foot.php"); ?>


    
