<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 * This Class file is for Registering User Data
 * 1. registerUserAccount - 
 * -- Register the User Account.
 * 2. registerUserProfile - 
 * -- Use this Method to Register the User Profile
 * 3. getUserAccountUID
 * 4. getUserAccountEMAIL
 * 5. getUserProfileUID
 * 6. getUserProfileFNAME
 * 7. getUserAccountLNAME
 * 8. getUserProfileCITY
 * 9. getUserAccountSTATE
 * 10. getUserProfileCOUNTRY
 * 11. getUserAccountNICKNAME
 */

class zRegisterGroup
    extends zAppBaseObject
{

    function registerGroupAccountUid($group_account_ldesc,
                                $cfg_group_type_uid, 
                                $cfg_group_visibility_uid, 
                                $cfg_group_useracceptance_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerGroupAccountUid");
        $fr;

        $fr = $this->registerGroupAccountSdesc($group_account_ldesc,
                                        $this->findCfgSdescfromUid($cfg_group_type_uid),
                                        $this->findCfgSdescfromUid($cfg_group_visibility_uid),
                                        $this->findCfgSdescfromUid($cfg_group_useracceptance_uid));

        $this->gdlog()->LogInfoEndFUNCTION("registerGroupAccountUid");
        return $fr;
    }    
    /**
     * Register Group Account.
     * $group_account_ldesc = ldesc;
     * $group_account_geolocation = geolocation;
     */
    function registerGroupAccountSdesc($group_account_ldesc,
                                    $group_type_sdesc,
                                    $group_visibility_sdesc,
                                    $group_useracceptance_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerGroupAccount");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."group_account SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "ldesc=:ldesc, sdesc=:sdesc, ".
            "cfg_group_type_sdesc=:cfg_group_type_sdesc, ".
            "cfg_group_visibility_sdesc=:cfg_group_visibility_sdesc, ".
            "cfg_group_useracceptance_sdesc=:cfg_group_useracceptance_sdesc";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":ldesc", $group_account_ldesc);
        $dbcontrol->bindParam(":sdesc", $this->createSdesc($group_account_ldesc));
        $dbcontrol->bindParam(":cfg_group_type_sdesc", $group_type_sdesc);
        $dbcontrol->bindParam(":cfg_group_visibility_sdesc", $group_visibility_sdesc);
        $dbcontrol->bindParam(":cfg_group_useracceptance_sdesc", $group_useracceptance_sdesc);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Account($dbcontrol->getRowfromLastId($dbcontrol, $utk."group_account", $dbcontrol->getLastInsertID()));
                
                $this->GroupTypeSdesc = $this->findCfgSdescfromUid($this->getTypeCfgUid());
                $this->GroupVisibilitySdesc = $this->findCfgSdescfromUid($this->getVisibilityCfgUid());
                $this->GroupUserAcceptanceSdesc = $this->findCfgSdescfromUid($this->getUserAcceptanceCfgUid());

                $this->gdlog()->LogInfoDB($this->getResult_Account());
                $fr = $this->saveActivityLog("GROUP_ACCOUNT_IS_REGISTERED","Group has been registered:".json_encode($this->getResult_Account()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("GROUP_ACCOUNT_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerGroupAccount");
        return $fr;
    }

    /**
     * Register Group Profile
     * $validtodate = validtodate
     * $content = content
     */
    function registerGroupProfile($validtodate, $content)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerGroupProfile");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."group_profile SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "validtodate=:validtodate, content=:content";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":validtodate", $validtodate);
        $dbcontrol->bindParam(":content", $content);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Profile($dbcontrol->getRowfromLastId($dbcontrol, $utk."group_profile", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Profile());
                $fr = $this->saveActivityLog("GROUP_PROFILE_IS_REGISTERED","Profile has been registered:".json_encode($this->getResult_Profile()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("GROUP_PROFILE_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerGroupProfile");
        return $fr;
    }
    
    private $Result_Account = "NO_RECORD";
    private $Result_Profile = "NO_RECORD";
    
    function setResult_Account($row)
    {
        $this->Result_Account = $row;
    }
    
    function getResult_Account()
    {
        return $this->Result_Account;
    }
    
    function setResult_Profile($row)
    {
        $this->Result_Profile = $row;
    }
    
    function getResult_Profile()
    {
        return $this->Result_Profile;
    }
    
    function getGA_Uid() { return $this->Result_Account["uid"]; }
    function getTypeCfgSdesc() { return $this->Result_Account["cfg_group_type_sdesc"]; }
    function getVisibilityCfgSdesc() { return $this->Result_Account["cfg_group_visibility_sdesc"]; }
    function getUserAcceptanceCfgSdesc() { return $this->Result_Account["cfg_group_useracceptance_sdesc"]; }
    function getTypeCfgUid() { return $this->findCfgUidFromSdesc($this->Result_Account["cfg_group_type_sdesc"]); }
    function getVisibilityCfgUid() { return $this->findCfgUidFromSdesc($this->Result_Account["cfg_group_visibility_sdesc"]); }
    function getUserAcceptanceCfgUid() { return $this->findCfgUidFromSdesc($this->Result_Account["cfg_group_useracceptance_sdesc"]); }
    function getLdesc() { return $this->Result_Account["ldesc"]; }
    function getSdesc() { return $this->Result_Account["sdesc"]; }
    function getGP_Uid() { return $this->Result_Profile["uid"]; }
    function getValidtodate() { return $this->Result_Profile["validtodate"]; }
    function getContent() { return $this->Result_Profile["content"]; }
    function getCountryCfgUid() { return $this->Result_Profile["country_cfg_defaults_uid"]; }
    function getNickname() { return $this->Result_Profile["nickname"]; }
}
?>