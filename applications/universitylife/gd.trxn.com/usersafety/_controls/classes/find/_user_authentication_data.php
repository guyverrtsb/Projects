<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindUserAuthenticationData
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function findUserAuthenticationData_ByEmail($usersafety_useraccount_email)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUserAuthenticationData_ByEmail");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT ".
        
            $this->dbfas("usersafety_useraccount.uid, ".
                        "usersafety_useraccount.email, ".
                        "usersafety_useraccount.password, ".
                        "usersafety_useraccount.nickname, ".
                        "usersafety_useraccount.usertablekey, ".
                        "usersafety_useraccount.isactive, ".
                        "usersafety_useraccount.changepassword, ".
                        "usersafety_useraccount.numberoflogintries, ".
                        "usersafety_userprofile.uid, ".
                        "usersafety_userprofile.firstname, ".
                        "usersafety_userprofile.lastname, ".
                        "usersafety_userprofile.cfg_country_sdesc, ".
                        "usersafety_userprofile.cfg_region_sdesc, ".
                        "usersafety_userprofile.city, ".
                        "usersafety_role.uid, ".
                        "usersafety_role.sdesc, ".
                        "usersafety_role.ldesc, ".
                        "usersafety_role.priority ")." ".

            "FROM usersafety_useraccount ".
            "JOIN match_usersafety_useraccount_to_userprofile ".
            " ON match_usersafety_useraccount_to_userprofile.usersafety_useraccount_uid = usersafety_useraccount.uid ".
            "JOIN usersafety_userprofile ".
            " ON  usersafety_userprofile.uid = match_usersafety_useraccount_to_userprofile.usersafety_userprofile_uid ".
            "JOIN match_usersafety_useraccount_to_role ".
            " ON match_usersafety_useraccount_to_role.usersafety_useraccount_uid = usersafety_useraccount.uid ".
            "JOIN usersafety_role ".
            " ON usersafety_role.uid = match_usersafety_useraccount_to_role.usersafety_role_uid ".
            "JOIN match_usersafety_useraccount_to_site ".
            " ON match_usersafety_useraccount_to_site.usersafety_useraccount_uid = usersafety_useraccount.uid ".
            "WHERE usersafety_useraccount.email=:usersafety_useraccount_email";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":usersafety_useraccount_email", $usersafety_useraccount_email);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_FOUND", "Record is found:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findUserAuthenticationData_ByEmail");
        return $fr;
    }

    function findUserAuthenticationData_ByUid($usersafety_useraccount_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUserAuthenticationData_ByUid");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT ".
        
            $this->dbfas("usersafety_useraccount.uid, ".
                        "usersafety_useraccount.email, ".
                        "usersafety_useraccount.password, ".
                        "usersafety_useraccount.nickname, ".
                        "usersafety_useraccount.usertablekey, ".
                        "usersafety_useraccount.isactive, ".
                        "usersafety_useraccount.changepassword, ".
                        "usersafety_useraccount.numberoflogintries, ".
                        "usersafety_userprofile.uid, ".
                        "usersafety_userprofile.firstname, ".
                        "usersafety_userprofile.lastname, ".
                        "usersafety_userprofile.cfg_country_sdesc, ".
                        "usersafety_userprofile.cfg_region_sdesc, ".
                        "usersafety_userprofile.city, ".
                        "usersafety_role.uid, ".
                        "usersafety_role.sdesc, ".
                        "usersafety_role.ldesc, ".
                        "usersafety_role.priority ")." ".

            "FROM usersafety_useraccount ".
            "JOIN match_usersafety_useraccount_to_userprofile ".
            " ON match_usersafety_useraccount_to_userprofile.usersafety_useraccount_uid = usersafety_useraccount.uid ".
            "JOIN usersafety_userprofile ".
            " ON  usersafety_userprofile.uid = match_usersafety_useraccount_to_userprofile.usersafety_userprofile_uid ".
            "JOIN match_usersafety_useraccount_to_role ".
            " ON match_usersafety_useraccount_to_role.usersafety_useraccount_uid = usersafety_useraccount.uid ".
            "JOIN usersafety_role ".
            " ON usersafety_role.uid = match_usersafety_useraccount_to_role.usersafety_role_uid ".
            "JOIN match_usersafety_useraccount_to_site ".
            " ON match_usersafety_useraccount_to_site.usersafety_useraccount_uid = usersafety_useraccount.uid ".
            "WHERE usersafety_useraccount.uid=:usersafety_useraccount_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":usersafety_useraccount_uid", $usersafety_useraccount_uid);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_FOUND", "Record is found:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findUserAuthenticationData_ByUid");
        return $fr;
    }
    
    function getUAUid() { return $this->getResult_RecordField($this->dbf("usersafety_useraccount.uid")); }
    function getEmail() { return $this->getResult_RecordField($this->dbf("usersafety_useraccount.email")); }
    function getPassword() { return $this->getResult_RecordField($this->dbf("usersafety_useraccount.password")); }
    function getNickname() { return $this->getResult_RecordField($this->dbf("usersafety_useraccount.nickname")); }
    function getUsertablekey() { return $this->getResult_RecordField($this->dbf("usersafety_useraccount.usertablekey")); }
    function getIsactive() { return $this->getResult_RecordField($this->dbf("usersafety_useraccount.isactive")); }
    function getChangepassword() { return $this->getResult_RecordField($this->dbf("usersafety_useraccount.changepassword")); }
    function getNumberoflogintries() { return $this->getResult_RecordField($this->dbf("usersafety_useraccount.numberoflogintries")); }
    
    function getUPUid() { return $this->getResult_RecordField($this->dbf("usersafety_userprofile.uid")); }
    function getFirstname() { return $this->getResult_RecordField($this->dbf("usersafety_userprofile.firstname")); }
    function getLastname() { return $this->getResult_RecordField($this->dbf("usersafety_userprofile.lastname")); }
    function getCfgCountryUid() { return $this->getResult_RecordField($this->dbf("usersafety_userprofile.cfg_country_sdesc")); }
    function getCfgRegionUid() { return $this->getResult_RecordField($this->dbf("usersafety_userprofile.cfg_region_sdesc")); }
    function getCity() { return $this->getResult_RecordField($this->dbf("usersafety_userprofile.city")); }
        
    function getURUid() { return $this->getResult_RecordField($this->dbf("usersafety_role.uid")); }
    function getSdesc() { return $this->getResult_RecordField($this->dbf("usersafety_role.sdesc")); }
    function getLdesc() { return $this->getResult_RecordField($this->dbf("usersafety_role.ldesc")); }
    function getPrority() { return $this->getResult_RecordField($this->dbf("usersafety_role.priority")); }
}
?>