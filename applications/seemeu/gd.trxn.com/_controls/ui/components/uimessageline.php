<!-- START - Component Message Line ================================================== -->
<?php
if(zAppSysIntegration()->getUIPageResponseMsgShow() == "TRUE")
{
    printf("<div id=\"gdtrxncom_msgline\" class=\"row\"><div class=\"col-lg-12\">[%s]-%s</div></div>", zAppSysIntegration()->getUIPageResponseCode(), zAppSysIntegration()->getUIPageResponseMsg());
    zAppSysIntegration()->cleanUIPageResponseData();
}
?>
<!-- END - Component Message Line ================================================== -->
