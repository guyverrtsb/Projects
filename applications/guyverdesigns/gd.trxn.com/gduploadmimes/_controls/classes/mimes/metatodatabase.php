<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/base/mimebase.php"); ?>
<?php
/*
* File: image.manipulation.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
* 
*/
class zMetatoDatabase
    extends zMimeBaseObject
{    
    /**
     * Register the Mime Record.  This is basic File Information.
     * Also the Table that the Mime exists in
     */
    function registerMetaData($meta_table_name
                            , $appl_table_name
                            , $sitepackage
                            , $sitealias
                            , $ref_meta_uid
                            , $mime_type)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMime()");
        $fr;
        
        $sqlstmnt = "INSERT INTO ". $meta_table_name ." SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "ref_meta_uid=:ref_meta_uid, mime_type=:mime_type,".
            "appl_table_name=:appl_table_name, sitepackage=:sitepackage, sitealias=:sitealias";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("CROSSAPPDATA");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":ref_meta_uid", $ref_meta_uid);
        $dbcontrol->bindParam(":mime_type", $mime_type);
        $dbcontrol->bindParam(":appl_table_name", $appl_table_name);
        $dbcontrol->bindParam(":sitepackage", $sitepackage);
        $dbcontrol->bindParam(":sitealias", $sitealias);
        $dbcontrol->execUpdate();

        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $this->saveActivityLog("META_DATA_REGISTERED","Account has been registered".
                    ":lid:".$lid.
                    ":ref_meta_uid:".$ref_meta_uid.":".
                    ":mime_type:".$mime_type.":".
                    ":appl_table_name:".$appl_table_name.":".
                    ":sitepackage:".$sitepackage.":".
                    ":sitealias:".$sitealias.":");

                $row = $dbcontrol->getRowfromLastId($dbcontrol, $meta_table_name, $lid);
                $this->setMeta_uid($row["uid"]);
                $this->gdlog()->LogInfo("registerMime():META_DATA_REGISTERED");
                $fr = "META_DATA_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerMime():META_DATA_NOT_REGISTERED");
                $fr = "META_DATA_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("registerMime():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerMime()");
        return $fr;
    }
}
?>