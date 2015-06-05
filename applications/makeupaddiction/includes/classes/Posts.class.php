<?php
class Posts extends Models{
    protected static $table="post";
    
     public static function relation($rs){
       
          return array("PostLike"   => "post_id",
                       "PostComment"=> "post_id",
                       "PostReport" => "post_id",
                      );
          
      }    
      
     public static function deletePost($rs){
         $rs=  array_map("security", $rs);
         
         if(!Users::isUser($rs['userid']) || !Posts::isPost($rs['post_id']))
            return array("status"=>"false","msg"=>"invalid credentials");
         
         if(self::postUser($rs['post_id'])!=$rs['userid'])
            return array("status"=>"false","msg"=>"you don't have permission to delete another member post");
        
         foreach(self::relation() as $relationTbl=>$relationClm)
              $relationTbl::remove("$relationClm=".$rs['post_id']);
         
          ActivityLog::remove("main_id = '" . $rs['post_id'] . "' and (type='COMMENTPOST' or type='LIKEPOST')");
         HashTag::remove("relative_id = '" . $rs['post_id'] . "' and type='post'");
         self::remove("post_id='".$rs['post_id']."'");
               
        return array("status"=>"true","msg"=>"Post deleted succesfully");
         
     }
     
     public static function postByHash($rs){
        $rs             =  array_map("security", $rs);
        $hashtag        = $rs['hashtag']; 
        $hashPostsData  = []; 
        $userid         = $rs['userid'];
        
        if(!Users::isUser($rs['userid']))
            return array("status"=>"false","msg"=>"invalid user");
        $condIsPrivate =  Users::isPrivateCond($userid);
        $condBlock =  UserBlock::blockUserCond($userid);
        $condDeact =  Users::deactivateUserCond($userid);  
        $hashPosts=self::query("select p.post_id,p.user_id,p.data_type,p.data_url,p.thumb_image"
                . " FROM `hashtags` as hash left join post as p on hash.relative_id=p.post_id  and p.suspend='0' where  hash.tag='$hashtag' and hash.type='post' $condBlock $condDeact $condIsPrivate");
        
        if( $hashPosts->size()>0){
            while($row=$hashPosts->fetch()){
                $hashPostsData[]=$row;
            }
        }
               
        return self::isNullArray(array( "total_data"=> count($hashPostsData),
                                      "hash_posts"  => $hashPostsData,
                                      "status"      => "true",
                                       "msg"        => "success"
                                        )); 
         
     }
     
     public static function popularPosts($rs){
        $rs             =  array_map("security", $rs);
        $popularPostsData= []; 
        $page           =  (int)$rs['page']==0 ? 1 :(int)$rs['page'];
        $pageLower      =  ($page-1)*15;
        $pageUpper      =  15;
        
        if(!Users::isUser($rs['userid']))
            return array("status"=>"false","msg"=>"invalid credentials");
        
        $condIsPrivate =  Users::isPrivateCond($rs['userid']);
        $condBlock =  UserBlock::blockUserCond($rs['userid']);
        $condDeact =  Users::deactivateUserCond($rs['userid']); 
        $postcount =  self::count("suspend='0'  $condBlock $condDeact $condIsPrivate")->count;
        $total_page=  ceil($postcount/15);
        
        $popularPosts=self::query("select p.post_id,p.user_id,p.data_type,p.data_url,p.thumb_image,"
                . "(select sum(like_status) from post_like as pl where pl.post_id=p.post_id ) as like_count,"
                . "(select count(id) from post_comment as pc where pc.post_id=p.post_id ) as commment_count"
                . " FROM `post` as p where suspend='0'  $condBlock  $condDeact $condIsPrivate  order by if(like_count IS NULL,0,like_count) + if(commment_count IS NULL,0,commment_count) DESC  limit $pageLower,$pageUpper  ");
        
        if( $popularPosts->size()>0){
            while($row=$popularPosts->fetch()){
                  $row['title'] =  ($row['title']) ;
                $popularPostsData[]=$row;
            }
        }
               
        return self::isNullArray(array( "total_data" => count($popularPostsData),
                                      "Popular_posts"=> $popularPostsData,
                                      "total_page"   => $total_page,
                                      "total_records"=> $postcount,
                                      "status"       => "true",
                                      "msg"          => "success"
                                        )); 
         
     }
     
