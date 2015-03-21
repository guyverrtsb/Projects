<?php require_once($_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]."/gd.trxn.com/_controls/classes/_sys/includes/_validation.php"); ?>
<?php
zLog()->LogInfo("AJAX_SERVICE_CONTROL_KEY{".getControlKey()."}");
if(getControlKey() == "GAMER_REGISTRATION")
{
    zReqOnce("/_controls/ajax/validation/CREATE_GAMER_REGISTRATION.php");
}
?>