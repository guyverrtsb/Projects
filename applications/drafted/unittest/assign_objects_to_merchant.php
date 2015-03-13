<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title>Test Gamer Account</title>
<script>
</script>
</head>
<body>
<?php zReqOnce("/_controls/classes/accesspoints/object.php"); ?>
<?php
$output = ""; $return = null;

$objson = '{
    "OBJECT_TYPE_HAZARD" :
    [
    { "sdesc":"SRM_D5_E5", "ldesc":"Short Range Mine", "nickname":"Little Sister", "icon":"srm_d5_e5", "detectionrange":"5", "effectiverange":"5"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_HAZARD_MINE", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"MRM_D10_E10", "ldesc":"Medium Range Mine", "nickname":"Middel Sister", "icon":"mrm_d10_e10", "detectionrange":"10", "effectiverange":"10"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_HAZARD_MINE", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"LRM_D15_E15", "ldesc":"Long Range Mine", "nickname":"Big Sister", "icon":"lrm_d15_e15", "detectionrange":"15", "effectiverange":"15"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_HAZARD_MINE", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"SSGMA_D10_E10", "ldesc":"Static Sentry Gun Motion Activated", "nickname":"Little Brother", "icon":"ssgma_d10_e10", "detectionrange":"10", "effectiverange":"10"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_HAZARD_SENTRYGUN", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"SSGHA_D15_E15", "ldesc":"Static Sentry Gun Heat Activated", "nickname":"Middle Brother", "icon":"ssgha_d15_e15", "detectionrange":"15", "effectiverange":"15"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_HAZARD_SENTRYGUN", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"SSGLA_D20_E20", "ldesc":"Static Sentry Gun Laser Activated", "nickname":"Big Brother", "icon":"ssgla_d15_e15", "detectionrange":"20", "effectiverange":"20"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_HAZARD_SENTRYGUN", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"DR_D60_E20", "ldesc":"Drone Recon", "nickname":"sparrow", "icon":"sparrow", "detectionrange":"60", "effectiverange":"20"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_HAZARD_DRONE", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    }
    ]
,
     "OBJECT_TYPE_SHIELD" :
    [
    { "sdesc":"STC_D50_E100", "ldesc":"Short Term Clone", "nickname":"twin", "icon":"twin", "detectionrange":"50", "effectiverange":"100"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_PLACE_CLONE", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"LTC_D100_E200", "ldesc":"Long Term Clone", "nickname":"qunit", "icon":"quint", "detectionrange":"100", "effectiverange":"200"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_PLACE_CLONE", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"MMD_D20_E10", "ldesc":"Medium Range Mine Detector", "nickname":"duster", "icon":"duster", "detectionrange":"20", "effectiverange":"10"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_SHIELD_DETECTOR", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"LMD_D300_E20", "ldesc":"Long Range Mine Detector", "nickname":"sweeper", "icon":"sweeper", "detectionrange":"30", "effectiverange":"20"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_SHIELD_DETECTOR", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    }
    ]
,
     "OBJECT_TYPE_PLACE" :
    [
    { "sdesc":"BAPTIST_CHURCH", "ldesc":"Baptist Church", "nickname":"Baptist Church", "icon":"baptistchurch", "detectionrange":"20", "effectiverange":"10"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_PLACE_WORSHIP", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"CATHOLIC_CHURCH", "ldesc":"Catholic Church", "nickname":"Catholic Church", "icon":"catholicchurch", "detectionrange":"20", "effectiverange":"10"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_PLACE_WORSHIP", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"JEWISH_TEMPLE", "ldesc":"Jewish Temple", "nickname":"Jewish Temple", "icon":"jewishtemple", "detectionrange":"20", "effectiverange":"10"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_PLACE_WORSHIP", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"MUSLIM_MOSQUE", "ldesc":"Muslim Mosque", "nickname":"Muslim Mosque", "icon":"muslimmosque", "detectionrange":"20", "effectiverange":"10"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_PLACE_WORSHIP", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    },
    { "sdesc":"ZEALCON_TULSA", "ldesc":"ZealCon Tulsa", "nickname":"ZealCon Tulsa", "icon":"zealcontulsa", "detectionrange":"20", "effectiverange":"10"
    , "configurations_sdesc_objecttype":"OBJECT_TYPE_PLACE_SANCTUARY", "configurations_sdesc_paymenttype":"PAYMENT_TYPES_FREE"
    , "merchantaccount_sdesc":"ZEALCONINC"
    }
    ]
}
';

$object = new Object();
$object->assignObjecttoMerchant($objson);
if($object->getSysReturnCode() == "COMPLETED_SUCCESSFULLY")
{
    $output = "Here is the return info for the New Record:".$object->getSysReturnCode();
    $return = $object;
}
else
{
    $output = "Here is the return info for the New Record:".$object->getSysReturnCode();
    $return = $object;
}
?>
<div>
<?php printf($output); ?>
<hr>
<?php printf("JSON:%s:", $return->getSysReturnAryJSON()); ?>
</div>
</body>
</html>