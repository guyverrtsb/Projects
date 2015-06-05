<?php
class ActivityLog extends Models{
    protected static $table="activity_log";
    
    public function addLog($relative_id,$type,$userid,$notify_to="FOLLOWERS",$main_id="0"){
       if(self::count("relative_id='$relative_id' and type='$type' and activity_user='$userid'")->count<=0){
        $data= array("relative_id"  => $relative_id,
                    "type"          => $type,
                    "main_id"       => $main_id,
                    "activity_user" => $userid,
                    "notify_to"     => $notify_to);
       $data['dtdate']=date("Y-m-d H:i:s",time());
       self::save($data);
       }
       else{
           $dataWh= "relative_id  ='$relative_id' and
                    type          = '$type' and
                    main_id       = '$main_id' and
                    activity_user = '$userid' and
                    notify_to     = '$notify_to'";
       $data['dtdate']=date("Y-m-d H:i:s",time());
       self::save($data,$dataWh);
       }
    }
    
    public function createMessage($notification,$userid){
                
                $notifyTo                   = Users::userInfo($notification->notify_to);
                $you                        = $notification->type=="LIKEPOST" || $notification->type=="COMMENTPOST"  ?"your" : "you";
            
                $notificationUsers          = self::notificationUsers($notification->all_users);
                $notification->users        = $notification->all_users;
                $notification->all_users    = $notificationUsers['allusers'];
                
                if(count($notificationUsers['allusers'])<=1){
                    if($notification->notify_to==$notificationUsers['allusers'][0]['userid'])
                        $on_user="own";
                    else
                         $on_user=$notifyTo->user_name;
                }
                else{
                        $on_user=$notifyTo->user_name;
                }
                
                
                if($userid ==$notification->notify_to){
                    $notification->on_user = $you;
                }
                else{
                    $notification->on_user = $on_user;
                    array_push($notification->all_users,(array)$notifyTo);
                }
             
                $notification->message      = $notificationUsers['text'];
                $notification->time_ago     = Utility::getTimeAgo($notification->dtdate);
                return $notification;
    }
    
    public function notificationUsers($users) {

        $users    = explode(",", $users);
        $notUsers = array();
        $allusers = array();
        $counter  = 0;
        if (count($users) > 0) {
            foreach ($users as $userid) {
                if (!in_array($userid, $allusers)) {
                    $allusers[]                   = $userid;
                    $notUsers[$counter]['userid'] = $userid;
                    $notUsers[$counter]           = (array)Users::userInfo($userid);
                     if (count($allusers) == 1)
                        $rs .= $notUsers[$counter]['user_name'];
                    else if (count($allusers) == 2)
                        $rs.= " and " .  $notUsers[$counter]['user_name'];
                    else {
                        $rs     = str_replace(" and ", ", ", $rs);
                        $others = (count($allusers) - 2);
                        $rs1    = $others > 1 ? " and $others others" : " and $others other";
                        $notUsers[$counter]['full_name'] = str_replace(" and ", "", $rs1);
                    }
                    $counter++;
                }
            }
	    $rs = $rs;
            $rs = str_replace("And", "and", $rs);
            $rs = $rs . $rs1;
        }
        return array("text" => $rs, "allusers" => $notUsers);
    }
    
    public function notificationData($allNotifications,$userid){
        $newNotification=[];
        foreach($allNotifications as $notification){
             $notification               = self::createMessage($notification,$userid);
             if($notification->type=="FOLLOW"){
                
                $notification->message      = "$notification->message started following $notification->on_user.";
             }
             elseif($notification->type=="UNFOLLOW"){
                $notification->message      = "$notification->message stopped following $notification->on_user.";
             }
              elseif($notification->type=="FACEBOOKJOIN"){
                $notification->message      = "Your facebook friend $notification->message is on lookagram as $notification->message.";
             }
             elseif($notification->type=="LIKEPOST"){
                $post_id                    = PostLike::get("id='$notification->relative_id'","post_id")->post_id; 
                $postsDet                   = Posts::get("post_id='$post_id'","post_id,thumb_image,title,data_url,data_type");
                $postsDetCount              = count($postsDet);
                $notification->post_detail  = (object)( $postsDet);
                
                $notification->message      = "$notification->message liked $notification->on_user post:'". ($notification->post_detail->title)."'";
                }
             elseif($notification->type=="COMMENTPOST"){
                 
                $comment                    = PostComment::get("id='$notification->relative_id'","post_id,comment");
                $postsDet                   = Posts::get("post_id='$comment->post_id'","post_id,thumb_image,title,data_url,data_type");
                $postsDetCount              = count($postsDet);
                $notification->post_detail  = (object)( $postsDet);
                $notification->post_detail  = $postsDetCount==0 ? new stdClass() : $postsDet;
                $notification->message      = "$notification->message commented on $notification->on_user post:'".($comment->comment)."'";
               }
               $newNotification[]=$notification;
         }
        return $newNotification;
    }
    
