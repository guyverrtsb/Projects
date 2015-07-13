<!-- START - Navigation ================================================== -->
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">See Me U</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
        <ul id="gdtrxncomnav" class="nav navbar-nav">
            <!-- li class="active"><a href="#">Scholarships</a></li -->
            <li><a href="/colleges.php">Colleges</a></li>
            <li><a href="/scholarships.php">Scholarships</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <?php if(zAppSysIntegration()->getAuthUserIsAuthenticated() == "T") { ?>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">User Data <b class="caret"></b></a>
            <ul class="dropdown-menu navmenu-nav">
            <?php echo "<li>User UID [".zAppSysIntegration()->getAuthUserUid()."]</li>"; ?>
            <?php echo "<li>Is Authenticated [".zAppSysIntegration()->getAuthUserIsAuthenticated()."]</li>"; ?>
            <?php echo "<li>User Table Key [".zAppSysIntegration()->getAuthUsertablekey()."]</li>"; ?>
            </ul>
            </li>
        <?php } ?>
        </ul>
    </div>
</div>
</nav>
<!-- END - Navigation ================================================== -->
