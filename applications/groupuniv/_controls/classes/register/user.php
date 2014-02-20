<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */

class zRegisterUser
    extends zAppBaseObject
{
    /**
     * Register User Account.
     * $email = email account;
     * $password = password;
     */
    function registerUserAccount($email, $password, $active = "F")
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerUserAccount");
        $fr;
        $sqlstmnt = "INSERT INTO user_account SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "email=:email, password=:password, active=:active, usertablekey=:usertablekey";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":email", strtolower($email));
        $dbcontrol->bindParam(":password", $password);
        $dbcontrol->bindParam(":active", strtoupper($active));
        $dbcontrol->bindParam(":usertablekey", strtoupper($this->createUserTableKey($email)));
                $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Account($dbcontrol->getRowfromLastId($dbcontrol, "user_account", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Account());
                $fr = $this->saveActivityLog("USER_ACCOUNT_IS_REGISTERED", "Account has been registered:".json_encode($this->getResult_Account()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("USER_ACCOUNT_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerUserAccount");
        return $fr;
    }

    function registerUserAccountActivationSwitch($uid, $active)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerUserAccountActivationSwitch");
        $fr;
        $sqlstmnt = "UPDATE user_account SET active=:active ".
            "WHERE uid=:uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":uid", $uid);
        $dbcontrol->bindParam(":active", strtoupper($active));
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $fr = $this->gdlog()->LogInfoRETURN("USER_ACCOUNT_ACTIVATION_SWITCHED");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("USER_ACCOUNT_ACTIVATION_NOT_SWITCHED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerUserAccountActivationSwitch");
        return $fr;
    }

    /**
     * Register User Profile
     * $fname = First Name
     * $lname = Last Name
     * $city = City
     * $state = State
     * $country = Country
     * $nickname = Nickname
     * $ldesc = User Description
     */
    function registerUserProfile($fname, $lname,
        $city, $region, $country, $nickname, $ldesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerUserProfile");
        $fr;
        
        $sqlstmnt = "INSERT INTO user_profile SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "fname=:fname, lname=:lname, ".
            "city=:city, ".
            "cfg_region_uid=:cfg_region_uid, ".
            "cfg_country_uid=:cfg_country_uid, ".
            "nickname=:nickname, ldesc=:ldesc";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":fname", $fname);
        $dbcontrol->bindParam(":lname", $lname);
        $dbcontrol->bindParam(":city", $city);
        $dbcontrol->bindParam(":cfg_region_uid", $this->findCfgUidfromSdesc($region));
        $dbcontrol->bindParam(":cfg_country_uid", $this->findCfgUidfromSdesc($country));
        $dbcontrol->bindParam(":nickname", $nickname);
        $dbcontrol->bindParam(":ldesc", $ldesc);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Profile($dbcontrol->getRowfromLastId($dbcontrol, "user_profile", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Profile());
                $fr = $this->saveActivityLog("USER_PROFILE_IS_REGISTERED","Profile has been registered:".json_encode($this->getResult_Profile()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("USER_PROFILE_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerUserProfile");
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
    function getEmail() { return $this->Result_Account["email"]; }
    function getPassword() { return $this->Result_Account["password"]; }
    function getActive() { return $this->Result_Account["active"]; }
    function getUserTableKey() { return $this->Result_Account["usertablekey"]; }
    function getUP_Uid() { return $this->Result_Profile["uid"]; }
    function getFName() { return $this->Result_Profile["fname"]; }
    function getLName() { return $this->Result_Profile["lname"]; }
    function getCity() { return $this->Result_Profile["city"]; }
    function getRegionCfgUid() { return $this->Result_Profile["cfg_region_uid"]; }
    function getCountryCfgUid() { return $this->Result_Profile["cfg_country_uid"]; }
    function getNickname() { return $this->Result_Profile["nickname"]; }
    
    function createUserTables($usertablekey = "NOT_DEFINED")
    {
        $this->gdlog()->LogInfoStartFUNCTION("createUserTables");
        $fr;
        if($usertablekey == "NOT_DEFINED")
            $usertablekey = $this->getGDConfig()->getSessAuthUserTblKey();
        
        $sqlstmnt = "SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0; ".
            "SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0; ".
            "SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES'; ".
            
            
            // "-- ----------------------------------------------------- ".
            // "-- Table `user_messages` ".
            // "-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$usertablekey."user_messages` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `cfg_message_type_uid` VARCHAR(36) NOT NULL , ".
            "  `content` TEXT NOT NULL , ".
            "  `to_user_account_uid` VARCHAR(36) NOT NULL , ".
            "  `from_user_account_uid` VARCHAR(36) NOT NULL , ".
            "  `isread` VARCHAR(1) NOT NULL , ".
            "  PRIMARY KEY (`lid`, `uid`) , ".
            "  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , ".
            "  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) ".
            "ENGINE = MyISAM ".
            "AUTO_INCREMENT = 1 ".
            "DEFAULT CHARACTER SET = utf8; ".
            
            
            // "-- ----------------------------------------------------- ".
            // "-- Table `user_notifications` ".
            // "-- ----------------------------------------------------- ".
            "CREATE  TABLE IF NOT EXISTS `".$usertablekey."user_notifications` ( ".
            "  `lid` INT(11) NOT NULL AUTO_INCREMENT , ".
            "  `uid` VARCHAR(36) NOT NULL , ".
            "  `createddt` DATETIME NOT NULL , ".
            "  `changeddt` DATETIME NOT NULL , ".
            "  `cfg_message_type_uid` VARCHAR(36) NOT NULL , ".
            "  `isactive` VARCHAR(1) NOT NULL , ".
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
            $fr = $this->gdlog()->LogInfoRETURN("CREATE_USER_TABLES");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("createUserTables");
        return $fr;
    }
}
?>