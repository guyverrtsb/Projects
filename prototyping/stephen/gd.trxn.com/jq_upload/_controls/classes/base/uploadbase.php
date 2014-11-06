<?php gdreqonce("/gd.trxn.com/jq_upload/_controls/classes/base/mimebase.php"); ?>
<?php
class zUploadBaseObject
    extends zMimeBaseObject
{
    var $json;
    var $response;
    function setJSON($json)
    {
        $this->json = $json;
    }
    function getJSON()
    {
        return $this->json;
    }
    
    function setResponse($response)
    {
        $this->response = $response;
    }
    function getResponse()
    {
        return $this->response;
    }
    function doPrintResponse()
    {
        return false;
    }
}
