<?php zReqOnce("/_controls/classes/dataobjects/base/merchant.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMerchantProfile
    extends MerchantBase
{
    function __construct()
    {
    }
    
    function full($officename,
                $email,
                $address1,
                $address2,
                $address3,
                $city,
                $crossappl_configurations_sdesc_region,
                $crossappl_configurations_sdesc_country,
                $intldialingcode,
                $areacode,
                $prefix,
                $number)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("full");

        $sqlstmnt = "INSERT INTO merchantprofile SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            officename=:officename,
            email=:email,
            address1=:address1,
            address2=:address2,
            address3=:address3,
            city=:city,
            crossappl_configurations_sdesc_region=:crossappl_configurations_sdesc_region,
            crossappl_configurations_sdesc_country=:crossappl_configurations_sdesc_country,
            intldialingcode=:intldialingcode,
            areacode=:areacode,
            prefix=:prefix,
            number=:number";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":officename", $officename);
        $appcon->bindParam(":email", $email);
        $appcon->bindParam(":address1", $address1);
        $appcon->bindParam(":address2", $address2);
        $appcon->bindParam(":address3", $address3);
        $appcon->bindParam(":city", $city);
        $appcon->bindParam(":crossappl_configurations_sdesc_region", $crossappl_configurations_sdesc_region);
        $appcon->bindParam(":crossappl_configurations_sdesc_country", $crossappl_configurations_sdesc_country);
        $appcon->bindParam(":intldialingcode", $intldialingcode);
        $appcon->bindParam(":areacode", $areacode);
        $appcon->bindParam(":prefix", $prefix);
        $appcon->bindParam(":number", $number);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "merchantprofile");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("full");
    }
}
?>