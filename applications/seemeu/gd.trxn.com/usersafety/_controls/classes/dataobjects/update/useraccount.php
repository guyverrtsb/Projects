<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UpdateUserAccount
    extends UserBase
{
    function __construct()
    {
    }
    
    function basic($uid,
                $email,
                $password,
                $nickname,
                $isactive,
                $changepassword,
                $numberoflogintries)
    {
        zLog()->LogStart_DataObjectFunction("basic");
        
        $sqlstmnt = "UPDATE useraccount SET ".
            "changeddt=NOW(), ".
            "email=:email, ".
            "password=:password, ".
            "nickname=:nickname, ".
            "isactive=:isactive, ".
            "changepassword=:changepassword, ".
            "numberoflogintries=:numberoflogintries ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":email", $email);
        $appcon->bindParam(":password", $password);
        $appcon->bindParam(":nickname", $nickname);
        $appcon->bindParam(":isactive", $isactive);
        $appcon->bindParam(":changepassword", $changepassword);
        $appcon->bindParam(":numberoflogintries", $numberoflogintries);
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "useraccount");
        
        zLog()->LogEnd_DataObjectFunction("basic");
    }
    
    function updateLogintries($uid,
                            $numberoflogintries)
    {
        zLog()->LogStart_DataObjectFunction("updateLogintries");
        
        $sqlstmnt = "UPDATE useraccount SET ".
            "changeddt=NOW(), ".
            "numberoflogintries=:numberoflogintries ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":numberoflogintries", $numberoflogintries);
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "useraccount");
        
        zLog()->LogEnd_DataObjectFunction("updateLogintries");
    }
    
    function updateIsactive($uid,
                            $isactive)
    {
        zLog()->LogStart_DataObjectFunction("updateIsactive");
        
        $sqlstmnt = "UPDATE useraccount SET ".
            "changeddt=NOW(), ".
            "isactive=:isactive ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":isactive", $isactive);
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "useraccount");
        
        zLog()->LogEnd_DataObjectFunction("updateIsactive");
    }
    
    function updateActivatebyUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("updateActivatebyUid");
        
        $sqlstmnt = "UPDATE useraccount SET ".
            "changeddt=NOW(), ".
            "isactive=:isactive ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":isactive", "T");
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "useraccount");
        
        zLog()->LogEnd_DataObjectFunction("updateActivatebyUid");
    }
    
    function updateDeactivatebyUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("updateDeactivatebyUid");
        
        $sqlstmnt = "UPDATE useraccount SET ".
            "changeddt=NOW(), ".
            "isactive=:isactive ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":isactive", "F");
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "useraccount");
        
        zLog()->LogEnd_DataObjectFunction("updateDeactivatebyUid");
    }
}
?>