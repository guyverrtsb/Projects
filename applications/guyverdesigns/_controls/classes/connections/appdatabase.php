<?php gdreqonce("/gd.trxn.com/_controls/classes/connections/database.php"); ?>
<?php
class ZAppDatabase
    extends ZGDDBConnection
{
    public function setApplicationDB($APPDB = "APPDB")
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
        $convar["LCL_GDCORP_USERSAFETY_DBNAME"] = "lclgdcorpdb";
        $convar["LCL_GDCORP_USERSAFETY_USRNAM"] = "root";
        $convar["LCL_GDCORP_USERSAFETY_PASWRD"] = "GDHonkey_01";
        // GoDaddy Prototype UserSafety Database
        $convar["PRT_GDCORP_USERSAFETY_HOSTNAME"] = "prtusrsfty.db.6047355.hostedresource.com";
        $convar["PRT_GDCORP_USERSAFETY_DBNAME"] = "prtusrsfty";
        $convar["PRT_GDCORP_USERSAFETY_USRNAM"] = "prtusrsfty";
        $convar["PRT_GDCORP_USERSAFETY_PASWRD"] = "GDProto@01";
        // GoDaddy Staging UserSafety Database
        $convar["STG_GDCORP_USERSAFETY_HOSTNAME"] = "stggdcorpdb.db.6047355.hostedresource.com";
        $convar["STG_GDCORP_USERSAFETY_DBNAME"] = "stggdcorpdb";
        $convar["STG_GDCORP_USERSAFETY_USRNAM"] = "stggdcorpdb";
        $convar["STG_GDCORP_USERSAFETY_PASWRD"] = "GDStage@01";
        // GoDaddy Production UserSafety Database
        $convar["PRD_GDCORP_USERSAFETY_HOSTNAME"] = "gdcorpdb.db.6047355.hostedresource.com";
        $convar["PRD_GDCORP_USERSAFETY_DBNAME"] = "gdcorpdb";
        $convar["PRD_GDCORP_USERSAFETY_USRNAM"] = "gdcorpdb";
        $convar["PRD_GDCORP_USERSAFETY_PASWRD"] = "GDProd@01";
        
        // LCL CrossApps Database
        $convar["LCL_GDCORP_CROSSAPPDATA_HOSTNAME"] = "localhost:3306";
        $convar["LCL_GDCORP_CROSSAPPDATA_DBNAME"] = "lclgdcorpdb";
        $convar["LCL_GDCORP_CROSSAPPDATA_USRNAM"] = "root";
        $convar["LCL_GDCORP_CROSSAPPDATA_PASWRD"] = "GDHonkey_01";
        // GoDaddy Prototype CrossApps Database
        $convar["PRT_GDCORP_CROSSAPPDATA_HOSTNAME"] = "prtcrssapp.db.6047355.hostedresource.com";
        $convar["PRT_GDCORP_CROSSAPPDATA_DBNAME"] = "prtcrssapp";
        $convar["PRT_GDCORP_CROSSAPPDATA_USRNAM"] = "prtcrssapp";
        $convar["PRT_GDCORP_CROSSAPPDATA_PASWRD"] = "GDProto@01";
        // GoDaddy Staging CrossApps Database
        $convar["STG_GDCORP_CROSSAPPDATA_HOSTNAME"] = "stggdcorpdb.db.6047355.hostedresource.com";
        $convar["STG_GDCORP_CROSSAPPDATA_DBNAME"] = "stggdcorpdb";
        $convar["STG_GDCORP_CROSSAPPDATA_USRNAM"] = "stggdcorpdb";
        $convar["STG_GDCORP_CROSSAPPDATA_PASWRD"] = "GDStage@01";
        // GoDaddy Production CrossApps Database
        $convar["PRD_GDCORP_CROSSAPPDATA_HOSTNAME"] = "gdcorpdb.db.6047355.hostedresource.com";
        $convar["PRD_GDCORP_CROSSAPPDATA_DBNAME"] = "gdcorpdb";
        $convar["PRD_GDCORP_CROSSAPPDATA_USRNAM"] = "gdcorpdb";
        $convar["PRD_GDCORP_CROSSAPPDATA_PASWRD"] = "GDProd@01";
        
        // LCL GroupYou Database
        $convar["LCL_GDCORP_APPDB_HOSTNAME"] = "localhost:3306";
        $convar["LCL_GDCORP_APPDB_DBNAME"] = "lclgdcorpdb";
        $convar["LCL_GDCORP_APPDB_USRNAM"] = "root";
        $convar["LCL_GDCORP_APPDB_PASWRD"] = "GDHonkey_01";
        // GoDaddy Staging GroupYou Database
        $convar["STG_GDCORP_APPDB_HOSTNAME"] = "stggdcorpdb.db.6047355.hostedresource.com";
        $convar["STG_GDCORP_APPDB_DBNAME"] = "stggdcorpdb";
        $convar["STG_GDCORP_APPDB_USRNAM"] = "stggdcorpdb";
        $convar["STG_GDCORP_APPDB_PASWRD"] = "GDStage@01";
        // GoDaddy Production GroupYou Database
        $convar["PRD_GDCORP_APPDB_HOSTNAME"] = "gdcorpdb.db.6047355.hostedresource.com";
        $convar["PRD_GDCORP_APPDB_DBNAME"] = "gdcorpdb";
        $convar["PRD_GDCORP_APPDB_USRNAM"] = "gdcorpdb";
        $convar["PRD_GDCORP_APPDB_PASWRD"] = "GDProd@01";
       
        $output = $convar[$_SESSION['GUYVERDESIGNS_SERVER_ENVIRONMENT'] . "_" . $db . "_" . $name];
       
        gdlog()->LogDebug("DB_CONNECTION : ".$_SESSION['GUYVERDESIGNS_SERVER_ENVIRONMENT']."_".$db."_".$name."-{".$output."}");
       
        return $output;
    }
}
?>