<?php require_once("../../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title>Test User Account</title>
<script>
</script>
</head>
<body>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/useraccount.php"); ?>
<?php
$cua = new CreateUserAccount();
$cua->basic("soliver@zealcon.com",
            "snoopy",
            "luv123");
?>
<div>
<?php printf("Here is the UID for the New Record:%s", $cua->getUid()); ?>
</div>
</body>
</html>