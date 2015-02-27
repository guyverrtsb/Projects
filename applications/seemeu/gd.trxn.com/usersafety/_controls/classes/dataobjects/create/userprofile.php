<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateUserProfile
    extends UserBase
{
    function __construct()
    {
    }
    
    function basic($firstname,
                $lastname,
                $city,
                $crossappl_configurations_sdesc_region,
                $crossappl_configurations_sdesc_country)
    {
        zcLog()->LogInfoStartFUNCTION("basic");
        $sqlstmnt = "INSERT INTO userprofile SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            firstname=:firstname,
            lastname=:lastname,
            city=:city,
            crossappl_configurations_sdesc_region=:crossappl_configurations_sdesc_region,
            crossappl_configurations_sdesc_country=:crossappl_configurations_sdesc_country";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":firstname", $firstname);
        $appcon->bindParam(":lastname", $lastname);
        $appcon->bindParam(":city", $city);
        $appcon->bindParam(":crossappl_configurations_sdesc_region", $crossappl_configurations_sdesc_region);
        $appcon->bindParam(":crossappl_configurations_sdesc_country", $pcrossappl_configurations_sdesc_country);
        $appcon->execUpdate();
        
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "userprofile", $appcon->getLastInsertID()));
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