<?php
class PostComment extends Models{
    protected static $table="post_comment";
    
    public static function makeComment($rs){
        $comment=$rs['comment_text'];
        $rs=  array_map("security", $rs);
        
        $hashtags      = explode(",",$rs['hashtags']);
        $tagged_users  = explode(",",$rs['tagged_users']);
        
        if(!Users::isUser($rs['userid']) || !Posts::isPost($rs['post_id']))
            return array("status"=>"false",
                         "msg"   =>"invalid credentials");
        
        $comment_id=self::save(array("user_id"=>$rs['userid'],
                                     "post_id"=>$rs['post_id'],
                                     "comment"=>$comment,"dtdate"=>date('Y-m-d H:i:s',time())));
        
       
        TagUsers::addUserTags(
                $tagged_users,
                $comment_id,
                "comment"
                );
        HashTag::addHashTags(
                $hashtags,
                $comment_id,
                "comment"
                );
        $postuser=Posts::get("post_id='".$rs['post_id']."'","user_id")->user_id;
        ActivityLog::addLog(
                $comment_id,
                "COMMENTPOST",
                $rs['userid'],
                $postuser,
                $rs['post_id']
                );
//        PushNotification::commentPost($postuser,
//                                    $rs['post_id']);
//        PushNotification::mentionUser($rs['userid'],$tagged_users);
        return self::isNullArray(array("status"     => "true",
                                        "msg"       => "Comment added succesfully",
                                        "comments"  => self::allUserComments($rs['userid'],$rs['post_id'],
                                                $orderBy="order by pc.id ASC")));
        
    }
    
    public static function PostComments($rs){
        $rs=  array_map("security", $rs);
        $userid    =  (int)$rs['userid'];
        $postid    =  (int)$rs['post_id'];
        
        
        if(!Users::isUser($userid) || !Posts::isPost($postid))
            return array("status"=>"false","msg"=>"invalid credentials");
       
        return self::isNullArray(array("status"   => "true",
                                        "msg"     => "success",
                                        "comments"=> self::allUserComments($userid,$postid)));
    }

    public static function allUserComments(
			
            $userid,
            $postid,
            $orderBy="order by pc.id ASC",
            $limit=""
            ){
        if(!Posts::isPost($postid))
            return array("status"=>"false","msg"=>"invalid post id");
        $condBlock =  UserBlock::blockUserCond($userid);
        $condDeact =  Users::deactivateUserCond($userid);  
        $allComment=self::query("select pc.*,concat(u.fname,' ',u.lname) as full_name,u.user_name,u.user_thumbimage from "
                                . "post_comment as pc left join users as u on pc.user_id=u.userid "
                                . "where post_id='$postid' $condBlock  $condDeact $orderBy $limit");
        if($allComment->size()>0){
            while($row=$allComment->fetch()){
                $row['time_ago']           = Utility::getTimeAgo($row['dtdate']) ;//USER_CLASS::getTimeInfo($row['dtdate'], date('Y-m-d H:i:s'), 'x');
                $rows[]=$row;
            }
            return $rows;
        }
        else{
            return array();
        }
    }
  
}

