<?php gdreqonce("/_controls/classes/base/sqlbase.php"); ?>
<?php
/*
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */
class zCountGroup
    extends zSqlBaseObject
{
    function countNumberofGroupsforUniversity($univTableKey)
    {
        $this->gdlog()->LogInfoStartFUNCTION("countNumberofGroupsforUniversity");
        $usrtk = $this->getGDConfig()->getSessAuthUserTblKey();
        $fr;
        $sqlstmnt = "SELECT COUNT(uid) AS numofgroups from ".$univTableKey."group_account;";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Record($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC), "UNIV_GROUP_COUNT");
                $this->gdlog()->LogInfoDB($this->getResult_Record("UNIV_GROUP_COUNT"));
                $fr = $this->gdlog()->LogInfoRETURN("REQUEST_LIST_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("REQUEST_LIST_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("countNumberofGroupsforUniversity");
        return $fr;
    }
}
?>