<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title>Test Gamer Account</title>
<script>
</script>
</head>
<body>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/accesspoints/user.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/merchant.php"); ?>
<?php
$output = ""; $return = null;
$user = new User();
$user->retrieveUserAccount("sshellenberger@zealcon.com");
if($user->getSysReturnCode() == "USER_ACCOUNT_IS_FOUND")
{
    $merchant = new Merchant();
    $merchant->createMerchantInfo($user->getOutputData("useraccount_uid"),
                                "ZEALCON_INC",
                                "ZealCon Incorporated",
                                "Headquarters",
                                "admin@zealcon.com",
                                "427 S. Boston Ave",
                                "Suite 103",
                                "Attn:Princess Brown",
                                "tulsa",
                                "REGION_NC",
                                "COUNTRY_US",
                                "+1",
                                "918",
                                "935",
                                "3486",
                                "MERCHANT_ROLE_HQ");

    $output = "Here is the return info for the New Record:".$merchant->getSysReturnCode();
    $return = $merchant;
}
else
{
    $output = "Here is the return info for the New Record:".$user->getSysReturnCode();
    $return = $user;
}
?>
<div>
<?php printf($output); ?>
<hr>
<?php printf("JSON:%s:", $return->getSysReturnAryJSON()); ?>
</div>
</body>
</html>