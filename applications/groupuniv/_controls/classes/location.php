<?php
/** Global Variables **/
global $global_group_account_uid;
/** Group Account Checker **/
if(isset($_SESSION["UNIV_MEET_GROUP_ACCOUNT_UID"]))
{
    $global_group_account_uid = $_SESSION["UNIV_MEET_GROUP_ACCOUNT_UID"];
}
else
{
    header("Location: /siteuser/s_user_acocunt.php");	
}
?>