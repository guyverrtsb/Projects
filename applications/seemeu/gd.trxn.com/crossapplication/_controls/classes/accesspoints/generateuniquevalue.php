<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/retrieve/unique.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
class GenerateUniqueValue
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
    function generate($APPDB, $tablename, $fieldname, $fieldvalue, $interval = 0)
    {
        zLog()->LogStartFUNCTION("generate");
        $mr = "NA";

        if($interval > 0)
            $fieldvalue = $fieldvalue."_".$interval;

        $cu = new CountUnique();
        $cu->countUniqueFieldValue($APPDB, $tablename, $fieldname, $fieldvalue);
        
        if($cu->getNumofRecords() == 0)
        {
            zLog()->LogDebug("generate:".$fieldname."{".$fieldvalue."}");
            $this->setOutputData("UNIQUE_VALUE", $fieldvalue);

            $mr = zLog()->LogRETURN("UNIQUE_VALUE_FOUND");
        }
        else
        {
            $interval = $interval + 1;
            zLog()->LogDebug("generate:".$fieldname."{".$fieldvalue."}");
            $this->generate($APPDB, $tablename, $fieldname, $fieldvalue, $interval);
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogEndFUNCTION("generate");
    }
}
?>