<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 * This Class file is for Registering User Data
 */

class zRegisterUniversity
    extends zAppBaseObject
{

    function __construct()
    {

    }
    
    /**
     * Register University Account.
     * $university_account_emailkey = email key;
     * $university_account_sdesc = sdesc;
     */
    function registerUniversityAccount($university_account_emailkey, $university_account_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerUniversityAccount");
        $fr;
        $sqlstmnt = "INSERT INTO university_account SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "emailkey=:emailkey, sdesc=:sdesc";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":emailkey", strtolower($university_account_emailkey));
        $dbcontrol->bindParam(":sdesc", strtoupper($university_account_sdesc));
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Account($dbcontrol->getRowfromLastId($dbcontrol, "university_account", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Account());
                $fr = $this->saveActivityLog("UNIVERISTY_ACCOUNT_IS_REGISTERED","Account has been registered:".json_encode($this->getResult_Account()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("UNIVERISTY_ACCOUNT_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerUniversityAccount");
        return $fr;
    }

    /**
     * Register University Profile
     * $city = City
     * $state = State
     * $country = Country
     * $foundeddate = Date Founded
     * $content = Content
     * $name = Name of University
     */
    function registerUnversityProfile($city, $region, $country,
        $foundeddate, $content, $name)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerUnversityProfile");
        $fr;
        $sqlstmnt = "INSERT INTO university_profile SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "city=:city, ".
            "cfg_region_uid=:cfg_region_uid, ".
            "cfg_country_uid=:cfg_country_uid, ".
            "foundeddate=:foundeddate, ".
            "content=:content, ".
            "name=:name";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":city", $city);
        $dbcontrol->bindParam(":cfg_region_uid", $this->findCfgUidfromSdesc($region));
        $dbcontrol->bindParam(":cfg_country_uid", $this->findCfgUidfromSdesc($country));
        $dbcontrol->bindParam(":foundeddate", $foundeddate);
        $dbcontrol->bindParam(":content", $content);
        $dbcontrol->bindParam(":name", $name);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Profile($dbcontrol->getRowfromLastId($dbcontrol, "university_profile", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Profile());
                $fr = $this->saveActivityLog("UNIVERSITY_PROFILE_IS_REGISTERED","Profile has been registered:".json_encode($this->getResult_Profile()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("UNIVERSITY_PROFILE_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerUnversityProfile");
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
    
    function getUA_Uid() { return $this->Result_Account["uid"]; }
    function getSdesc() { return $this->Result_Account["sdesc"]; }
    function getEmailkey() { return $this->Result_Account["emailkey"]; }
    function getUP_Uid() { return $this->Result_Profile["uid"]; }
    function getCity() { return $this->Result_Profile["city"]; }
    function getRegionCfgUid() { return $this->Result_Profile["cfg_region_uid"]; }
    function getCountryCfgUid() { return $this->Result_Profile["cfg_country_uid"]; }
    function getFoundeddate() { return $this->Result_Profile["foundeddate"]; }
    function getContent() { return $this->Result_Profile["content"]; }
    function getName() { return $this->Result_Profile["name"]; }
    function getTablekey() {
        $emailkey = $this->getEmailkey();
        $univtablekey = explode(".", $this->getEmailkey());
        $univtablekey = strtolower($univtablekey[0]);
        return "z_".$univtablekey."_";
    }
    
    function createUniversityTables($univtblekey = "NOT_DEFINED")
    {
        $this->gdlog()->LogInfoStartFUNCTION("createUniversityTables");
        $fr;
        if($univtblekey == "NOT_DEFINED")
            $univtblekey = $this->getGDConfig()->getSessUnivTblKey();
        $sqlstmnt = "SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0; ".
            "SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0; ".
            "SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES'; ".
            
            
            //"-- ----------------------------------------------------- ".
            //"-- Table `group_account` ".
            //"-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$univtblekey."group_account` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `cfg_group_type_uid` VARCHAR(36) NOT NULL , ".
            "  `cfg_group_visibility_uid` VARCHAR(36) NOT NULL , ".
            "  `cfg_group_useracceptance_uid` VARCHAR(36) NOT NULL , ".
            "  `ldesc` VARCHAR(250) NOT NULL , ".
            "  `sdesc` VARCHAR(100) NOT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".
            
            
            //"-- ----------------------------------------------------- ".
            //"-- Table `group_profile` ".
            //"-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$univtblekey."group_profile` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `validtodate` DATE NOT NULL , ".
            "  `content` TEXT NOT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".


           //"-- ----------------------------------------------------- ".
            //"-- Table `group_membership_request` ".
            //"-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$univtblekey."group_membership_request` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `who_sent_user_account_uid` VARCHAR(36) NOT NULL , ".
            "  `who_approves_user_account_uid` VARCHAR(36) NOT NULL , ".
            "  `who_receives_user_account_uid` VARCHAR(36) NOT NULL , ".
            "  `status` VARCHAR(1) NOT NULL DEFAULT 'P' , ".
            "  `group_account_uid` VARCHAR(36) NOT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`, `group_account_uid`, `who_approves_user_account_uid`, `who_receives_user_account_uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".

            
            //"-- ----------------------------------------------------- ".
            //"-- Table `match_group_account_to_group_profile` ".
            //"-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$univtblekey."match_group_account_to_group_profile` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `group_account_uid` VARCHAR(36) NOT NULL , ".
            "  `group_profile_uid` VARCHAR(36) NOT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".
            

            //"-- ----------------------------------------------------- ".
            //"-- Table `match_university_account_to_group_account` ".
            //"-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$univtblekey."match_university_account_to_group_account` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `university_account_uid` VARCHAR(36) NOT NULL , ".
            "  `group_account_uid` VARCHAR(36) NOT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".


            //"-- ----------------------------------------------------- ".
            //"-- Table `match_user_account_to_group_account_to_cfg_user_roles` ".
            //"-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$univtblekey."match_user_account_to_group_account_to_cfg_user_roles` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `user_account_uid` VARCHAR(36) NOT NULL , ".
            "  `group_account_uid` VARCHAR(36) NOT NULL , ".
            "  `cfg_user_roles_uid` VARCHAR(36) NOT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".
            
            
            //"-- ----------------------------------------------------- ".
            //"-- Table `message_status` ".
            //"-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$univtblekey."message_status` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `message_uid` VARCHAR(36) NOT NULL , ".
            "  `isread` VARCHAR(1) NOT NULL , ".
            "  `okcount` INT(11) NOT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".
            
            
            //"-- ----------------------------------------------------- ".
            //"-- Table `search_content` ".
            //"-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$univtblekey."search_content` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `cfg_search_objects_uid` VARCHAR(36) NOT NULL , ".
            "  `content` TEXT NOT NULL , ".
            "  `object_uid` VARCHAR(36) NOT NULL , ".
            "  `university_account_uid` VARCHAR(36) NOT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`, `cfg_search_objects_uid`, `object_uid`, `university_account_uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) , ".
            "  FULLTEXT INDEX `search_content` (`content` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".
            
            
            //"-- ----------------------------------------------------- ".
            //"-- Table `search_keywords` ".
            //"-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$univtblekey."search_keywords` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `cfg_search_objects_uid` VARCHAR(36) NOT NULL , ".
            "  `keywords` TEXT NOT NULL , ".
            "  `object_uid` VARCHAR(36) NOT NULL , ".
            "  `university_account_uid` VARCHAR(36) NOT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`, `cfg_search_objects_uid`, `object_uid`, `university_account_uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) , ".
            "  FULLTEXT INDEX `keywords` (`keywords` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".
            
            
            //"-- ----------------------------------------------------- ".
            //"-- Table `wall_message` ".
            //"-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$univtblekey."wall_message` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `user_account_uid` VARCHAR(36) NOT NULL , ".
            "  `group_account_uid` VARCHAR(36) NOT NULL , ".
            "  `content` TEXT NOT NULL , ".
            "  `mimes_uid` VARCHAR(36) NULL DEFAULT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".
            
            
            //"-- ----------------------------------------------------- ".
            //"-- Table `wall_message_comment` ".
            //"-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$univtblekey."wall_message_comment` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `user_account_uid` VARCHAR(36) NOT NULL , ".
            "  `group_account_uid` VARCHAR(36) NOT NULL , ".
            "  `wall_message_uid` VARCHAR(36) NOT NULL , ".
            "  `content` TEXT NOT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".
            
            
            "SET SQL_MODE=@OLD_SQL_MODE; ".
            "SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS; ".
            "SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS; ";
            
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            $fr = $this->gdlog()->LogInfoRETURN("CREATE_UNIVERSITY_TABLES");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("createUniversityTables");
        return $fr;
    }
}
?>