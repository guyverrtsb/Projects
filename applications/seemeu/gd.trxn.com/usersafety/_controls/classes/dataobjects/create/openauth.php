<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class Createopenauth
    extends UserBase
{
    function __construct()
    {
    }
    
    function basic($openauthkey,
                $expiredt,
                $isvalid)
    {
        zcLog()->LogInfoStartFUNCTION("basic");
        $sqlstmnt = "INSERT INTO openauth SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            openauthkey=:openauthkey,
            expiredt=:expiredt,
            isvalid=:isvalid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":openauthkey", $openauthkey);
        $appcon->bindParam(":expiredt", $expiredt);
        $appcon->bindParam(":isvalid", $isvalid);
        $appcon->execUpdate();
        
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "openauth", $appcon->getLastInsertID()));
                zcLog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_CREATED", "Record is Created:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = zcLog()->LogInfoRETURN("RECORD_IS_NOT_CREATED");
            }
        }
        else
        {
            $fr = zcLog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        zcLog()->LogInfoEndFUNCTION("basic");
        return $fr;
    }
}
?>