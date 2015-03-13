<?php require_once("../../../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title>Test User Account</title>
<script>
</script>
</head>
<body>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/accesspoints/user.php"); ?>
<?php
$user = new User();
$return = $user->createUserInfo("sshellenberger@zealcon.com",
                    "shaggy",
                    "luv123",
                    "Stephen",
                    "Shellenberger",
                    "raleigh",
                    "REGION_NC",
                    "COUNTRIES_US");
?>
<div>
<?php printf("Here is the return info for the New Record:%s", $return); ?>
</div>
</body>
</html>