    public function myNotifications($rs){
     
        $rs        =  array_map("security", $rs);
        $userid    =  (int)$rs['userid'];
        $pageSize  =  15;
        $page      =  (int)$rs['page']==0 ? 1 : (int)$rs['page'];
        $pageLower =  ($page-1)*$pageSize;
        $pageUpper =  $pageSize;
         if(!Users::isUser($userid)){
            return array("msg"=>"invalid user id","status"=>"false");
         }
         $deactCond=Users::deactivateUserCond($userid, "activity_user");
         $blockCond=UserBlock::blockUserCond($userid, "activity_user");
         
         $allNotificationsCount     =  self::count("notify_to='$userid' and activity_user!='$userid' $deactCond $blockCond",
                                        "COUNT(DISTINCT main_id,type) as  count")->count;
        
         $total_page=ceil($allNotificationsCount/$pageSize);
         
         $allNotifications=self::getall("notify_to='$userid' and activity_user!='$userid' $deactCond $blockCond group by main_id,type order by dtdate DESC limit $pageLower,$pageUpper ",
                 "activity_log.*,MAX(dtdate) as  dtdate,group_concat(activity_user) as all_users ");
         
         $allNotifications=self::notificationData($allNotifications,$userid);
    
         return (array("status"                     => "true",
                        "msg"                       => "success",
                        "notifications"             => $allNotifications,
                        "total_current_record"      => count($allNotifications),
                        "total_page"                => $total_page,
                        "notification_total_record" => $allNotificationsCount
           ));
        
    }
    
    public function followersNotifications($rs){
         
        $rs        =  array_map("security", $rs);
        $userid    =  (int)$rs['userid'];
        $pageSize  =  15;
        $page      =  (int)$rs['page']==0 ? 1 : (int)$rs['page'];
        $pageLower =  ($page-1)*$pageSize;
        $pageUpper =  $pageSize;
         if(!Users::isUser($userid)){
            return array("msg"=>"invalid user id","status"=>"false");
         }
         $deactCond=Users::deactivateUserCond($userid, "notify_to");
         $blockCond=UserBlock::blockUserCond($userid, "notify_to");
          $allNotificationsCount     =  self::count("activity_user in "
                 . "(select follow_to from user_follow where follow_from='$userid' and confirmed='1') "
                 . "and type!='COMMENTPOST' and activity_user!='$userid'"
                  . " and notify_to!='$userid' and notify_to!=activity_user and "
                  . "dtdate>(select dtdate from user_follow where follow_to=activity_user and follow_from='$userid' ) $deactCond $blockCond",
                                        "COUNT(DISTINCT main_id,type) as  count")->count;
         $total_page=ceil($allNotificationsCount/$pageSize);
          
         $allNotifications=self::getall("activity_user in "
                 . "(select follow_to from user_follow where follow_from='$userid' and confirmed='1') "
                 . "and type!='COMMENTPOST' and notify_to!='$userid' and notify_to!=activity_user"
                 . " and dtdate>(select dtdate from user_follow where follow_to=activity_user and follow_from='$userid' ) $deactCond $blockCond"
                 . " group by main_id,type order by dtdate DESC limit $pageLower,$pageUpper",
                 "activity_log.*,group_concat(activity_user) as all_users ");
       
         $allNotifications=self::notificationData($allNotifications,$userid);
        return (array("status"                  => "true",
                        "msg"                   => "success",
                        "notifications"         => $allNotifications,
                        "total_current_record"  => count($allNotifications),
                        "total_page"            => $total_page,
                     "notification_total_record"=> $allNotificationsCount
           ));
          
        
    }
    
    public function removeLog($relative_id,$type,$userid){
        self::remove("relative_id='$relative_id' and  type='$type' and activity_user='$userid'");
    }
   
}

