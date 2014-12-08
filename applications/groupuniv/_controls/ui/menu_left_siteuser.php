<?php gdreqonce("/_controls/classes/allowed.php");
$zallowed = new zAllowed();
?>
<li class="menuheader">Links</li>
<?php if($zallowed->isGroupOwner()){printf("<li><a class=\"menulink\" href=\"s_group_owner.php\">Group Settings</a></li>");}?>
<li><a class="menulink" href="s_user_account.php">My Account</a></li>
<li><a class="menulink" href="s_user_search.php">Search</a></li>
<li><a class="menulink" href="s_messages_home.php">Messages</a></li>
<?php
gdreqonce("/_controls/classes/find/group.php");
$zfgroupIOwn = new zFindGroup();
$zfgroupIOwn->findGroupsforUserbyRole("USER_ROLE_GROUP_OWNER");?>
<li class="menuheader">My Groups I Own</li>
<?php
foreach ($zfgroupIOwn->getResults_Groups() as $row)
{
    $zfgroupIOwn->setResult_Group($row);
    $ga_uid = $zfgroupIOwn->getGA_Uid();
    $ga_ldesc = $zfgroupIOwn->getGA_Ldesc();
    if(gdconfig()->getSessGroupUid() == $ga_uid)
    {
printf("<li>*<a class=\"menulink\" href=\"/_controls/ajax/PAGE_DIRECT.php?GD_CONTROL_KEY=GROUP_HOME&ga_uid=%s\">%s</a></li>", $ga_uid, $ga_ldesc);
    }
    else
    {
printf("<li><a class=\"menulink\" href=\"/_controls/ajax/PAGE_DIRECT.php?GD_CONTROL_KEY=GROUP_HOME&ga_uid=%s\">%s</a></li>", $ga_uid, $ga_ldesc);
    }
} ?>
<?php
$zfgroupIBelong = new zFindGroup();
$zfgroupIBelong->findGroupsforUserbyRole("USER_ROLE_GROUP_USER");
?>
<li class="menuheader">Groups I Belong To</li>
<?php
foreach ($zfgroupIBelong->getResults_Groups() as $row)
{
    $zfgroupIBelong->setResult_Group($row);
    $ga_uid = $zfgroupIBelong->getGA_Uid();
    $ga_ldesc = $zfgroupIBelong->getGA_Ldesc();
    if(gdconfig()->getSessGroupUid() == $ga_uid)
    {
printf("<li>*<a class=\"menulink\" href=\"/_controls/ajax/PAGE_DIRECT.php?GD_CONTROL_KEY=GROUP_HOME&ga_uid=%s\">%s</a></li>", $ga_uid, $ga_ldesc);
    }
    else
    {
printf("<li><a class=\"menulink\" href=\"/_controls/ajax/PAGE_DIRECT.php?GD_CONTROL_KEY=GROUP_HOME&ga_uid=%s\">%s</a></li>", $ga_uid, $ga_ldesc);
    }
} ?>