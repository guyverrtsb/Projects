<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/_controls/classes/find/university.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 * This Class file is for Registering User Data
 * 1. registerWallMessage - 
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

class zRegisterSearchData
    extends zAppBaseObject
{
    private $so_uid;

    function registerSearchSdesc($content, $object_uid, $cfg_search_objects_sdesc, $university_account_uid = "NOT_PASSED")
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerSearchSdesc");
        $this->registerSearch($content,
                            $object_uid,
                            $this->findCfgUidfromSdesc($cfg_search_objects_sdesc),
                            $university_account_uid);
        $this->gdlog()->LogInfoEndFUNCTION("registerSearchSdesc");
    }
    
    /**
     * 
     */
    function registerSearch($content, $object_uid, $cfg_search_objects_uid, $university_account_uid = "NOT_PASSED")
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerSearch");
        $utk = "";
        
        if($university_account_uid == "NOT_PASSED")
        {
            $university_account_uid = $utk = $this->getGDConfig()->getSessUnivUid();
            $utk = $this->getGDConfig()->getSessUnivTblKey();
        }
        else
        {
            $zfuniv = new zFindUniversity();
            $zfuniv->findAccountandProfileByUID($university_account_uid);
            $utk = $zfuniv->getTablekey();
        }

        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."search_content SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "content=:content, object_uid=:object_uid, ".
            "cfg_search_objects_uid=:cfg_search_objects_uid, university_account_uid=:university_account_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":content", strtoupper($content));
        $dbcontrol->bindParam(":object_uid", $object_uid);
        $dbcontrol->bindParam(":cfg_search_objects_uid", $cfg_search_objects_uid);
        $dbcontrol->bindParam(":university_account_uid", $university_account_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $row = $dbcontrol->getRowfromLastId($dbcontrol, $utk."search_content", $dbcontrol->getLastInsertID());
                $this->so_uid = $row["uid"];
                $fr = $this->saveActivityLog("SEARCH_CONTENT_IS_REGISTERED","Search Content is Registered:".json_encode($row).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("SEARCH_CONTENT_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerSearch");
        return $fr;
    }
    
    
    function registerKeywordsSdesc($keywords, $object_uid, $cfg_search_objects_sdesc, $university_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerKeywordsSdesc");
        $this->registerKeywords($keywords,
                                $object_uid,
                                $this->findCfgUidfromSdesc($cfg_search_objects_sdesc),
                                $university_account_uid);
        $this->gdlog()->LogInfoEndFUNCTION("registerKeywordsSdesc");
    }
    
    /**
     *
     */
    function registerKeywords($keywords, $object_uid, $cfg_search_objects_uid, $university_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerKeywords");
        $zfuniv = new zFindUniversity();
        $zfuniv->findAccountandProfileByUID($university_account_uid);
        $utk = $zfuniv->getTablekey();
        $fr;
        
        $sqlstmnt = "INSERT INTO ".$utk."search_keywords SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "keywords=:keywords, object_uid=:object_uid, ".
            "cfg_search_objects_uid=:cfg_search_objects_uid, ".
            "university_account_uid=:university_account_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":keywords", strtoupper($keywords));
        $dbcontrol->bindParam(":object_uid", $object_uid);
        $dbcontrol->bindParam(":cfg_search_objects_uid", $cfg_search_objects_uid);
        $dbcontrol->bindParam(":university_account_uid", $university_account_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $row = $dbcontrol->getRowfromLastId($dbcontrol, $utk."search_keywords", $dbcontrol->getLastInsertID());
                $this->so_uid = $row["uid"];
                $fr = $this->saveActivityLog("SEARCH_KEYWORD_IS_REGISTERED","Search Keyword is Registered:".json_encode($row).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("SEARCH_KEYWORD_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerKeywords");
        return $fr;
    }
}
?>