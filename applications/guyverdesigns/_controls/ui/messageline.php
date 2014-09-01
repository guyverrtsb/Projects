        <div id="messageline">
<?php
if(gdconfig()->getUIPageResponseCode() != "")
{
    printf("<p class=\"message\" UIPAGERESSHOW=\"TRUE\" UIPAGERESCODE=\"%s\" UIPAGERESKEY=\"%s\" UIPAGERESMSG=\"%s\">%s</p>", gdconfig()->getUIPageResponseCode(), gdconfig()->getUIPageResponseKey(), gdconfig()->getUIPageResponseMsg(), gdconfig()->getUIPageResponseMsg());
}
?>
<?php gdconfig()->cleanUIPageResponseData() ?>
        </div>