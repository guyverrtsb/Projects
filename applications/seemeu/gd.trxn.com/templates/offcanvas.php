<?php require_once("../../gd.trxn.com/_controls/classes/_syscore.php"); 
zAppSysIntegration()->setDefaultPageTitle("Your Place to Start")
?>
<?php zInc("/gd.trxn.com/_controls/ui/templates/offcanvas/head.php"); ?>
<!-- START - Content ================================================== -->
<!-- START - Side bar ================================================== -->
<div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
    <a class="navmenu-brand" href="#">Project name</a>
    <ul class="nav navmenu-nav">
        <li><a href="../navmenu/">Slide in</a></li>
        <li class="active"><a href="./">Push</a></li>
        <li><a href="../navmenu-reveal/">Reveal</a></li>
        <li><a href="../navbar-offcanvas/">Off canvas navbar</a></li>
    </ul>
    <ul class="nav navmenu-nav">
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu navmenu-nav">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
        </ul>
        </li>
    </ul>
</div>
<!-- END - Side bar ================================================== -->
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
            <h1>Off Canvas Push Menu Template</h1>
        </div>
        <p class="lead">This example demonstrates the use of the offcanvas plugin with a push effect.</p>
        <p>You get the push effect by setting the <code>canvas</code> option to 'body'.</p>
        <p>Also take a look at the example for a navmenu with <a href="../navmenu">slide in effect</a> and <a href="../navmenu-reveal">reveal effect</a>.</p>
    </div>
<!-- END - Container ================================================== -->
</div>
<!-- END - Content ================================================== -->
<?php zInc("/gd.trxn.com/_controls/ui/templates/offcanvas/foot.php"); ?>


    
