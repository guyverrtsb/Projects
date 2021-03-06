<?php gdreqonce("/_controls/classes/base/sqlbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */

class zRegisterUser
    extends zSqlBaseObject
{
    /**
     * Register User Account.
     * $email = email account;
     * $password = password;
     */
    function registerUserAccount($email, $password, $nickname, $active = "F")
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerUserAccount");
        $fr;
        $sqlstmnt = "INSERT INTO user_account SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "email=:email, ".
            "password=:password, ".
            "nickname=:nickname,".
            "active=:active, ".
            "usertablekey=UUID()";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":email", strtolower($email));
        $dbcontrol->bindParam(":password", $password); 
        $dbcontrol->bindParam(":nickname", trim($nickname));
        $dbcontrol->bindParam(":active", strtoupper($active));
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
     * $ldesc = User Description
     */
    function registerUserProfile($fname, $lname,
        $city, $cfg_region_sdesc, $cfg_country_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerUserProfile");
        $fr;
        
        $sqlstmnt = "INSERT INTO user_profile SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "fname=:fname, ".
            "lname=:lname, ".
            "city=:city, ".
            "cfg_country_sdesc=:cfg_country_sdesc, ".
            "cfg_region_sdesc=:cfg_region_sdesc";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":fname", $fname);
        $dbcontrol->bindParam(":lname", $lname);
        $dbcontrol->bindParam(":cfg_country_sdesc", $cfg_country_sdesc);
        $dbcontrol->bindParam(":cfg_region_sdesc", $cfg_region_sdesc);
        $dbcontrol->bindParam(":city", $city);
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
    function getNickname() { return $this->Result_Account["nickname"]; }
    function getUserTableKey() { return $this->Result_Account["usertablekey"]; }
    function getUP_Uid() { return $this->Result_Profile["uid"]; }
    function getFName() { return $this->Result_Profile["fname"]; }
    function getLName() { return $this->Result_Profile["lname"]; }
    function getCity() { return $this->Result_Profile["city"]; }
    function getRegionCfgUid() { return $this->findCfgUidfromSdesc($this->Result_Profile["cfg_region_sdesc"]); }
    function getCountryCfgUid() { return $this->findCfgUidfromSdesc($this->Result_Profile["cfg_country_sdesc"]); }
    function getRegionCfgSdesc() { return $this->Result_Profile["cfg_region_sdesc"]; }
    function getCountryCfgSdesc() { return $this->Result_Profile["cfg_country_sdesc"]; }
    
    
    function createUserTables($usertablekey = "NOT_DEFINED")
    {
        $this->gdlog()->LogInfoStartFUNCTION("createUserTables");
        $fr;
        if($usertablekey == "NOT_DEFINED")
            $usertablekey = $this->getGDConfig()->getSessAuthUserTblKey();
        
        $sqlstmnt = "SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0; ".
            "SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0; ".
            "SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES'; ".
            
            
            
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