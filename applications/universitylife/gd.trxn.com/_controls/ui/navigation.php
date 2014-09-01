<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/accesscontrol.php"); ?>
<div id="gdHeader">
<div>
<a href="/index.php"><img src="/gd.trxn.com/mimes/images/logos/Guyver-Designs-Web-Site-Logo-w188h59.png"/></a>
</div>
<div id="headerNav">
<?php
$gdauth = new GDAccessControl();
if($gdauth->isAthenticated())
{
    printf("<a class=\"buttonBlue usersafety\" title=\"Login\" href=\"/gd.trxn.com/usersafety/_controls/ajax/USER_ACCESS.php?GD_CONTROLLER_KEY=LOGIN_USER_OUT\">Logout</a>");
    printf("<a class=\"buttonBlue usersafety\" title=\"User\" href=\"%s\">User</a>", ZAppConfigurations::getRedirectAuthLoggedinPage());
}
else
{
    printf("<a class=\"buttonBlue login\" title=\"Login\" href=\"/gd.trxn.com/usersafety/siteaccess.php\">Login</a>");
}
?>
<a class="buttonBlue default" title="Services" href="/gd.trxn.com/usersafety/siteaccess.php">Services</a>
<a class="buttonBlue default" title="Services" href="/gd.trxn.com/usersafety/siteaccess.php">Products</a>
<a class="buttonBlue default" title="Services" href="/gd.trxn.com/usersafety/siteaccess.php">Questions</a>
</div>
</div>