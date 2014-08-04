<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/usersafety_role.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. Is Email in Use
 * 2. Create User Account with account inactive
 * 3, Create Profile
 * 4. Match User Account to Profile
 * 5. Match User to Site 
 * 6. Match User to Role
 * 7. Register Activation Record
 * 8. Send Activation Email
*/
class gdUserRoles
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function findUserRolesList()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUserRolesList");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfud = new gdFindUsersafetyRole();
        $fr = $gdfud->findUsersafetyRoles();
        if($fr == "RECORDS_ARE_FOUND")
        {
            $this->setResult_Records($gdfud->getResult_Records());
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findUserRolesList");
        return $fr;
    }
}
?>