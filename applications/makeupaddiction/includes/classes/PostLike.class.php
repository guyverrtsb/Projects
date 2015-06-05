<?php
class PostLike extends Models{
    protected static $table="post_like";
    
    public static  function likeUsersList($rs){   
        $rs    =  array_map("security", $rs);
        $userid= (int)$rs['userid'];
        $postid= (int)$rs['post_id']; 
        $users = [];
        
        if(!Users::isUser($userid) || !Posts::isPost($postid))
            return array("status"=>"false","msg"=>"invalid credentials");
        $condBlock =  UserBlock::blockUserCond($userid);
        $condDeact =  Users::deactivateUserCond($userid);  
        $pager=Utility::makePager($rs['page'],self::count("post_id=$postid")->count);
        $allLikes=self::getAll("post_id=$postid  $condBlock $condDeact  limit $pager->lowerLimit,$pager->upperLimit",'user_id');
        foreach($allLikes as $like)
          $users[]=  Users::get("userid=$like->user_id ","userid,user_thumbimage,concat(fname,' ',lname) as full_name,user_name");
        
        return self::isNullArray(array("users"          => $users,
                                        "total_records" => $pager->total_records,
                                        "total_page"    => $pager->total_page,
                                        "status"        => "true",
                                        "msg"           => "success"));
        
    }
    
    public static  function like($rs){   
          $rs    =  array_map("security", $rs);
          $userid= (int)$rs['userid'];
          $postid= (int)$rs['post_id'];
          if(Users::count("userid=$userid")->count>0 && Posts::isPost($postid)){
              if($rs['status']=="1"){
                  if(self::count("user_id='$userid' and post_id='$postid'")->count<=0){
                       $insId= self::save(array("post_id"      => $postid,
                                         "user_id"      => $userid,
                                         "like_status"  => "1",
                                         "dtdate"       => date("Y-m-d H:i:s",time())));
                       $postuser=Posts::get("post_id='$postid'","user_id")->user_id;
                        ActivityLog::addLog($insId,
                                            "LIKEPOST",
                                            $userid,
                                            $postuser,$postid
                                            );
                                            PushNotification::likePost($postuser,$postid);
                  }
                 $arr= array("msg"          => "Vote added succesfully",
                            "status"        => "true",
                            "like_status"   => "1",
                            "total_votes"   => self::count("post_id=$postid")->count,
                            "is_vote"       => self::count("user_id=$userid")->count);
              }
              else{
                   $likeid=self::get("user_id=$userid and post_id=$postid","id")->id;
                   self::remove("user_id=$userid and post_id=$postid");
                   $arr= array("msg"            => "Vote removed succesfully",
                                "status"        => "true",
                                "like_status"   => "0",
                                "total_votes"   => self::count("post_id=$postid")->count,
                                "is_vote"       => self::count("user_id=$userid")->count);
                   ActivityLog::removeLog($likeid,"LIKEPOST",$userid);
              }
             
              return self::isNullArray($arr);
              
          }
          else{
             return array("msg"=>"invalid user id","status"=>"false");  
          }
          
      }
}