     public function userPostdata($id){ 
      
      $friendid         = $id;
      $UserImageVideo   = [];
      $UserImagePost    = [];
         if(!Users::isUser($friendid))
            return array("status"=>"false","msg"=>"invalid credentials");
         
     $UserPosts =  Posts::getAll("user_id='$friendid' and  suspend='0' order by dtdate ","post_id,user_id,data_type,data_url,thumb_image");
     foreach($UserPosts as $post){
         if($post->data_type=="audio")
             $UserImagePost[]=$post;
         else
             $UserImageVideo[]=$post;
         
     }
      return self::isNullArray(array( "total_image_data"=> count($UserImagePost),
                                      "total_video_data"=> count($UserImageVideo),
                                      "image_data"      => $UserImagePost,
                                      "video_data"      => $UserImageVideo
                                        )); 
     
    }
    
     public static function getPost($rs){
        $rs        =  array_map("security", $rs);
        $userid    =  (int)$rs['userid'];
        $postid    =  (int)$rs['post_id'];
        
         $condIsPrivate = Users::isPrivateCond($userid);
         $condBlock     = UserBlock::blockUserCond($userid);
         $condDeact     = Users::deactivateUserCond($userid);
         
        if(!Users::isUser($userid) || !Posts::isPost($postid))
            return array("status"=>"false","msg"=>"invalid credentials");
                
                $post                     =  self::get("post_id=$postid  $condBlock $condDeact");
                $post->title              =  ($post->title) ;
                $post->post_total_like    = PostLike::count("post_id='$post->post_id'  $condDeact $condBlock")->count;
                $post->post_total_comment = PostComment::count("post_id='$post->post_id' $condDeact $condBlock")->count;
                $post->is_post_liked      = PostLike::count("post_id='$post->post_id' and user_id='$userid'")->count;
                $userDetail               = Users::get("userid='$post->user_id'","user_thumbimage,user_name,concat(fname,' ',lname) as full_name");
                $post->user_image         = $userDetail->user_thumbimage;
                $post->user_name          = $userDetail->user_name;
                $post->full_name          = $userDetail->full_name;
                $post->time_ago           = Utility::getTimeAgo($post->dtdate);
                $post->block_relation    = UserBlock::count("(user_id='$post->user_id' and block_user_id='$userid') or "
                        . "(block_user_id='$post->user_id' and user_id='$userid') ")->count;
                $post->last_three_comments= PostComment::allUserComments($userid,$post->post_id,"order by pc.id DESC",'limit 3');
                $arr       =  array('status'=> "true",
                                    "posts" => $post,
                                );
                return self::isNullArray($arr);
     }
     
     public static function homePosts($rs){
        header('Content-Type: application/json');
        $rs             =  array_map("security", $rs);
        $userid         =  (int)$rs['userid'];
        $page           =  (int)$rs['page'];
        $pageLower      =  ($page-1)*15;
        $pageUpper      =  15;
        
        if(!Users::isUser($rs['userid']))
            return array("status"=>"false","msg"=>"invalid user id");
                $Connections= Follow::userConnectionList($userid);
                $condIsPrivate =  Users::isPrivateCond($userid);
                $condBlock =  UserBlock::blockUserCond($userid);
                $condDeact =  Users::deactivateUserCond($userid);
                $postcount =  self::count("suspend='0' and user_id in($Connections) $condBlock $condDeact $condIsPrivate")->count;
                $total_page=  ceil($postcount/15);
                $posts     =  self::getAll("suspend='0' and user_id  in($Connections)  $condBlock  $condDeact $condIsPrivate order by dtdate DESC limit $pageLower,$pageUpper ");
                
                foreach($posts as $post){
                   
                    $post->post_total_like    = PostLike::count("post_id=$post->post_id $condDeact $condBlock")->count;
                    $post->post_total_comment = PostComment::count("post_id='$post->post_id' $condDeact $condBlock")->count;
                    $post->is_post_liked      = PostLike::count("post_id=$post->post_id and user_id='$userid'")->count;
                    $userDetail               = Users::get("userid='$post->user_id'","user_thumbimage,user_name,concat(fname,' ',lname) as full_name");
                    $post->user_image         = $userDetail->user_thumbimage;
                    $post->user_name          = $userDetail->user_name;
                    $post->full_name          = $userDetail->full_name;
                    $post->last_three_comments= PostComment::allUserComments($userid,$post->post_id,"order by pc.id DESC",'limit 3');
                    $post->time_ago           = USER_CLASS::getTimeInfo($post->dtdate, date('Y-m-d H:i:s'), 'x');
                    
                }
                $arr       =  array('status'        => "true",
                                    "posts"         => $posts,
                                    "total_page"    => $total_page,
                                    "total_records" => $postcount);
                return self::isNullArray($arr);
     }

