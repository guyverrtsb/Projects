<ul>
<?php
if(getpagekey() == "BILLTO")
{
    printf("<li class=\"menuheader\" dyncontentkey=\"LIST_OF_BILLTOS\" funcname=\"buildDynamicMenuElements\">Bill Tos</li>");
}
else if(getpagekey() == "CLIENT")
{
    printf("<li class=\"menuheader\" dyncontentkey=\"LIST_OF_CLIENTS\" funcname=\"buildDynamicMenuElements\">Clients</li>");
}
else if(getpagekey() == "PROJECT")
{
    printf("<li class=\"menuheader\" dyncontentkey=\"LIST_OF_PROJECTS\" funcname=\"buildDynamicMenuElements\">Projects</li>");
}
?>
</ul>
