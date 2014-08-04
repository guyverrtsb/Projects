    <!-- HEADER -->
    <div id="header">
        <div id="logo"><img src="/gd.trxn.com/mimes/images/logos/gdLogo_w45h70.png"/></div>
        <div id="top_info">Top Info</div>
        <div id="navbar">
            <ul>
<?php
if(gdauth()->isAuthenticated())
{
    printf("<li><a href=\"/gd.trxn.com/usersafety/_controls/ajax/USER_ACCESS.php\">Logout</a></li>");
    printf("<li><a href=\"%s\">User Home</a></li>", ZAppConfigurations::getRedirectAuthLoggedinPage());
}
else
{
    printf("<li><a href=\"/gd.trxn.com/usersafety/index.php\">Login</a></li>");
}
?>
                <li><a href="/gd.trxn.com/system/links.php">System Links</a></li>
                <li><a href="URL">Link 3</a></li>
                <li><a href="URL">Link 4</a></li>
            </ul>
        </div>
    </div>