     public static function uploadPostData($files,
             $userid,
             $post_id){
                if($files['name']!=""){
                $isCreatedPost=createDir("../uploads/posts");
		$isCreatedPostid=createDir("../uploads/posts/$userid");
                $isCreatedPostFld=createDir("../uploads/posts/$userid/$post_id");

                if($isCreatedPost && $isCreatedPostid && $isCreatedPostFld ){
                   
                    $file_name	=	randomcode(5).time().str_replace(array(" ","'","\'","_"),"",$files['name']); 
                    move_uploaded_file($files['tmp_name'], "../uploads/posts/$userid/$post_id/$file_name");
                    self::save(array("data_url"=>"uploads/posts/$userid/$post_id/$file_name"),"post_id=$post_id");
                    return true;
                }
                else{
                    return false;
                }
                }
                return true;
		
     }
     public static function uploadPostImage($files,$userid,$post_id){
                $isCreatedPost=createDir("../uploads/posts");
		$isCreatedPostid=createDir("../uploads/posts/$userid");
                $isCreatedPostFld=createDir("../uploads/posts/$userid/$post_id");

                if($isCreatedPost && $isCreatedPostid && $isCreatedPostFld ){
                    $file_name	=	randomcode(5).time().str_replace(array(" ","'","\'","_"),"",$files['name']); 
                    $IMAGE = new UPLOAD_IMAGE();
	            $IMAGE->init($files['tmp_name']);
		    move_uploaded_file($files['tmp_name'], "../uploads/posts/$userid/$post_id/$file_name");
                    $file_namethumb=  explode(".", $file_name);
                    $file_nameExt=  end($file_namethumb);
                    $file_namethumb=$file_namethumb[0]."-thumb".".$file_nameExt";
                    $IMAGE->resizeImage(200, 200, 'crop');
                    $IMAGE->saveImage( "../uploads/posts/$userid/$post_id/$file_namethumb", 100);
		
                    self::save(array("image"=>"uploads/posts/$userid/$post_id/$file_name",
                        "thumb_image"=>"uploads/posts/$userid/$post_id/$file_namethumb"),"post_id=$post_id");
                    return true;
                }
                else{
                    return false;
                }
		
     }
     
     public static function addPost($rs){ 
         $title         = $rs['title'];
         $rs            = array_map("security", $rs);
         $userid        = $rs['userid'];
         $type          = $rs['data_type'];
         
       
         $hashtags      = explode(",",$rs['hashtags']);
         $tagged_users  = explode(",",$rs['tagged_users']);
         $data          = $_FILES['data'];
         $image         = $_FILES['image'];
         $msg           = "Post addedd succesfully";
         if(!Users::isUser($rs['userid']))
            return array("status"=>"false","msg"=>"invalid user id");
         
         if($type=="audio"){
          if(isset($data['name'])&& $data['name']!=""){
             $extenstionArr=explode(".",$data['name']);
             $extenstion=end($extenstionArr);
             if($extenstion=="m4a"  || $extenstion=="mp3"){
                
             }
             else{
                  return array("status"=> "false",
                              "msg"   => "Please provide valid file format(only m4a for audio)");
             }
             
          }
         }
         else if($type=="video"){
                $extenstionArr=explode(".",$data['name']);
                $extenstion=end($extenstionArr);
                if($extenstion!="mp4"){
                    return array("status"=> "false",
                                 "msg"   => "Please provide valid file format(only mp4 for video)");
                }
         }
         $post_id=self::save(array("title"      => $title,
                                    "data_type" => $type,
                                    "user_id"   => $userid,
                                    "dtdate"    => date("Y-m-d H:i:s",time())));
         TagUsers::addUserTags($tagged_users,$post_id);
         HashTag::addHashTags($hashtags,$post_id);
         PushNotification::mentionUser($rs['userid'],$tagged_users,"post");
         if(!self::uploadPostData($data, $userid, $post_id)){
              $msg="Post added succesfully but media not uploaded";
         }
        
         if(!self::uploadPostImage($image, $userid, $post_id)){
             $msg="Post added succesfully but media image not uploaded";
         }
         
         $postdetail=self::get("post_id=$post_id","data_type,data_url,image");
         
         return self::isNullArray(array("status"    => "true",
                                        "msg"       => $msg,
                                        "post_id"   => $post_id,
                                        "type"      => $postdetail->data_type,
                                        "image"     => $postdetail->image,
                                        "data_url"  => $postdetail->data_url));
         
         
         
     }
    
     public static function isPost($postid){
         return (int)$postid>0 && self::count("post_id=$postid")->count>0 ? true : false;
     }
     
     public static function postUser($postid){
        if((int)$postid>0)
        return self::get("post_id=$postid","user_id")->user_id;
        else
        return 0;    
     }
     
}

