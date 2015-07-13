<!-- START - Side bar ================================================== -->
<div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
    <a class="navmenu-brand" href="/">See Me U</a>
    <ul class="nav navmenu-nav">
        <li><a href="/s_user/home.php">Home</a></li>
    </ul>
    <ul class="nav navmenu-nav">
        <li id="nav_groupsowned" class="dropdown" style="display:none;"/>
        <li id="nav_groupsmembered" class="dropdown" style="display:none;"/>
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo "User UID [".zAppSysIntegration()->getAuthUserUid()."]"; ?>">User Data <b class="caret"></b></a>
        <ul class="dropdown-menu navmenu-nav">
<?php echo "<li>Is Authenticated [".zAppSysIntegration()->getAuthUserIsAuthenticated()."]</li>"; ?>
<?php echo "<li>User Table Key [".zAppSysIntegration()->getAuthUsertablekey()."]</li>"; ?>
        </ul>
        </li>
    </ul>
</div>
<!-- END - Side bar ================================================== -->
<?php echo "<title>".zAppSysIntegration()->getDefaultPageTitle()."</title>"; ?>