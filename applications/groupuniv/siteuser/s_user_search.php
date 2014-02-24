<?php require_once("../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/ui/header.php") ?>
<?php gdreqonce("/_controls/classes/authorize.php"); ?>
<?php
$zauth = new zAuthorize();
if($zauth->isSiteUser())
{
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">University Meet</title>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php") ?>
<style>
#SearchFieldLarge { width:400px; }
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
<li><form id="SearchForm" class="form"><ul id="CBWorkAreaCenter">
    <li class="cbheader">Search</li>
    <li id="TransactionErr" class="error">&nbsp;</li>
    <li><table>
        <tr>
        <td colspan="4"><input type="input" id="SearchFieldLarge" name="searchfield" value=""/></td>
        <td><a class="miniButtonBlue" name="navtop" onclick="gdLoadContentBlocksforSearch();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
        </tr>
        <tr>
        <td><input type="radio" id="searchcfg_university" name="searchcfg" value="SEARCH_OBJECT_UNIVERSITY"/>University</td>
        <td><input type="radio" id="searchcfg_group" name="searchcfg" value="SEARCH_OBJECT_GROUP"/>Group</td>
        <td><input type="radio" id="searchcfg_wallmessage" name="searchcfg" value="SEARCH_OBJECT_WALL_MESSAGE"/>Wall Message</td>
        <td><input type="radio" id="searchcfg_user" name="searchcfg" value="SEARCH_OBJECT_USER"/>User</td>
        <td>&nbsp;</td>
        </tr>
        </table></li>
    <li id="CEResultsTOP">&nbsp;</li>
    <li id="CEResultsBOTTOM">&nbsp;</li>
    </ul></form></li>
<li><ul id="CBWorkAreaRight">
    <li class="cbheader">Notifcations</li>
    <?php gdinc("/_controls/ui/siteuser_right_menu.php") ?>
    </ul></li>
</ul>
</div>
UNIV_MEET_AUTH_USER_UID  :<?php echo $_SESSION["UNIV_MEET_AUTH_USER_UID"]; ?><br/>
UNIV_MEET_AUTH_VALID_TF  :<?php echo $_SESSION["UNIV_MEET_AUTH_VALID_TF"]; ?><br/>
UNIV_MEET_AUTH_UNIV_UID  :<?php echo $_SESSION["UNIV_MEET_AUTH_UNIV_UID"]; ?><br/>
UNIV_MEET_AUTH_UNIV_SDESC:<?php echo $_SESSION["UNIV_MEET_AUTH_UNIV_SDESC"]; ?><br/>
</body>
</html>
<?php } // Authentication End ?>