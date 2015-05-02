<ul>
<?php if(zAuth()->isContentAuthorized("GD_PUBLISHER")) { ?>
<li class="menuheader">Accounting</li>
<li><a class="menulink" href="/tools/accounting/s_projects.php">Show Projects List</a></li>
<li><a class="menulink" href="/tools/accounting/s_create_billto.php">Bill Tos</a></li>
<li><a class="menulink" href="/tools/accounting/s_create_client.php">Clients</a></li>
<li><a class="menulink" href="/tools/accounting/s_create_project.php">Projects</a></li>
<?php } ?>
<?php if(zAuth()->isContentAuthorized("GD_PUBLISHER")) { ?>
<li class="menuheader">Resource Placement</li>
<li><a class="menulink" href="/tools/placement/s_create_requirement.php">Requirement</a></li>
<?php } ?>
<?php if(zAuth()->isContentAuthorized("GD_ADMIN")) { ?>
<li class="menuheader">UserSafety Admin</li>
<li><a class="menulink" href="/gd.trxn.com/usersafety/s_user_accounts.php?LEFT_MENU=/_controls/ui/left_menu/s_menu.php">User Accounts</a></li>
<?php } ?>
</ul>