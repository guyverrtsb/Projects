<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/useraccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/useraccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/userprofile.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/match_useraccount_to_userprofile.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/gameraccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/gameraccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/gamerprofile.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/match_useraccount_to_gameraccount_to_gamerprofile.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/match_useraccount_to_gameraccount_to_gamerprofile.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/generateuniquevalue.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/gamerdata.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/userdata.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
class Gamer
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    /*
     * This Method is used when Creating
     * User Account and User Profile and Matching.
     * This account will be inactive.
     * the Task Control Unique QS will be generated.
     * You may access using the getTaskCountrolQS method
     */
    function createGamerInfo($email,
                            $nickname,
                            $password,
                            $firstname,
                            $lastname,
                            $city,
                            $crossappl_configurations_sdesc_region,
                            $crossappl_configurations_sdesc_country,
                            $gamertag,
                            $configurations_sdesc_gamerrole,
                            $avatarmimeuid = "")
    {
        zLog()->LogStartFUNCTION("createGamerInfo");
        $mr = "NA";
        
        $emailexists = new RetrieveUserAccount();
        $emailexists->byEmail($email);
        
        $nicknameexists = new RetrieveUserAccount();
        $nicknameexists->byNickname($nickname);
        
        $guv = new GenerateUniqueValue();
        $tablekey = $guv->generate("USERSAFETY", "useraccount", "usertablekey", $this->createUserTableKey($nickname));
        zLog()->LogDebug("TABLEKEY:{".$guv->getOutputData("UNIQUE_VALUE")."}");
        
        $gamertagexists = new RetrieveGamerAccount();
        $gamertagexists->byGamertag($gamertag);

        if($emailexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND"
            && $nicknameexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND"
            && $gamertagexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $cua = new CreateUserAccount();
            $cua->basic($email, $nickname, $password);
            
            $cup = new CreateUserProfile();
            $cup->basic($firstname,
                        $lastname,
                        $city,
                        $crossappl_configurations_sdesc_region,
                        $crossappl_configurations_sdesc_country);

            $cmuatup = new CreateMatchUserAccounttoUserProfile();
            $cmuatup->basic($cua->getUid(), $cup->getUid());

            $cga = new CreateGamerAccount();
            $cga->full($gamertag, $configurations_sdesc_gamerrole);
            
            $cgp = new CreateGamerProfile();
            $cgp->full($avatarmimeuid);

            $match = new CreateMatchUserAccounttoGamerAccountProfile();
            $match->full($cua->getUid(), $cga->getUid(), $cgp->getUid());

            $this->setOutputData("useraccount_uid", $cua->getUid());
            $this->setOutputData("useraccount_email", $cua->getEmail());
            $this->setOutputData("useraccount_usertablekey", $cua->getUsertablekey());
            $this->setOutputData("useraccount_nickname", $cua->getNickname());
            $this->setOutputData("userprofile_firstname", $cup->getFirstname());
            $this->setOutputData("userprofile_lastname", $cup->getLastname());
            $this->setOutputData("gameraccount_uid", $cga->getUid());
            $this->setOutputData("gameraccount_gamertag", $cga->getGamertag());

            $mr = zLog()->LogReturn("GAMER_IS_CREATED");
        }
        else if($emailexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $mr = zLog()->LogReturn("EMAIL_IN_USE");
        }
        else if($nicknameexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $guv->generate("USERSAFETY", "useraccount", "nickname", $this->createsdesc($nickname));

            $this->setOutputData("NICKNAME_SUGGESTION", $guv->getOutputData("UNIQUE_VALUE"));
            $mr = zLog()->LogReturn("NICKNAME_IN_USE");
        }
        else if($gamertagexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $guv->generate("APPLICATION", "gameraccount", "gamertag", $this->createsdesc($gamertag));

            $this->setOutputData("GAMERTAG_SUGGESTION", $guv->getOutputData("UNIQUE_VALUE"));
            $mr = zLog()->LogReturn("GAMERTAG_IN_USE");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogEndFUNCTION("createGamerInfo");
    }
    
    function retrieveGamer($by, $val)
    {
        zLog()->LogStartFUNCTION("retrieveGamer");
        $mr = "NA";
 
        if($by == "useraccount_uid")
        {
            $rgd = new RetrieveGamerData();
            $rgd->byUseraccountuid($val);
            
            $this->setOutputData("useraccount_uid", $rgd->getUserAccountUid());
            $this->setOutputData("gameraccount_uid", $rgd->getGamerAccountUid());
            $this->setOutputData("gameraccount_configurations_sdesc_gamerrole", $rgd->getGamerAccountCfgSdescGamerRole());
            $this->setOutputData("gameraccount_gamertag", $rgd->getGamerAccountGamertag());
            $this->setOutputData("gameraccount_isactive", $rgd->getGamerAccountIsactive());
            $this->setOutputData("gamerprofile_uid", $rgd->getGamerProfileUid());
            $this->setOutputData("gamerprofile_avatarmimeuid", $rgd->getGamerProfileAvatarmimeuid());
            
            $mr = "GAMER_ACCOUNT_FOUND";
        }
        else if($by == "gameraccount_tag")
        {
            $rgd = new RetrieveGamerData();
            $rgd->byGamertag($val);
            
            $this->setOutputData("useraccount_uid", $rgd->getUserAccountUid());
            $this->setOutputData("gameraccount_uid", $rgd->getGamerAccountUid());
            $this->setOutputData("gameraccount_configurations_sdesc_gamerrole", $rgd->getGamerAccountCfgSdescGamerRole());
            $this->setOutputData("gameraccount_gamertag", $rgd->getGamerAccountGamertag());
            $this->setOutputData("gameraccount_isactive", $rgd->getGamerAccountIsactive());
            $this->setOutputData("gamerprofile_uid", $rgd->getGamerProfileUid());
            $this->setOutputData("gamerprofile_avatarmimeuid", $rgd->getGamerProfileAvatarmimeuid());
            
            $mr = "GAMER_ACCOUNT_FOUND";
        }
        else if($by == "useraccount_email")
        {
            $rud = new RetrieveUserData();
            $rud->byUseraccountemail($val);
            
            if($rud->getSysReturnCode() == "RECORD_IS_FOUND")
            {
                $rgd = new RetrieveGamerData();
                $rgd->byUseraccountuid($rud->getUAUid());
                
                $this->setOutputData("useraccount_uid", $rud->getUAUid());
                $this->setOutputData("useraccount_email", $rud->getEmail());
                $this->setOutputData("useraccount_nickname", $rud->getNickname());

                $this->setOutputData("userprofile_firstname", $rud->getFirstname());
                $this->setOutputData("userprofile_lastname", $rud->getLastname());
                
                $this->setOutputData("gameraccount_uid", $rgd->getGamerAccountUid());
                $this->setOutputData("gameraccount_gamertag", $rgd->getGamerAccountGamertag());
                
                $mr = "GAMER_ACCOUNT_FOUND";
            }
            else
            {
                $mr = $rud->getSysReturnCode();
            }
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogEndFUNCTION("retrieveGamer");
    }
}
?>