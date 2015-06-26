<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/_user.php"); ?>
<?php
class Z_GD_TaskControl
    extends Z_User_Base
{
    function isActivated()
    {
        if(isset($_GET["activationlink"]) && $_GET["activationlink"] != "")
        {

            $this->gdlog()->LogInfo("isActivated():Activation Link:".$_GET["activationlink"]);
            $linkuidary = explode("{}", $_GET["activationlink"]);
            $linkuid01 = $linkuidary[0];
            $linkuid02 = $linkuidary[1];
            $linkuid03 = $linkuidary[2];
            $this->gdlog()->LogInfo("isActivated():Activation Link Array".
                ":linkuid01:".$linkuid01.
                ":linkuid02:".$linkuid02.
                ":linkuid03:".$linkuid03);
            
            $sqlstmnt = "SELECT uid, taskkey, ldesc ".
                "FROM usersafety_templinks ".
                "WHERE linkuid01=:linkuid01 AND linkuid02=:linkuid02 AND linkuid03=:linkuid03";
        
            $dbcontrol = new Z_GDDBConnection();
            $dbcontrol->setCrossAppConn();
            $dbcontrol->setStatement($sqlstmnt);
            $dbcontrol->bindParam(":linkuid01", $linkuid01);
            $dbcontrol->bindParam(":linkuid02", $linkuid02);
            $dbcontrol->bindParam(":linkuid03", $linkuid03);
            $dbcontrol->execSelect();
            if($dbcontrol->getTransactionGood())
            {
                if($dbcontrol->getRowCount() > 0)
                {
                    $row = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC);
                    if($row["taskkey"] == "ACTIVATE_USER_ACCOUNT")
                    {
                        $this->deleteTempLink($row["uid"], $row["taskkey"], $row["ldesc"]);
                        $this->setUserActiveStatus($row["ldesc"], "T");
                        $message = $this->GDBuildHtmlMessage($row["ldesc"]);
                        $this->sendmail($this->getUaEmail(),
                            "User Activated - ".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'],
                            $message);
                        return "ACTIVATION_PERFORMED";
                    }
                    else
                    {
                        $this->gdlog()->LogInfo("isActivated():Activation Link not Found");
                        return "ACTIVATION_LINK_NOT_FOUND";
                    }
                }
                else
                {
                    $this->gdlog()->LogInfo("isActivated():Activation Link not Found");
                    return "TRANSACTION_FAIL";
                }
            }
            else
            {
                $this->gdlog()->LogInfo("isActivated():TRANSACTION_FAIL");
                return "TRANSACTION_FAIL";
            }
        }
        else
        {
            $this->gdlog()->LogInfo("isActivated():ACTIVATION_LINK_NOT_FOUND");
            return "ACTIVATION_LINK_NOT_FOUND";
        }
    }

    function deleteTempLink($uid, $taskkey, $ldesc)
    {
         $sqlstmnt = "DELETE FROM usersafety_templinks ".
            "WHERE uid=:uid";
            
        $dbcontrol = new Z_GDDBConnection();
        $dbcontrol->setCrossAppConn();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":uid", $uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $dbcontrol->saveActivityLog("TEMP_LINK_REMOVED", ":taskkey:".$taskkey.
                    ":uid:".$uid.":".
                    ":ldesc:".$ldesc.":");
                $this->gdlog()->LogInfo("deleteTempLink():Temp Link Remvoed:".
                    ":taskkey:".$taskkey.
                    ":uid:".$uid.":".
                    ":ldesc:".$ldesc.":");
                return "TEMP_LINK_REMOVED";
            }
            else
            {
                $this->gdlog()->LogInfo("deleteTempLink():Temp Link RemvoeFailed");
                return "NOT_FOUND";
            }
        }
        else
        {
            $this->gdlog()->LogInfo("deleteTempLink():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }

    function setUserActiveStatus($uid, $active)
    {
         $sqlstmnt = "UPDATE usersafety_useraccounts SET active=:active ".
            "WHERE uid=:uid";
            
        $dbcontrol = new Z_GDDBConnection();
        $dbcontrol->setCrossAppConn();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":active", $active);
        $dbcontrol->bindParam(":uid", $uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $dbcontrol->saveActivityLog("USER_IS_NOW_ACTIVE", ":uid:".$uid.":".
                    ":active:".$active.":");
                $this->gdlog()->LogInfo("setUsertoValid():User is Now Active:".
                    ":uid:".$uid.":".
                    ":active:".$active.":");
            }
            else
            {
                $this->gdlog()->LogInfo("setUsertoValid():Activity Log Failed");
            }
        }
        else
        {
            $this->gdlog()->LogInfo("setUsertoValid():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }

    function GDBuildHtmlMessage($uid)
    {
        $this->setUserAcountandProfile($uid);
        
        $this->gdlog()->LogInfo("GDBuildHtmlMessage():Build User Activated Email:".$_SESSION['GUYVERDESIGNS_SITE_ALIAS']);
        $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $o = "<html>";
        $o .= "<head>";
        $o .= "<title>User has been Activated</title>";
        $o .= "</head>";
        $o .= "<body>";
        $o .= "<ul>";
        $o = "<li>Nickname:" . $this->getUpNickname() . "</li>";
        $o = "<li>Email:" . $this->getUaEmail() . "</li>";
        $o .= "<li>First Name:" . $this->getUpFname() . "</li>";
        $o .= "<li>Last Name:" . $this->getUpLname() . "</li>";
        $o .= "<li>Activation Link:<a href=\"http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
            "/gd.trxn.com/usersafety/siteaccess.php\"/>Login</a></li>";
        $o .= "</ul>";
        $o .= "<br/><img src=\"http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
            "/gd.trxn.com/mimes/images/logos/Guyver-Designs-Web-Site-Logo-w188h59.png\"/>";
        $o .= "</body>";
        $o .= "</html>";
        return $o;
    }
}
?>
