<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/wallpost.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/search_wallpost.php"); ?>

<?php
class Activation
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function wallpost($args)
    {
        zLog()->LogStart_AccessPointFunction("wallpost");
        
        
        /*
         * 1. Save Post to the Group Account Wall Post
         * 2. Save Post to the Search Wall Post table
         */

        if($args["posttype"] == "FIRSTPOST")
        {        
            $groupaccount_uid = $args["groupaccount_uid"];
            $usersafety_useraccount_uid = $args["usersafety_useraccount_uid"];
            $wallpost_header = $args["wallpost_header"];
            $wallpost_text = $args["wallpost_text"];
            $crossappl_mimes_uid = $args["crossappl_mimes_uid"];
            
            $cwp = new CreateWallPost();
            $cwp->firstPost($groupaccount_uid
                            , $usersafety_useraccount_uid
                            , $header
                            , $text
                            , $crossappl_mimes_uid);
                            
            $cswp = new CreateSearchWallPost();
            $cswp->createHeader($groupaccount_uid
                                , $cwp->getUid()
                                , $wallpost_header);
            $cswp->createText($groupaccount_uid
                            , $cwp->getUid()
                            , $wallpost_text);
            
        }
        else if($args["posttype"] == "REPLYPOST")
        {        
            $groupaccount_uid = $args["groupaccount_uid"];
            $usersafety_useraccount_uid = $args["usersafety_useraccount_uid"];
            $wallpost_text = $args["wallpost_text"];
            $referenced_wallpost_uid = $args["referenced_wallpost_uid"];
            
            $cwp = new CreateWallPost();
            $cwp->replyPost($groupaccount_uid
                            , $usersafety_useraccount_uid
                            , $text
                            , $referenced_wallpost_uid);
                            
            $cswp = new CreateSearchWallPost();
            $cswp->createComment($groupaccount_uid
                                , $cwp->getUid()
                                , $wallpost_text);
        }

        zLog()->LogEnd_AccessPointFunction("wallpost");
    }
}
?>