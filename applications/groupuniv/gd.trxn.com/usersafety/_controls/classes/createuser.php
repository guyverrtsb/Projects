<?php gdreqonce("/gd.trxn.com/_controls/classes/base/database.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. Is Email in Use
 * 2. Create User Account with account inactive
 * 3, Create Profile
 * 4. Match User Account to Profile
 * 5. Match User to Site 
 * 6. Match User to Role
 * 7. Register Activation Record
 * 8. Send Activation Email
*/
class Z_Create_NewUser_References
    extends Z_GD_Database
{
    private $ua_uid, $ua_email, $up_uid, $up_fname, $up_lname, $up_nickname;
    function __construct($email)
    {
        $this->ua_email = $email;
    }
    
    function doesEmailExist()
    {
        $sqlstmnt = "SELECT * FROM usersafety_useraccounts ".
        "WHERE email=:email";
        
        $dbcontrol = new Z_GDDBConnection();
        $dbcontrol->setCrossAppConn();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":email", $this->ua_email);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->gdlog()->LogInfo("doesEmailExist():EMAIL_IN_USE");
                return "EMAIL_IN_USE";
            }
            else
            {
                $this->gdlog()->LogInfo("doesEmailExist():EMAIL_NOT_IN_USE");
                return "EMAIL_NOT_IN_USE";
            }
        }
        else
        {
            $this->gdlog()->LogInfo("doesEmailExist():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }

    function registerUserAccount($password)
    {
        $sqlstmnt = "INSERT INTO usersafety_useraccounts SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "email=:email, password=:password, active=:active, ".
            "changepassword=:changepassword, numberoflogintries=:numberoflogintries";
        
        $dbcontrol = new Z_GDDBConnection();
        $dbcontrol->setCrossAppConn();
        $dbcontrol->setStatement($sqlstmnt);
        $this->gdlog()->LogInfo("registerUserAccount():BIND:".$this->ua_email);
        $dbcontrol->bindParam(":email", $this->ua_email);
        $dbcontrol->bindParam(":password", $password);
        $dbcontrol->bindParam(":active", "F");
        $dbcontrol->bindParam(":changepassword", "F");
        $dbcontrol->bindParam(":numberoflogintries", 0);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $dbcontrol->saveActivityLog("REGISTER_USER_ACCOUNT","User has been registered".
                    ":Last Id:".$lid.":".$this->ua_email.":");

                $row = $dbcontrol->getRowfromLastId($dbcontrol, "usersafety_useraccounts", $lid);
                $this->ua_uid = $row["uid"];
                $this->gdlog()->LogInfo("registerUserAccount():ACCOUNT_CREATED");
                return "ACCOUNT_CREATED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerUserAccount():ACCOUNT_NOT_CREATED");
                return "ACCOUNT_NOT_CREATED";
            }
        }
        else
        {
            $this->gdlog()->LogInfo("registerUserAccount():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }

    function registerUserProfile($firstname, $lastname,
        $city, $region, $country, $nickname)
    {
        $sqlstmnt = "INSERT INTO usersafety_userprofiles SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "firstname=:firstname, lastname=:lastname, ".
            "city=:city, region=:region, country=:country, ".
            "nickname=:nickname";
        
        $dbcontrol = new Z_GDDBConnection();
        $dbcontrol->setCrossAppConn();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":firstname", $firstname);
        $dbcontrol->bindParam(":lastname", $lastname);
        $dbcontrol->bindParam(":city", $city);
        $dbcontrol->bindParam(":region", $region);
        $dbcontrol->bindParam(":country", $country);
        $dbcontrol->bindParam(":nickname", $nickname);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $dbcontrol->saveActivityLog("REGISTER_USER_PROFILE","Profile has been registered".
                    ":Last Id:".$lid.":".
                    $firstname.":".
                    $lastname.":".
                    $city.":".
                    $region.":".
                    $country.":".
                    $nickname.":");

                $row = $dbcontrol->getRowfromLastId($dbcontrol, "usersafety_userprofiles", $lid);
                $this->up_uid = $row["uid"];
                $this->up_fname = $row["firstname"];
                $this->up_lname = $row["lastname"];
                $this->up_nickname = $row["nickname"];
                $this->gdlog()->LogInfo("registerUserProfile():PROFILE_CREATED");
                return "PROFILE_CREATED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerUserProfile():PROFILE_NOT_CREATED");
                return "PROFILE_NOT_CREATED";
            }
        }
        else
        {
            $this->gdlog()->LogInfo("registerUserProfile():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }

    function matchUserAccounttoProfile()
    {
        $sqlstmnt = "INSERT INTO match_usersafety_useraccounts_to_userprofiles SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "usersafety_user_accounts_uid=:usersafety_user_accounts_uid, ".
            "usersafety_user_accounts_sdesc=:usersafety_user_accounts_sdesc, ".
            "usersafety_user_profiles_uid=:usersafety_user_profiles_uid, ".
            "usersafety_user_profiles_sdesc=:usersafety_user_profiles_sdesc";
        
        $dbcontrol = new Z_GDDBConnection();
        $dbcontrol->setCrossAppConn();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":usersafety_user_accounts_uid", $this->ua_uid);
        $dbcontrol->bindParam(":usersafety_user_accounts_sdesc", $this->ua_email);
        $dbcontrol->bindParam(":usersafety_user_profiles_uid", $this->up_uid);
        $dbcontrol->bindParam(":usersafety_user_profiles_sdesc", $this->up_fname." ".$this->up_lname);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $dbcontrol->saveActivityLog("REGISTER_MATCH_USER_TO_PROFILE","User and Profile has been matched".
                    ":Last Id:".$lid.":".
                    $this->ua_uid.":".
                    $this->ua_email.":".
                    $this->up_uid.":".
                    $this->up_fname.":".
                    $this->up_lname.":");

                $this->gdlog()->LogInfo("matchUserAccounttoProfile():ACCOUNT_PROFILE_MATCHED");
                return "ACCOUNT_PROFILE_MATCHED";
            }
            else
            {
                $this->gdlog()->LogInfo("matchUserAccounttoProfile():ACCOUNT_PROFILE_NOT_MATCHED");
                return "ACCOUNT_PROFILE_NOT_MATCHED";
            }
        }
        else
        {
            $this->gdlog()->LogInfo("matchUserAccounttoProfile():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }

    function matchUserAccounttoSite()
    {
        $sqlstmnt = "INSERT INTO match_usersafety_useraccounts_to_sites SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "usersafety_user_accounts_uid=:usersafety_user_accounts_uid, ".
            "usersafety_user_accounts_sdesc=:usersafety_user_accounts_sdesc, ".
            "usersafety_user_sites_uid=:usersafety_user_sites_uid, ".
            "usersafety_user_sites_sdesc=:usersafety_user_sites_sdesc";
        
        $dbcontrol = new Z_GDDBConnection();
        $dbcontrol->setCrossAppConn();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":usersafety_user_accounts_uid", $this->ua_uid);
        $dbcontrol->bindParam(":usersafety_user_accounts_sdesc", $this->ua_email);
        $dbcontrol->bindParam(":usersafety_user_sites_uid", $_SESSION['GUYVERDESIGNS_SITE_UID']);
        $dbcontrol->bindParam(":usersafety_user_sites_sdesc", $_SESSION['GUYVERDESIGNS_SITE']);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $dbcontrol->saveActivityLog("REGISTER_MATCH_USER_TO_SITE","User and Site has been matched".
                    ":Last Id:".$lid.":".
                    $this->ua_uid.":".
                    $this->ua_email.":".
                    $_SESSION['GUYVERDESIGNS_SITE_UID'].":".
                    $_SESSION['GUYVERDESIGNS_SITE'].":");

                $this->gdlog()->LogInfo("matchUserAccounttoSite():ACCOUNT_SITE_MATCHED");
                return "ACCOUNT_SITE_MATCHED";
            }
            else
            {
                $this->gdlog()->LogInfo("matchUserAccounttoSite():ACCOUNT_SITE_NOT_MATCHED");
                return "ACCOUNT_SITE_NOT_MATCHED";
            }
        }
        else
        {
            $this->gdlog()->LogInfo("matchUserAccounttoSite():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }

    function registerTempLink()
    {
        $sqlstmnt = "INSERT INTO usersafety_templinks SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "linkuid01=UUID(), linkuid02=UUID(), linkuid03=UUID(), ".
            "taskkey=:taskkey, ldesc=:ldesc";
        
        $dbcontrol = new Z_GDDBConnection();
        $dbcontrol->setCrossAppConn();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":taskkey", "ACTIVATE_USER_ACCOUNT");
        $dbcontrol->bindParam(":ldesc", $this->ua_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $row = $dbcontrol->getRowfromLastId($dbcontrol, "usersafety_templinks", $lid);
                
                $dbcontrol->saveActivityLog("REGISTER_ACTIVATION_TEMP_LINK","Temp Link has been registered".
                    ":Last Id:".$lid.":".
                    "REGISTER_TEMP_LINK_USER_".":".
                    ":linkuid01:".$row["linkuid01"].
                    ":linkuid02:".$row["linkuid02"].
                    ":linkuid03:".$row["linkuid03"]);

                $message = $this->GDBuildHtmlMessage($row["linkuid01"]."{}".$row["linkuid02"]."{}".$row["linkuid03"]);
                $this->sendmail($this->ua_email,
                    "User Activation - ".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'],
                    $message);
                
                
                $this->gdlog()->LogInfo("registerTempLink():TEMP_LINK_CREATED:".
                    "User Activation:".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].":".
                    ":message:".$message);
                return "TEMP_LINK_CREATED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerTempLink():TEMP_LINK_NOT_CREATED");
                return "TEMP_LINK_NOT_CREATED";
            }
        }
        else
        {
            $this->gdlog()->LogInfo("registerTempLink():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }

    function GDBuildHtmlMessage($linkid)
    {
        $this->gdlog()->LogInfo("GDBuildHtmlMessage():Build Activation Email:".$_SESSION['GUYVERDESIGNS_SITE_ALIAS']);
        $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $o = "<html>";
        $o .= "<head>";
        $o .= "<title>User Activation</title>";
        $o .= "</head>";
        $o .= "<body>";
        $o .= "<ul>";
        $o = "<li>Nickname:" . $this->up_nickname . "</li>";
        $o = "<li>Email:" . $this->ua_email . "</li>";
        $o .= "<li>First Name:" . $this->up_fname . "</li>";
        $o .= "<li>Last Name:" . $this->up_lname . "</li>";
        $o .= "<li>Activation Link:<a href=\"http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
            "/gd.trxn.com/usersafety/activation.php?".
            "activationlink=".$linkid."\"/>Activate Account</a></li>";
        $o .= "</ul>";
        $o .= "<br/><img src=\"http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
            "/gd.trxn.com/mimes/images/logos/Guyver-Designs-Web-Site-Logo-w188h59.png\"/>";
        $o .= "</body>";
        $o .= "</html>";
        return $o;
    }
}
?>
    