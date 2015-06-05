<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
{
	"URLINKS" :
	[
	{ "display":"Home", "url":"/index.php" },
    { "display":"Usersafety Index", "url":"/gd.trxn.com/usersafety/index.php" },
    { "display":"Usersafety Home", "url":"/s_user_home.php" },
    { "display":"Site Template", "url":"/index.php" },
    { "display":"Large File Share", "url":"/utilities/largefileshare/upload.php" },
    { "display":"PHP Info", "url":"/gd.trxn.com/system/phpinfo.php" },
    { "display":"-----------", "url":"#" },
    { "display":"JQ Upload Basic", "url":"/gd.trxn.com/upload/basic.php" },
    { "display":"JQ Upload Basic Plus", "url":"/gd.trxn.com/jq_upload/basic-plus.html" },
    { "display":"JQ Upload UI", "url":"/gd.trxn.com/jq_upload/jquery-ui.html" }
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
 



