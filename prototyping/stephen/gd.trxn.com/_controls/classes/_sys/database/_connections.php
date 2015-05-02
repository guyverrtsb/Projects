<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/database/_database.php"); ?>
<?php
class SysConnections
    extends SysDatabase
{
    public function setApplicationDB($APPDB = "APPDB")
    {
        SysIntegration::dumpSessionData();
        //Variables for connecting to your database.
        //These variable values come from your hosting account.
        $hostname = $this->getConnectionVariable($APPDB, "hostname");
        $database = $this->getConnectionVariable($APPDB, "database");
        $username = $this->getConnectionVariable($APPDB, "username");
        $password = $this->getConnectionVariable($APPDB, "password");

        //Connecting to your database
        try
        {
            zLog()->LogInfo("DB Connect:mysql:host=" .
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
            zLog()->LogInfo("Good Connection");
        }
        catch (PDOException $ex)
        {
            zLog()->LogInfo("Connection Error: ".$ex->getMessage());
            echo "Connection Error: ".$ex->getMessage();
        }
    }
    
        
    private function getConnectionVariable($db, $param)
    {
        $db = strtolower($db);
        if($db == "usersafety")
            $db = "usersafety";
        else if($db == "crossappdata")
            $db = "crossapplication";
        else if($db == "appdb")
            $db = "application";
            
        $connectionsXML = $_SESSION[AppSysIntegration::getKeySessSiteConfigRoot()]."ZDBCONNECTIONS.xml";

        zLog()->LogDebug("Connections XML : {".$connectionsXML."}:{".$db."}");
        
        $xml = simplexml_load_file($connectionsXML);
        foreach($xml->children() as $dbconfig)
        {
            if($dbconfig->getName() == $db)
            {
                foreach($dbconfig->children() as $paramconfig)
                {
                    if($paramconfig->getName() == $param)
                        $output = $paramconfig;
                }
            }
        }
        // gdlog()->LogDebug("DB_CONNECTION_PARAM:".$db.":".$param.":".$output);
        return $output;
    }
}
?>