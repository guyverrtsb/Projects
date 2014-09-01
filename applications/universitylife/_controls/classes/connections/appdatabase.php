<?php gdreqonce("/gd.trxn.com/_controls/classes/connections/database.php"); ?>
<?php
class ZAppDatabase
    extends ZGDDBConnection
{
    public function setApplicationDB($APPDB = "APPDB")
    { 
        //Variables for connecting to your database.
        //These variable values come from your hosting account.
        $hostname = $this->getConnectionVariable($APPDB, "hostname");
        $database = $this->getConnectionVariable($APPDB, "database");
        $username = $this->getConnectionVariable($APPDB, "username");
        $password = $this->getConnectionVariable($APPDB, "password");

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
    
        
    private function getConnectionVariable($db, $param)
    {
        if(strtolower($db) == "usersafety")
            $db = "usersafety";
        else if(strtolower($db) == "crossappdata")
            $db = "crossapplication";
        else if(strtolower($db) == "appdb")
            $db = "application";
            
        $configroot = $_SESSION[ZGDConfigurations::getKeySessSiteConfigRoot()];
        
        $xml = simplexml_load_file($configroot."/connections.xml");
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

        gdlog()->LogDebug("DB_CONNECTION_PARAM:".$db.":".$param.":".$output.":".$configroot);
       
        return $output;
    }
}
?>