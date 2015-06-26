<?php require_once("../../gd.trxn.com/_controls/classes/_syscore.php");
zAppSysIntegration()->setDefaultPageTitle("Task Control Output");
?>
<?php zInc("/gd.trxn.com/_controls/ui/templates/default/head.php"); ?>
<!-- START - Content ================================================== -->
<!-- START - Container ================================================== -->
<div class="container">
<!-- START - Jumbotron ================================================== -->
    <div class="jumbotron">
    <!-- START - Component Message Line ================================================== -->
    <?php
    printf("<h1>%s</h1>", zAppSysIntegration()->getUIPageResponseCode());
    printf("<p id=\"messageline\" class=\"row\">[%s]-%s</p", zAppSysIntegration()->getUIPageResponseCode(), zAppSysIntegration()->getUIPageResponseMsg());
    zAppSysIntegration()->cleanUIPageResponseData();
    ?>
    <!-- END - Component Message Line ================================================== -->
    <p><a class="btn btn-lg btn-primary" href="/" role="button">Return to Home</a></p>
    </div>
<!-- END - Jumbotron ================================================== -->

<!-- START - Footer ================================================== -->
    <footer>
    <p class="pull-right"><a href="#">Back to top</a></p>
    <p>&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
<!-- END - Footer ================================================== -->
</div>
<!-- END - Container ================================================== -->
<!-- END - Content ================================================== -->
<?php zInc("/gd.trxn.com/_controls/ui/templates/default/foot.php"); ?>