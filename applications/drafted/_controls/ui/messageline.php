<?php
if(isset($_REQUEST["ACTION_SERVICE_RETURN"]))
{
    $return = $_REQUEST["ACTION_SERVICE_RETURN"];
    if($return->getSysReturnShowMsg() == "TRUE")
    {
?>
<div id="messageline">
<?php
    printf("<div class=\"form-return-message\"><p class=\"message\">[%s]:%s</p></div>", $return->getSysReturnCode(), $return->getSysReturnMsg());
?>
</div>
<?php
    }
}
?>