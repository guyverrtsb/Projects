        <div id="messageline">
<?php
if(gdconfig()->getUIPageResponseCode() != "")
{
    printf("<p class=\"message\" UIPAGERESSHOW=\"%s\" UIPAGERESCODE=\"%s\" UIPAGERESKEY=\"%s\" UIPAGERESMSG=\"%s\">%s</p>", gdconfig()->getUIPageResponseMsgShow(), gdconfig()->getUIPageResponseCode(), gdconfig()->getUIPageResponseKey(), gdconfig()->getUIPageResponseMsg(), gdconfig()->getUIPageResponseMsg());
}
?>
<?php gdconfig()->cleanUIPageResponseData() ?>
        </div>