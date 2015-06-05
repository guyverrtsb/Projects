<?php

class PushNotification extends Models {

    public $live = false;
    
    
    function sendAlertMsg($device_tokens, $msg1, $dictionary = '', $type = '') {
      
        $passphrase = 'intel123';
        $message = $msg1;

        $ctx = stream_context_create();


        stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns-dev.pem');
        $apns_url = 'gateway.sandbox.push.apple.com';


        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        $fp = stream_socket_client('ssl://' . $apns_url . ':2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);


        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);
        foreach ($device_tokens as $device_token) {



            $body['aps'] = array(
                'alert' => $message,
                'dictionary' => $dictionary,
                'type' => $type,
                'sound' => 'default',
                'badge' => self::updateBedge($device_token->device_token)
            );

            // Encode the payload as JSON
            $payload = json_encode($body);
           
            $device_token = str_replace("", "", $device_token->device_token);
            $msg = chr(0) . pack('n', 32) . pack('H*', $device_token) . pack('n', strlen($payload)) . $payload;

            $result = fwrite($fp, $msg, strlen($msg));
            
        }


        fclose($fp);
    }

    function sendGcmNotify($reg_id, $message, $dictionary = '', $type = '') {
        $ttl = 86400;
        $randomNum = rand(10, 100);


        if (!is_array($reg_id)) {
            $fields = array(
                'registration_ids' => array($reg_id),
                'data' => array("message" => $message, 'dictionary' => $dictionary, 'type' => $type),
            );
        } else {
            $fields = array(
                'registration_ids' => $reg_id,
                'data' => array("message" => $message, 'dictionary' => $dictionary, 'type' => $type),
                'delay_while_idle' => false,
                'time_to_live' => $ttl,
                'collapse_key' => "" . $randomNum . ""
            );
        }


        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, GOOGLE_GCM_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Problem occurred: ' . curl_error($ch));
        }

        curl_close($ch);
        //echo $result;
    }
    function updateBedge($deviceId){
        $bedgecount=  UserDevices::get("device_token='$deviceId'","bedge")->bedge;
        UserDevices::save(array("bedge"=>$bedgecount+1),"device_token='$deviceId'");
       return $bedgecount+1;
    }
    
    function likePost($userid,$postid){
        if(NotificationSettings::userSetting($userid,"like")=="0"){
            return 1;
        }
        $activities=ActivityLog::getAll("main_id='$postid' and type='LIKEPOST' and notify_to='$userid'","activity_user");
        foreach($activities as $users){
            $allUsers.=$users->activity_user.",";
        }
       $allUsers=trim($allUsers,",");
       $users   = ActivityLog::notificationUsers($allUsers);
       $users   = $users['text'];
       $title   = Utility::stringWithDot(Posts::get("post_id='$postid'","title")->title);
       $msg     = $users." liked your post'$title'";
       $deviceinfo= UserDevices::getAll("user_id='$userid' and device_token!=''");
       $push= new PushNotification();
       $push->sendAlertMsg($deviceinfo, $msg, 'likepost');
     }
      function commentPost($userid,$postid){
          if(NotificationSettings::userSetting($userid,"comment")=="0"){
            return 1;
        }
        $activities=ActivityLog::getAll("main_id='$postid' and type='COMMENTPOST' and notify_to='$userid'","relative_id,activity_user,notify_to");
        foreach($activities as $users){
            $allUsers.=$users->activity_user.",";
            $relativeLastComment=$users->relative_id;
        }
       $allUsers=trim($allUsers,",");
       $users   = ActivityLog::notificationUsers($allUsers);
       $users   = $users['text'];
       $title   = Utility::stringWithDot(PostComment::get("id='$relativeLastComment'","comment")->comment);
       $msg     = $users." commented on your post'$title'";
       $deviceinfo= UserDevices::getAll("user_id='$userid' and device_token!=''");
       $push= new PushNotification();
       $push->sendAlertMsg($deviceinfo, $msg, 'commentpost');
    }
     function follow($userid,$otherid){
        if(NotificationSettings::userSetting($otherid,"follow")=="0"){
            return 1;
        }
       $otherUser=Users::userInfo($userid);
       $msg     = $otherUser->user_name." started following you.";
       $deviceinfo= UserDevices::getAll("user_id='$otherid' and device_token!=''");
       $push= new PushNotification();
       $push->sendAlertMsg($deviceinfo, $msg, 'follow');
    }
    function facebookJoin($userid,$otherid){
        if(NotificationSettings::userSetting($userid,"facebook_join")=="0"){
            return 1;
        }
       $User=Users::userInfo($userid);
       $otherUser=Users::userInfo($otherid);
       $msg     = "Your facebook friend ".$otherUser->user_name." is on lookagram as ".$otherUser->user_name." ";
       $deviceinfo= UserDevices::getAll("user_id='$userid' and device_token!=''");
       $push= new PushNotification();
       $push->sendAlertMsg($deviceinfo, $msg, 'follow');
    }
     function mentionUser($userid,$usersArray,$type="comment"){
         $usersArray=array_unique($usersArray);
         foreach($usersArray as $users){
            $haveConnections=0; 
            $taguser=Users::get("user_name='$users'",'userid');
           
            if($taguser>0){
              $haveConnections=Follow::count("(follow_from='$userid' and follow_to='$taguser->userid') or (follow_to='$userid' and follow_from='$taguser->userid')")->count;
            }
            if($haveConnections>0){
               if(NotificationSettings::userSetting($taguser->userid,"mention")){
         
                    $devices= UserDevices::getAll("user_id='$taguser->userid' and device_token!=''",'device_token');
                    foreach($devices as $device)
                        $allUsers[]=$device;
               }
            }
         } 
         
       $otherUser=Users::userInfo($userid);
       $msg     = $otherUser->user_name." mentioned you in a $type.";
       $deviceinfo=$allUsers;
       $push= new PushNotification();
       $push->sendAlertMsg($deviceinfo, $msg, 'mention');
     }  
       
    function privateMessageNotification($user_id, $frnd_id, $msg_id) {
        global $db;

        require_once '../services/ws-setting.php';
        require_once('notification_msg.php');

        $sql2 = "select * from private_msg where frnd_id = '" . $frnd_id . "' AND user_id = '" . $user_id . "' AND id = '" . $msg_id . "' ";

        $result2 = $db->query($sql2);
        $rs2 = $result2->fetch();


        $frndInfo = $this->getUserInfo($user_id);

        $userSetting = getSetting($frnd_id);

        $Activity_message = $userSetting['detail'][0]['Activity_message'];

        if ($Activity_message == 'yes') {
            if ($result2->size() > 0) {


                $frndname = $frndInfo['first_name'] . ' ' . $frndInfo['last_name'];

                $deviceinfo = $this->getUserDeviceids($frnd_id);
                $devicetype = $deviceinfo[0]['devicetype'];
                $deviceid = $deviceinfo[0]['deviceid'];



                $msg = PRIVATEMESSAGE . $frndname;

                if (strtoupper($devicetype) == "IOS")
                    $this->sendAlertMsg($deviceinfo, $msg, 'privateMessages');
                if (strtoupper($devicetype) == "ANDROID")
                    $this->sendGcmNotify($deviceid, $msg, 'privateMessages');
            }
        }
    }

}

?>