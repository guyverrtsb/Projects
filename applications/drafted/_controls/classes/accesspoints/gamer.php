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
        zLog()->LogInfoStartFUNCTION("createGamerInfo");
        $mr = "NA";
        
        $emailexists = new RetrieveUserAccount();
        $emailexists->byEmail($email);
        
        $nicknameexists = new RetrieveUserAccount();
        $nicknameexists->byNickname($nickname);
        
        $guv = new GenerateUniqueValue();
        $tablekey = $guv->generate("USERSAFETY", "useraccount", "usertablekey", $this->createUserTableKey($nickname));
        zLog()->LogInfo("TABLEKEY:{".$guv->getOutputData("UNIQUE_VALUE")."}");
        
        $gamertagexists = new RetrieveGamerAccount();
        $gamertagexists->byGamertag($gamertag);

        if($emailexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND"
            && $nicknameexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND"
            && $gamertagexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $cua = new CreateUserAccount();
            $cua->basic($email, $nickname, $password);
            
            $cup = new CreateUserProfile();
            $cup->full($firstname,
                    $lastname,
                    $city,
                    $crossappl_configurations_sdesc_region,
                    $crossappl_configurations_sdesc_country);

            $cmuatup = new CreateMatchUserAccounttoUserProfile();
            $cmuatup->full($cua->getUid(), $cup->getUid());

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
            $this->setOutputData("gameraccount_tag", $cga->getGamertag());

            $mr = zLog()->LogInfoRETURN("GAMER_IS_CREATED");
        }
        else if($emailexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $mr = zLog()->LogInfoRETURN("EMAIL_IN_USE");
        }
        else if($nicknameexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $guv->generate("USERSAFETY", "useraccount", "nickname", $this->createsdesc($nickname));

            $this->setOutputData("NICKNAME_SUGGESTION", $guv->getOutputData("UNIQUE_VALUE"));
            $mr = zLog()->LogInfoRETURN("NICKNAME_IN_USE");
        }
        else if($gamertagexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $guv->generate("APPLICATION", "gameraccount", "gamertag", $this->createsdesc($gamertag));

            $this->setOutputData("GAMERTAG_SUGGESTION", $guv->getOutputData("UNIQUE_VALUE"));
            $mr = zLog()->LogInfoRETURN("GAMERTAG_IN_USE");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("createGamerInfo");
    }
}
?>