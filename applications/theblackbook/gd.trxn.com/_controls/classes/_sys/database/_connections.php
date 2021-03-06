<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/database/_database.php"); ?>
<?php
class SysConnections
    extends SysDatabase
{
    public function setApplicationDB($APPDB = "APPDB")
    {
        zAppSysIntegration()->dumpSessionData();
        //Variables for connecting to your database.
        //These variable values come from your hosting account.
        $hostname = $this->getConnectionVariable($APPDB, "hostname");
        $database = $this->getConnectionVariable($APPDB, "database");
        $username = $this->getConnectionVariable($APPDB, "username");
        $password = $this->getConnectionVariable($APPDB, "password");

        //Connecting to your database
        try
        {
            zLog()->LogDebug("DB Connect:mysql:host=" .
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
            zLog()->LogDebug("Good Connection");
        }
        catch (PDOException $ex)
        {
            zLog()->LogDebug("Connection Error: ".$ex->getMessage());
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
            
        $xml = $_SESSION[zAppSysIntegration()->getKeySessSiteConfigRoot()]."ZDBCONNECTIONS.xml";

        zLog()->LogDebug("XML : {".$xml."}:{".$db."}");
        
        $xml = simplexml_load_file($xml);
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
        return $output;
    }
}
?>