<?php gdreqonce("/gd.trxn.com/upload/_controls/classes/base/mimebase.php"); ?>
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
    function registerMetaDataDocument($dbconfigkey
                                    , $meta_table_name
                                    , $site
                                    , $sitealias
                                    , $appl_table
                                    , $appl_table_uid
                                    , $name
                                    , $size
                                    , $type
                                    , $url
                                    , $osfolder
                                    , $ospath
                                    , $urlfolder
                                    , $urlpath
                                    , $osfileext)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMetaDataDocument()");
        $fr;
        
        $sqlstmnt = "INSERT INTO ". $meta_table_name ." SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "site=:site, sitealias=:sitealias, ".
            "appl_table=:appl_table, appl_table_uid=:appl_table_uid, ".
            "name=:name, size=:size, type=:type, url=:url, ".
            "osfolder=:osfolder, ospath=:ospath, urlfolder=:urlfolder, urlpath=:urlpath, osfileext=:osfileext";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB($dbconfigkey);
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":site", $site);
        $dbcontrol->bindParam(":sitealias", $sitealias);
        $dbcontrol->bindParam(":appl_table", $appl_table);
        $dbcontrol->bindParam(":appl_table_uid", $appl_table_uid);
        $dbcontrol->bindParam(":name", $name);
        $dbcontrol->bindParam(":size", $size);
        $dbcontrol->bindParam(":type", $type);
        $dbcontrol->bindParam(":url", $url);
        $dbcontrol->bindParam(":osfolder", $osfolder);
        $dbcontrol->bindParam(":ospath", $ospath);
        $dbcontrol->bindParam(":urlfolder", $urlfolder);
        $dbcontrol->bindParam(":urlpath", $urlpath);
        $dbcontrol->bindParam(":osfileext", $osfileext);
        $dbcontrol->execUpdate();

        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $this->saveActivityLog("META_DATA_REGISTERED","Account has been registered".
                    ":lid:".$lid.
                    ":site:".$site.":".
                    ":sitealias:".$sitealias.":".
                    ":appl_table:".$appl_table.":".
                    ":appl_table_uid:".$appl_table_uid.":".
                    ":name:".$name.":".
                    ":size:".$size.":".
                    ":type:".$type.":".
                    ":url:".$url.":".
                    ":osfolder:".$osfolder.":".
                    ":ospath:".$ospath.":".
                    ":urlfolder:".$urlfolder.":".
                    ":urlpath:".$urlpath.":".
                    ":osfileext:".$osfileext.":");

                $row = $dbcontrol->getRowfromLastId($dbcontrol, $meta_table_name, $lid);
                $this->setMeta_uid($row["uid"]);
                $this->gdlog()->LogInfo("registerMetaDataDocument():META_DATA_REGISTERED");
                $fr = "META_DATA_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerMetaDataDocument():META_DATA_NOT_REGISTERED");
                $fr = "META_DATA_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("registerMetaDataDocument():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerMetaDataDocument()");
        return $fr;
    }

    /**
     * Register the Mime Record.  This is basic File Information.
     * Also the Table that the Mime exists in
     */
    function registerMetaDataImage($dbconfigkey
                                , $meta_table_name
                                , $site
                                , $sitealias
                                , $appl_table
                                , $appl_table_uid
                                , $name
                                , $size
                                , $type
                                , $url
                                , $osfolder
                                , $ospath
                                , $urlfolder
                                , $urlpath
                                , $osfileext
                                
                                , $appl_table_scaled
                                , $appl_table_scaled_uid
                                , $appl_table_scaled_size
                                , $appl_table_scaled_url
                                , $appl_table_scaled_ospath
                                , $appl_table_scaled_osfolder
                                
                                , $appl_table_thumbnail
                                , $appl_table_thumbnail_uid
                                , $appl_table_thumbnail_size
                                , $appl_table_thumbnail_url
                                , $appl_table_thumbnail_ospath
                                , $appl_table_thumbnail_osfolder)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMetaDataImage()");
        $fr;
        
        $sqlstmnt = "INSERT INTO ". $meta_table_name ." SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "site=:site, sitealias=:sitealias, ".
            "appl_table=:appl_table, appl_table_uid=:appl_table_uid, ".
            "name=:name, size=:size, type=:type, url=:url, ".
            "osfolder=:osfolder, ospath=:ospath, urlfolder=:urlfolder, urlpath=:urlpath, osfileext=:osfileext, ".
            
            "appl_table_scaled=:appl_table_scaled, appl_table_scaled_uid=:appl_table_scaled_uid, ".
            "appl_table_scaled_size=:appl_table_scaled_size, appl_table_scaled_url=:appl_table_scaled_url, ".
            "appl_table_scaled_ospath=:appl_table_scaled_ospath, appl_table_scaled_osfolder=:appl_table_scaled_osfolder, ".
            
            "appl_table_thumbnail=:appl_table_thumbnail, appl_table_thumbnail_uid=:appl_table_thumbnail_uid, ".
            "appl_table_thumbnail_size=:appl_table_thumbnail_size, appl_table_thumbnail_url=:appl_table_thumbnail_url, ".
            "appl_table_thumbnail_ospath=:appl_table_thumbnail_ospath, appl_table_thumbnail_osfolder=:appl_table_thumbnail_osfolder";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB($dbconfigkey);
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":site", $site);
        $dbcontrol->bindParam(":sitealias", $sitealias);
        $dbcontrol->bindParam(":appl_table", $appl_table);
        $dbcontrol->bindParam(":appl_table_uid", $appl_table_uid);
        $dbcontrol->bindParam(":name", $name);
        $dbcontrol->bindParam(":size", $size);
        $dbcontrol->bindParam(":type", $type);
        $dbcontrol->bindParam(":url", $url);
        $dbcontrol->bindParam(":osfolder", $osfolder);
        $dbcontrol->bindParam(":ospath", $ospath);
        $dbcontrol->bindParam(":urlfolder", $urlfolder);
        $dbcontrol->bindParam(":urlpath", $urlpath);
        $dbcontrol->bindParam(":osfileext", $osfileext);
        
        $dbcontrol->bindParam(":appl_table_scaled", $appl_table_scaled);
        $dbcontrol->bindParam(":appl_table_scaled_uid", $appl_table_scaled_uid);
        $dbcontrol->bindParam(":appl_table_scaled_size", $appl_table_scaled_size);
        $dbcontrol->bindParam(":appl_table_scaled_url", $appl_table_scaled_url);
        $dbcontrol->bindParam(":appl_table_scaled_ospath", $appl_table_scaled_ospath);
        $dbcontrol->bindParam(":appl_table_scaled_osfolder", $appl_table_scaled_osfolder);
        
        $dbcontrol->bindParam(":appl_table_thumbnail", $appl_table_thumbnail);
        $dbcontrol->bindParam(":appl_table_thumbnail_uid", $appl_table_thumbnail_uid);
        $dbcontrol->bindParam(":appl_table_thumbnail_size", $appl_table_thumbnail_size);
        $dbcontrol->bindParam(":appl_table_thumbnail_url", $appl_table_thumbnail_url);
        $dbcontrol->bindParam(":appl_table_thumbnail_ospath", $appl_table_thumbnail_ospath);
        $dbcontrol->bindParam(":appl_table_thumbnail_osfolder", $appl_table_thumbnail_osfolder);
        $dbcontrol->execUpdate();

        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $this->saveActivityLog("META_DATA_REGISTERED","Account has been registered".
                    ":lid:".$lid.
                    ":site:".$site.":".
                    ":sitealias:".$sitealias.":".
                    ":appl_table:".$appl_table.":".
                    ":appl_table_uid:".$appl_table_uid.":".
                    ":name:".$name.":".
                    ":size:".$size.":".
                    ":type:".$type.":".
                    ":url:".$url.":".
                    ":osfolder:".$osfolder.":".
                    ":ospath:".$ospath.":".
                    ":urlfolder:".$urlfolder.":".
                    ":urlpath:".$urlpath.":".
                    ":osfileext:".$osfileext.":".
        
                    ":appl_table_scaled:".$appl_table_scaled.":".
                    ":appl_table_scaled_uid:".$appl_table_scaled_uid.":".
                    ":appl_table_scaled_size:".$appl_table_scaled_size.":".
                    ":appl_table_scaled_url:".$appl_table_scaled_url.":".
                    ":appl_table_scaled_ospath:".$appl_table_scaled_ospath.":".
                    ":appl_table_scaled_osfolder:".$appl_table_scaled_osfolder.":".
                    
                    ":appl_table_thumbnail:".$appl_table_thumbnail.":".
                    ":appl_table_thumbnail_uid:".$appl_table_thumbnail_uid.":".
                    ":appl_table_thumbnail_size:".$appl_table_thumbnail_size.":".
                    ":appl_table_thumbnail_url:".$appl_table_thumbnail_url.":".
                    ":appl_table_thumbnail_ospath:".$appl_table_thumbnail_ospath.":".
                    ":appl_table_thumbnail_osfolder:".$appl_table_thumbnail_osfolder.":");

                $row = $dbcontrol->getRowfromLastId($dbcontrol, $meta_table_name, $lid);
                $this->setMeta_uid($row["uid"]);
                $this->gdlog()->LogInfo("registerMetaDataImage():META_DATA_REGISTERED");
                $fr = "META_DATA_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerMetaDataImage():META_DATA_NOT_REGISTERED");
                $fr = "META_DATA_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("registerMetaDataImage():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerMetaDataImage()");
        return $fr;
    }
}
?>