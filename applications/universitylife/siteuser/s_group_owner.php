<?php require_once("../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/authorize.php"); ?>
<?php
$zauth = new zAuthorize();
if($zauth->isGroupOwner())
{
?>
<?php gdreqonce("/_controls/ui/header.php") ?>
<?php gdreqonce("/_controls/classes/allowed.php"); ?>
<?php gdreqonce("/_controls/classes/find/group.php"); ?>
<?php gdreqonce("/_controls/classes/find/search.php"); ?>
<?php
    $zfgroup = new zFindGroup();
    $zfgroup->findAccountandProfileByUid($_SESSION["UNIV_MEET_GROUP_ACCOUNT_UID"]);
?>
<?php gdreqonce("/_controls/classes/find/group.php"); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">
<?php printf("%s</title>",$zfgroup->getGA_Ldesc() ); ?>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php") ?>
<style>

</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script>

</script>
</head>
<body>
<div id="ContentWrapper">
<ul id="CBHorizWorkArea">
<li><ul id="CBWorkAreaLeft">
    <li class="cbheader">Menu</li>
<?php gdinc("/_controls/ui/siteuser_left_menu.php") ?>
    </ul></li>
<li><form id="UpdateGroupAccountFrm" class="form"><ul id="CBWorkAreaCenter">
<?php printf("<li class=\"cbheader\">Account for %s</li>", $zfgroup->getGA_Ldesc()); ?>
    <li id="GroupAccountErr" class="error">&nbsp;</li>
<?php printf('    <li class="groupline">Description<textarea class="rounded" type="text" id="ga_ldesc" name="ga_ldesc" cols="50" rows="5">%s</textarea></li>', $zfgroup->getGA_Ldesc()); ?>
<?php printf('    <li class="groupline">Group Type<select class="rounded" id="ga_group_type" name="ga_group_type" configuration="GROUPTYPE|%s"></select></li>', $zfgroup->getCfgGroupTypeSdesc()); ?>
<?php printf('    <li class="groupline">Group Acceptance<select class="rounded" id="ga_group_useracceptance" name="ga_group_useracceptance" configuration="GROUPACCEPTANCE|%s"></select></li>', $zfgroup->getCfgGroupUASdesc()); ?>
<?php printf('    <li class="groupline">Group Visibility<select class="rounded" id="ga_group_visibility" name="ga_group_visibility" configuration="GROUPVISIBILITY|%s"></select></li>', $zfgroup->getCfgGroupVisiSdesc()); ?>
    </form>
    <form id="UpdateGroupProfileFrm" class="form">
    <li class="cbheader">Profile</li>
    <li id="GroupProfileErr" class="error">&nbsp;</li>
<?php printf('    <li class="groupline">Valid To Date<input class="rounded" id="gp_validtodate" name="gp_validtodate" value="%s"/></li>',  $zfgroup->getGP_Validtodate()); ?>
<?php printf('    <li class="groupline">Content<textarea class="rounded" type="text" id="gp_content" name="gp_content" cols="50" rows="5">%s</textarea></li>', $zfgroup->getGP_Content()); ?>
    </form>
    <form id="UpdateGroupLocationFrm" class="form">
    <li class="cbheader">Location</li>
    <li id="GroupLocationErr" class="error">&nbsp;</li>
    <li class="groupline">Profile</li>
    </form>
    <form id="UpdateGroupSearchkeysFrm" class="form">
    <li class="cbheader">Search Keys</li>
    <li id="GroupSearchkeysErr" class="error">&nbsp;</li>
<?php
$zfsearch = new zFindSearchData();
$zfsearch->findSearchRecords($_SESSION["UNIV_MEET_GROUP_ACCOUNT_UID"]);
$page_search_records = $zfsearch->getResults_SearchRecordsBySearchObjectsandRecordUID();
$searchcounter = 0;
while ($row = $page_search_records->fetch(PDO::FETCH_ASSOC))
{
    printf('<li class="groupline">Content<input class="rounded" type="text" id="searchuid_%s" name="searchuid_%s" value="%s"/></li>', $searchcounter, $searchcounter, $row["content"]);
    $searchcounter++;
}
?>
    </ul></form></li>
<li><ul id="CBWorkAreaRight">
    <li class="cbheader">Notifications</li>
    <?php gdinc("/_controls/ui/siteuser_right_menu.php") ?>
    </ul></li>
</ul>
</div>
</body>
</html>
<?php } // Authentication End ?>