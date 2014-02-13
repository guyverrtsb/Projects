<li class="menuheader">Links</li>
<li><a class="menulink" href="s_admin_account.php">My Account</a></li>
<?php gdreqonce("/_controls/classes/find/university.php");
$zfu = new zFindUniversity();
$zfu->findAllUniversitiesAccountsandProfiles();
?>
<li id="CBUniversityList">
<li class="menuheader">Universities</li>
<li><a class="menulink" href="/siteadmin/s_create_university.php">Create</a></li>
<?php
if($zfu->getResults_AllAccountsandProfiles() != "NO_RECORDS")
{
    foreach ($zfu->getResults_AllAccountsandProfiles() as $row)
    {
        $zfu->setResult_AccountandProfile($row);
        printf("<li><a class=\"menulink\" href=\"/s_groups/s_index.php?ga_uid=a\">%s</a></li>", $zfu->getEmailkey());
    }
}
?>