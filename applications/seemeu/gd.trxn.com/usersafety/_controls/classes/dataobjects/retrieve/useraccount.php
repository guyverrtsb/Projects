<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveUserAccount
    extends UserBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Email
     */
    function byEmail($email)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("byEmail");
        
        $sqlstmnt = "SELECT * FROM useraccount ".
            "WHERE email=:email";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":email", $email);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEndDATAOBJECTFUNCTION("byEmail");
    }
    
    /**
     * Retrieve Record by Nickname
     */
    function byNickname($nickname)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("byNickname");
        
        $sqlstmnt = "SELECT * FROM useraccount ".
            "WHERE nickname=:nickname";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":nickname", $nickname);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEndDATAOBJECTFUNCTION("byNickname");
    }
    
    /**
     * Retrieve Record by Tablekey
     */
    function byUsertablekey($usertablekey)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("byTablekey");
        
        $sqlstmnt = "SELECT * FROM useraccount ".
            "WHERE usertablekey=:usertablekey";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":usertablekey", $this->createUserTableKey($usertablekey));
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEndDATAOBJECTFUNCTION("byTablekey");
    }
}
?>