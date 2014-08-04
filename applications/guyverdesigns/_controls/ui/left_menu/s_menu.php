<ul>
<?php if(gdauth()->isContentAuthorized("GD_PUBLISHER")) { ?>
<li class="menuheader">Accounting</li>
<li><a class="menulink" href="/accounting/s_billto.php">Bill Tos</a></li>
<li><a class="menulink" href="/accounting/s_client.php">Clients</a></li>
<li><a class="menulink" href="/accounting/s_project.php">Projects</a></li>
<li><a class="menulink" href="/accounting/s_projects.php">Show Projects List</a></li>
<?php } ?>
<?php if(gdauth()->isContentAuthorized("GD_ADMIN")) { ?>
<li class="menuheader">UserSafety Admin</li>
<li><a class="menulink" href="/gd.trxn.com/usersafety/s_user_accounts.php">User Accounts</a></li>
<?php } ?>
</ul>