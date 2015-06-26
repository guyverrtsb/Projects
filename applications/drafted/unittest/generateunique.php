<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/generateuniquevalue.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
class UnitTest_GenerateUniqueValue
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    /*
     * This Method is used when Creating
     * User Account and User Profile and Matching.
     * This account will be inactive.
     * the Task Control Unique QS will be generated.
     * You may access using the getTaskCountrolQS method
     */
    function test($args)
    {
        $guvutk = new GenerateUniqueValue();
        return $guvutk->generate($args["dbcon"], $args["table"], $args["field"],  $args["value"]);
    }
}
$ut_guv = new UnitTest_GenerateUniqueValue();

$args["dbcon"] = "USERSAFETY";
$args["table"] = "useraccount";
$args["field"] = "usertablekey";
$args["value"] = "SEEMEUPROSPECT";

echo $ut_guv->test($args);
?>