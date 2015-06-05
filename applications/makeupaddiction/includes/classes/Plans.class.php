<?php
class Plans extends Models{
    protected static $table="plans";
    
    
    function getPlans($rs){
        $rs=  array_map("security", $rs);
         $plans=[];
         $plans['video']=[];
         $plans['audio']=[];
         $activeVideoPlan=[];
         $activeAudioPlan=[];
         if(!Users::isUser($rs['userid']) )
            return array("status"=>"false","msg"=>"invalid credentials");
         
          $today=date("Y-m-d",time());
         $audioplanid=Subscriptions::get("user_id='".$rs['userid']."' and type='audio' and  DATE(end_on)>='$today'  order by id DESC","plan_id")->plan_id;
         $videoplanid=Subscriptions::get("user_id='".$rs['userid']."' and type='video' and  DATE(end_on)>='$today'  order by id DESC  ","plan_id")->plan_id;
            $plans['audio']=self::getAll("type='audio'");
             $plans['video']=self::getAll("type='video'");
//         if($audioplanid!=""){
////            $curPrice=   self::get("identifier='$audioplanid'","price")->price; 
//         
//         }
//         else{
//              $plans['audio']=self::getAll("type='audio'");
//         }
//         if($videoplanid!=""){
////            $curPrice=   self::get("identifier='$videoplanid'","price")->price; 
//            $plans['video']=self::getAll("type='video'");
//         }
//         else{
//             
//         }
         foreach($plans['video'] as $videoPlan){
            if($videoPlan->identifier==$videoplanid ){
                $activeVideoPlan[]    =$videoPlan;
                $videoPlan->status="ACTIVE";
                $plansNew['video'][]=$videoPlan;
            }
            else{
                $videoPlan->status="INACTIVE";
                $plansNew['video'][]=$videoPlan;
            }
         }
         foreach($plans['audio'] as $audioPlan){
            if($audioPlan->identifier==$audioplanid ){
                $activeAudioPlan[]    =$audioPlan;
                $audioPlan->status="ACTIVE";
                $plansNew['audio'][]=$audioPlan;
            }
            else{
                $audioPlan->status="INACTIVE";
                $plansNew['audio'][]=$audioPlan;
            }
         }
         return self::isNullArray(array("msg"=>"success",
             "status"=>"true",
             "plans"=>$plansNew,
             "active_plan"=>array("audio"=>$activeAudioPlan,"video"=>$activeVideoPlan)
         
             ));
         
    }
    
  
}

