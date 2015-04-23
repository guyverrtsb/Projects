<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateUserAccount
    extends UserBase
{
    function __construct()
    {
    }
    
    function basic($email,
                $nickname,
                $password)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("basic");
        
        $sqlstmnt = "INSERT INTO useraccount SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            email=:email,
            password=:password,
            nickname=:nickname,
            usertablekey=:usertablekey,
            isactive=:isactive,
            changepassword=:changepassword,
            numberoflogintries=:numberoflogintries";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":email", $email);
        $appcon->bindParam(":nickname", $nickname);
        $appcon->bindParam(":password", $password);
        $appcon->bindParam(":usertablekey", $nickname);
        $appcon->bindParam(":isactive", "F");
        $appcon->bindParam(":changepassword", "F");
        $appcon->bindParam(":numberoflogintries", 0);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "useraccount");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("basic");
    }
}
?>