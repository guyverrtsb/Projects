<?php gdreqonce("/gd.trxn.com/_controls/classes/connections/database.php"); ?>
<?php
class ZAppDatabase
    extends ZGDDBConnection
{
    public function setApplicationDB($APPDB = "GROUPYOU")
    { 
        //Variables for connecting to your database.
        //These variable values come from your hosting account.
        $hostname = $this->getConnectionVariable("GDCORP_".$APPDB, "HOSTNAME");
        $database = $this->getConnectionVariable("GDCORP_".$APPDB, "DBNAME");
        $username = $this->getConnectionVariable("GDCORP_".$APPDB, "USRNAM");
        $password = $this->getConnectionVariable("GDCORP_".$APPDB, "PASWRD");

        //Connecting to your database
        try
        {
            $this->gdlog()->LogInfo("DB Connect:mysql:host=" .
                $hostname . ":" .
                ";dbname=". $database . ":" .
                ";username=". $username . ":" .
                ";password=". $password);
            $this->setConnection(new PDO("mysql:host=".
                $hostname.
                ";dbname=".$database,
                $username,
                $password));
            $this->getConnection()->beginTransaction();
            $this->gdlog()->LogInfo("Good Connection");
        }
        catch (PDOException $ex)
        {
            $this->gdlog()->LogInfo("Connection Error: ".$ex->getMessage());
            echo "Connection Error: ".$ex->getMessage();
        }
    }
    
        
    private function getConnectionVariable($db, $name)
    {       
        // LCL UserSafety Database
        $convar["LCL_GDCORP_USERSAFETY_HOSTNAME"] = "localhost:3306";
        $convar["LCL_GDCORP_USERSAFETY_DBNAME"] = "lclusersafety";
        $convar["LCL_GDCORP_USERSAFETY_USRNAM"] = "root";
        $convar["LCL_GDCORP_USERSAFETY_PASWRD"] = "GDHonkey_01";
        // GoDaddy Prototype UserSafety Database
        $convar["PRT_GDCORP_USERSAFETY_HOSTNAME"] = "prtusrsfty.db.6047355.hostedresource.com";
        $convar["PRT_GDCORP_USERSAFETY_DBNAME"] = "prtusrsfty";
        $convar["PRT_GDCORP_USERSAFETY_USRNAM"] = "prtusrsfty";
        $convar["PRT_GDCORP_USERSAFETY_PASWRD"] = "GDProto@01";
        // GoDaddy Staging UserSafety Database
        $convar["STG_GDCORP_USERSAFETY_HOSTNAME"] = "stgusersafety.db.6047355.hostedresource.com";
        $convar["STG_GDCORP_USERSAFETY_DBNAME"] = "stgusersafety";
        $convar["STG_GDCORP_USERSAFETY_USRNAM"] = "stgusersafety";
        $convar["STG_GDCORP_USERSAFETY_PASWRD"] = "GDStage@01";
        // GoDaddy Production UserSafety Database
        $convar["PRD_GDCORP_USERSAFETY_HOSTNAME"] = "prdusrsfty.db.6047355.hostedresource.com";
        $convar["PRD_GDCORP_USERSAFETY_DBNAME"] = "prdusrsfty";
        $convar["PRD_GDCORP_USERSAFETY_USRNAM"] = "prdusrsfty";
        $convar["PRD_GDCORP_USERSAFETY_PASWRD"] = "GDProd@01";
        
        // LCL CrossApps Database
        $convar["LCL_GDCORP_CROSSAPPDATA_HOSTNAME"] = "localhost:3306";
        $convar["LCL_GDCORP_CROSSAPPDATA_DBNAME"] = "lclcrossapplication";
        $convar["LCL_GDCORP_CROSSAPPDATA_USRNAM"] = "root";
        $convar["LCL_GDCORP_CROSSAPPDATA_PASWRD"] = "GDHonkey_01";
        // GoDaddy Prototype CrossApps Database
        $convar["PRT_GDCORP_CROSSAPPDATA_HOSTNAME"] = "prtcrssapp.db.6047355.hostedresource.com";
        $convar["PRT_GDCORP_CROSSAPPDATA_DBNAME"] = "prtcrssapp";
        $convar["PRT_GDCORP_CROSSAPPDATA_USRNAM"] = "prtcrssapp";
        $convar["PRT_GDCORP_CROSSAPPDATA_PASWRD"] = "GDProto@01";
        // GoDaddy Staging CrossApps Database
        $convar["STG_GDCORP_CROSSAPPDATA_HOSTNAME"] = "stgcrossappli.db.6047355.hostedresource.com";
        $convar["STG_GDCORP_CROSSAPPDATA_DBNAME"] = "stgcrossappli";
        $convar["STG_GDCORP_CROSSAPPDATA_USRNAM"] = "stgcrossappli";
        $convar["STG_GDCORP_CROSSAPPDATA_PASWRD"] = "GDStage@01";
        // GoDaddy Production CrossApps Database
        $convar["PRD_GDCORP_CROSSAPPDATA_HOSTNAME"] = "prdcrssapp.db.6047355.hostedresource.com";
        $convar["PRD_GDCORP_CROSSAPPDATA_DBNAME"] = "prdcrssapp";
        $convar["PRD_GDCORP_CROSSAPPDATA_USRNAM"] = "prdcrssapp";
        $convar["PRD_GDCORP_CROSSAPPDATA_PASWRD"] = "GDProd@01";
        
        // LCL GroupYou Database
        $convar["LCL_GDCORP_GROUPYOU_HOSTNAME"] = "localhost:3306";
        $convar["LCL_GDCORP_GROUPYOU_DBNAME"] = "lclunivlifeportal";
        $convar["LCL_GDCORP_GROUPYOU_USRNAM"] = "root";
        $convar["LCL_GDCORP_GROUPYOU_PASWRD"] = "GDHonkey_01";
        // GoDaddy Staging GroupYou Database
        $convar["STG_GDCORP_GROUPYOU_HOSTNAME"] = "stggroupyou.db.6047355.hostedresource.com";
        $convar["STG_GDCORP_GROUPYOU_DBNAME"] = "stggroupyou";
        $convar["STG_GDCORP_GROUPYOU_USRNAM"] = "stggroupyou";
        $convar["STG_GDCORP_GROUPYOU_PASWRD"] = "GDStage@01";
        // GoDaddy Production GroupYou Database
        $convar["PRD_GDCORP_APPDB_HOSTNAME"] = "univmeetdb.db.6047355.hostedresource.com";
        $convar["PRD_GDCORP_APPDB_DBNAME"] = "univmeetdb";
        $convar["PRD_GDCORP_APPDB_USRNAM"] = "univmeetdb";
        $convar["PRD_GDCORP_APPDB_PASWRD"] = "GDProd@01";
       
       return $convar[$_SESSION['GUYVERDESIGNS_SERVER_ENVIRONMENT'] . "_" . $db . "_" . $name];
    }
}
?>