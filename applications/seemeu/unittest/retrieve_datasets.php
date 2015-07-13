<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/entityuniversity.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
$univemaildomain = "groupuniv.com";

// Retrieve the University information based on email domain
$rua = new RetrieveEntityUniversity();
$rua->byEmaildomain($univemaildomain);
?>