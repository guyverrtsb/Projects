<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveUser
    extends UserBase
{
    function __construct()
    {
    }
    
    function byUid($useraccount_uid)
    {
        zLog()->LogStart_DataObjectFunction("byUid");

        $sqlstmnt = "SELECT "
            .$this->dbfas("match_user.lid,
                match_user.uid,
                match_user.createddt,
                match_user.changeddt,
                useraccount.lid,
                useraccount.uid,
                useraccount.createddt,
                useraccount.changeddt,
                useraccount.email,
                useraccount.password,
                useraccount.nickname,
                useraccount.usertablekey,
                useraccount.isactive,
                useraccount.changepassword,
                useraccount.numberoflogintries,
                userprofile.lid,
                userprofile.uid,
                userprofile.createddt,
                userprofile.changeddt,
                userprofile.firstname,
                userprofile.lastname,
                userprofile.city,
                userprofile.crossappl_configurations_sdesc_region,
                userprofile.crossappl_configurations_sdesc_country").
            "FROM match_user 
            join useraccount
            on match_user.useraccount_uid = useraccount.uid
            join userprofile
            on match_user.userprofile_uid = userprofile.uid
            WHERE useraccount.uid = :useraccount_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_uid", $useraccount_uid);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byUid");
    }
    
    function byEmail($useraccount_email)
    {
        zLog()->LogStart_DataObjectFunction("byEmail");
        
        $sqlstmnt = "SELECT ".$this->dbfas("match_user.lid,
                match_user.uid,
                match_user.createddt,
                match_user.changeddt,
                useraccount.lid,
                useraccount.uid,
                useraccount.createddt,
                useraccount.changeddt,
                useraccount.email,
                useraccount.password,
                useraccount.nickname,
                useraccount.usertablekey,
                useraccount.isactive,
                useraccount.changepassword,
                useraccount.numberoflogintries,
                userprofile.lid,
                userprofile.uid,
                userprofile.createddt,
                userprofile.changeddt,
                userprofile.firstname,
                userprofile.lastname,
                userprofile.city,
                userprofile.crossappl_configurations_sdesc_region,
                userprofile.crossappl_configurations_sdesc_country")
            ."FROM match_user 
            join useraccount
            on match_user.useraccount_uid = useraccount.uid
            join userprofile
            on match_user.userprofile_uid = userprofile.uid
            WHERE useraccount.email = :useraccount_email";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_email", $useraccount_email);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byEmail");
    }
    
    function byMatchUid($useraccount_email)
    {
        zLog()->LogStart_DataObjectFunction("byEmail");
        
        $sqlstmnt = "SELECT ".$this->dbfas("match_user.lid,
                match_user.uid,
                match_user.createddt,
                match_user.changeddt,
                useraccount.lid,
                useraccount.uid,
                useraccount.createddt,
                useraccount.changeddt,
                useraccount.email,
                useraccount.password,
                useraccount.nickname,
                useraccount.usertablekey,
                useraccount.isactive,
                useraccount.changepassword,
                useraccount.numberoflogintries,
                userprofile.lid,
                userprofile.uid,
                userprofile.createddt,
                userprofile.changeddt,
                userprofile.firstname,
                userprofile.lastname,
                userprofile.city,
                userprofile.crossappl_configurations_sdesc_region,
                userprofile.crossappl_configurations_sdesc_country")
            ."FROM match_user 
            join useraccount
            on match_user.useraccount_uid = useraccount.uid
            join userprofile
            on match_user.userprofile_uid = userprofile.uid
            WHERE useraccount.email = :useraccount_email";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_email", $useraccount_email);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byEmail");
    }
}
?>