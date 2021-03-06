<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/userdata.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveUserData
    extends UserDataBase
{
    function __construct()
    {
    }
    
    /**
     * By UserAccount Email
     */
    function byUseraccountemail($useraccount_email)
    {
        zLog()->LogStart_DataObjectFunction("byUseraccountemail");
        
        $sqlstmnt = "SELECT ".
            $this->dbfas("useraccount.uid,".
                        "useraccount.email,".
                        "useraccount.nickname,".
                        "useraccount.usertablekey,".
                        "useraccount.isactive,".
                        "useraccount.changepassword,".
                        "useraccount.numberoflogintries,".
                        "userprofile.uid,".
                        "userprofile.firstname,".
                        "userprofile.lastname,".
                        "userprofile.crossappl_configurations_sdesc_region,".
                        "userprofile.crossappl_configurations_sdesc_country,".
                        "userprofile.city").
        "from useraccount ".
        "join match_useraccount_to_userprofile ".
        "on useraccount.uid = match_useraccount_to_userprofile.useraccount_uid ".
        "join userprofile ".
        "on match_useraccount_to_userprofile.userprofile_uid = userprofile.uid ".
            
        "WHERE useraccount.email=:useraccount_email";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_email", $useraccount_email);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("byUseraccountemail");
    }
    
    /**
     * By UserAccount Uid
     */
    function byUseraccountuid($useraccount_uid)
    {
        zLog()->LogStart_DataObjectFunction("byUseraccountuid");
        
        $sqlstmnt = "SELECT ".
            $this->dbfas("useraccount.uid,".
                        "useraccount.email,".
                        "useraccount.nickname,".
                        "useraccount.usertablekey,".
                        "useraccount.isactive,".
                        "useraccount.changepassword,".
                        "useraccount.numberoflogintries,".
                        "userprofile.uid,".
                        "userprofile.firstname,".
                        "userprofile.lastname,".
                        "userprofile.crossappl_configurations_sdesc_region,".
                        "userprofile.crossappl_configurations_sdesc_country,".
                        "userprofile.city").
        "from useraccount ".
        "join match_useraccount_to_userprofile ".
        "on useraccount.uid = match_useraccount_to_userprofile.useraccount_uid ".
        "join userprofile ".
        "on match_useraccount_to_userprofile.userprofile_uid = userprofile.uid ".
            
        "WHERE useraccount.uid=:useraccount_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_uid", $useraccount_uid);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("byUseraccountuid");
    }
}
?>