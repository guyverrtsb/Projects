<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/useraccount.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveUserAccount
    extends UseraccountBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Email
     */
    function byEmail($useraccount_email)
    {
        zLog()->LogStart_DataObjectFunction("byEmail");
        
        $sqlstmnt = "SELECT 
                lid,
                uid,
                createddt,
                changeddt,
                email,
                password,
                nickname,
                usertablekey,
                isactive,
                changepassword,
                numberoflogintries
            FROM useraccount 
            WHERE email=:useraccount_email";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_email", $useraccount_email);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byEmail");
    }
    
    /**
     * Retrieve Record by Nickname
     */
    function byNickname($useraccount_nickname)
    {
        zLog()->LogStart_DataObjectFunction("byNickname");
        
        $sqlstmnt = "SELECT 
                lid,
                uid,
                createddt,
                changeddt,
                email,
                password,
                nickname,
                usertablekey,
                isactive,
                changepassword,
                numberoflogintries
            FROM useraccount 
            WHERE nickname=:useraccount_nickname";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_nickname", $useraccount_nickname);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byNickname");
    }
    
    /**
     * Retrieve Record by Tablekey
     */
    function byUsertablekey($useraccount_usertablekey)
    {
        zLog()->LogStart_DataObjectFunction("byUsertablekey");
        
        $sqlstmnt = "SELECT 
                lid,
                uid,
                createddt,
                changeddt,
                email,
                password,
                nickname,
                usertablekey,
                isactive,
                changepassword,
                numberoflogintries
            FROM useraccount 
            WHERE usertablekey=:useraccount_usertablekey";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_usertablekey", $this->createUserTableKey($useraccount_usertablekey));
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byUsertablekey");
    }
    
    /**
     * Retrieve Record by Uid
     */
    function byUid($useraccount_uid)
    {
        zLog()->LogStart_DataObjectFunction("byUid");
        
        $sqlstmnt = "SELECT 
                lid,
                uid,
                createddt,
                changeddt,
                email,
                password,
                nickname,
                usertablekey,
                isactive,
                changepassword,
                numberoflogintries
            FROM useraccount 
            WHERE uid=:useraccount_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_uid", $useraccount_uid);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byUid");
    }
}
?>