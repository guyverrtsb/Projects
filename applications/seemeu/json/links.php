<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
{
	"URLINKS" :
	[
	{ "display":"Home", "url":"/index.php" },
    { "display":"Secure User Index", "url":"/s_user/s_index.php" },
    { "display":"-----------", "url":"#" },
    { "display":"PHP Info", "url":"/gd.trxn.com/system/phpinfo.php" },
    { "display":"-----------", "url":"#" },
    { "display":"User Home", "url":"/s_user/home.php" },
    { "display":"Group Wall", "url":"/s_groups/wall.php" },
    { "display":"-----------", "url":"#" },
    { "display":"Activate Prospect", "url":"/unittest/activate_prospect.php" },
    { "display":"Upload Single", "url":"/gd.trxn.com/crossapplication/upload/single.php" },
    { "display":"Upload Multiple", "url":"/gd.trxn.com/crossapplication/upload/multiple.php" },
    { "display":"Upload Basic Plus", "url":"/gd.trxn.com/crossapplication/upload/basic_plus.php" },
    { "display":"-----------", "url":"#" },
    { "display":"Off Canvas", "url":"/gd.trxn.com/templates/offcanvas.php" },
    { "display":"-----------", "url":"#" },
    { "display":"unit Test Retrieve Data Set", "url":"/unittest/retrieve_datasets.php" },
    { "display":"unit Test Retrieve Groups", "url":"/unittest/retrieve_groups.php" }
    ]
    ,
    "SYS_SITE_VARIABLES" :
    [
    { "display":"SITE_UID", "value":"<?php echo zAppSysIntegration()->getSiteUid(); ?>" },
    { "display":"SITE", "value":"<?php echo zAppSysIntegration()->getSite(); ?>" },
    { "display":"SITE_ALIAS_UID", "value":"<?php echo zAppSysIntegration()->getSiteAliasUid(); ?>" },
    { "display":"SITE_ALIAS", "value":"<?php echo zAppSysIntegration()->getSiteAlias(); ?>" }
    ]
}
 



