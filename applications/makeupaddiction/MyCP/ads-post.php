<?php
$PageTitle = "Ad Post";
include('header.php');
if(empty($_SESSION['temuser'])){
	$ranStr = md5(microtime());
	$_SESSION['temuser'] = substr($ranStr, 0, 6);
}

if(isset($_POST['submitad'])){
	
	if(!is_dir("adphoto/"))
	 	 mkdir("adphoto",0777);
	
	if(!is_dir("advideo/"))
	 	 mkdir("advideo",0777);	 
		 
	$path	=	'adphoto';
	$path1	=	'adphoto';
	
	$vpath	=	'advideo';
	$vpath1	=	'advideo';

	$str = true;
	$memberid	=	intval($_POST['userid']);
	$adtitle	=	security(trim($_POST['adtitle']));
	$adtext		=	security(trim($_POST['adtext']));
	$callaction	=	security(trim($_POST['callaction']));
	$callactlink=	security(trim($_POST['callactionlink']));
	$location 	=	security(trim($_POST['location']));
	$zipcode	=	security(trim($_POST['zipcode']));
	$nationality=	security(trim($_POST['nationality']));
	$languages	=	security(trim($_POST['languages']));
	$hobbies	=	security(trim($_POST['hobbies']));
	$agefrom	=	trim($_POST['from']);
	$ageto		=	trim($_POST['to']);
	$gender		=	trim($_POST['gender']);
	$status		=	trim($_POST['status']);
	$scstart	=	trim($_POST['start']);
	$scuntil	=	trim($_POST['until']);
	$numbercode	=	trim($_POST['numbercode']);
	$phonenumber=	security(trim($_POST['phonenumber']));
	$email		= security(trim($_POST['email']));
	$toLB		=	$_POST['ToLB'];
	$allNac	=	$_POST['ToNA'];
	$allLangc	=	$_POST['ToLANG'];
	$allHobbyc	=	$_POST['ToHOBBY'];
	
	if($memberid == ''){
		$_SESSION['errormsg']	=	'Please select verify member.<br>';
		$str = false;	
	}
	if($adtitle == ''){
		$_SESSION['errormsg']	=	'Please enter ad title.<br>';
		$str = false;	
	}
	if($adtext == ''){
		$_SESSION['errormsg']	=	'Please enter ad text.<br>';
		$str = false;	
	}
	if($callaction == ''){
		$_SESSION['errormsg']	=	'Please select action button';
		$str = false;	
	}
	if($callactlink == ''){
		$_SESSION['errormsg']	=	'Please enter action link.<br>';
		$str = false;	
	}
	if($location == ''){
		$_SESSION['errormsg']	=	'Please select location.<br>';
		$str = false;	
	}
	if($zipcode == ''){
		$_SESSION['errormsg']	=	'Please enter zip code.<br>';
		$str = false;	
	}
	if($toLB == ''){
		$_SESSION['errormsg']	.=	"Please select metro area.<br>";
		$str =	false;
	}
	if($nationality == ''){
		$_SESSION['errormsg']	=	'Please select nationality.<br>';
		$str = false;	
	}
	if($nationality == '1' && $allNac == ''){
		
		$_SESSION['errormsg']	.=	"Please select nationality area.<br>";
		$str =	false;
		
	}elseif($nationality == '1'){
		
		$allNa	=	$_POST['ToNA'];
	}
	
	if($languages == ''){
		$_SESSION['errormsg']	=	'Please select languages.<br>';
		$str = false;	
	}
	
	if($languages == '1' && $allLangc == ''){
		
		$_SESSION['errormsg']	.=	"Please select languages area.<br>";
		$str =	false;
		
	}elseif($languages == '1'){
		
		$allLang	=	$_POST['ToLANG'];
		
	}
	if($hobbies == ''){
		
		$_SESSION['errormsg']	.=	"Please select hobbies.<br>";
		$str =	false;
	}
	if($hobbies == '1' && $allHobbyc == ''){
		
		$_SESSION['errormsg']	.=	"Please select hobbies area.<br>";
		$str =	false;

	}elseif($hobbies == '1'){
		
		$allHobby	=	$_POST['ToHOBBY'];
	}
	if($agefrom == ''){
		$_SESSION['errormsg']	=	'Please select age from.<br>';
		$str = false;	
	}
	if($ageto == ''){
		$_SESSION['errormsg']	=	'Please select age to.<br>';
		$str = false;	
	}
	if($gender == ''){
		$_SESSION['errormsg']	=	'Please select genderv';
		$str = false;	
	}
	if($status == ''){
		$_SESSION['errormsg']	=	'Please select status.<br>';
		$str = false;	
	}
	if($scstart == ''){
		$_SESSION['errormsg']	=	'Please enter schedules start date.<br>';
		$str = false;	
	}
	if($scuntil == ''){
		$_SESSION['errormsg']	=	'Please enter schedules until date.<br>';
		$str = false;	
	}
	if($phonenumber == ''){
		$_SESSION['errormsg']	=	'Please enter phone number.<br>';
		$str = false;	
	}
	if($email == ''){
		$_SESSION['errormsg']	=	'Please enter email.<br>';
		$str = false;	
	}elseif(is_email_address($email)==false)
	{
		/*	valid email check	*/
					
		$_SESSION['errormsg']	.=	"Please enter valid email.<br>";
		$str =	false;
					
	}
	$cat_image = $_FILES['mainimage']['type'];
	$video = $_FILES['video']['type'];
	
	if($cat_image == '' && $video == ''){
		$_SESSION["errormsg"] .= "Please select ad image or video.<br>";
        $str = false;
	}
	
	if($cat_image != ''){
    if ($cat_image == 'image/jpeg' || $cat_image == 'image/gif' || $cat_image == 'image/png') {
            $random = rand(0000,9999);
            $certimg = $_FILES['mainimage']['tmp_name'];
            $certimg_name = $_FILES["mainimage"]["name"];
            $ext = strtolower(pathinfo($certimg_name, PATHINFO_EXTENSION));
            $picname = strtolower(str_replace(array(' ', "'", '"'), '-', $random . "." . $ext));

            $certori = $path1.'/'.$picname;
            move_uploaded_file($_FILES["mainimage"]["tmp_name"], $path.'/'.$picname);
			$adimage .= ", ad_image   =   '" . $certori . "' ";

    } else {
        if ($cat_image != '') {
            $_SESSION["errormsg"] .= "Image type not allowed.<br>";
            $str = false;
        }
    }}
	
	
	if($video != ''){
		
    if ($video == 'video/wmv' || $video == 'video/mp4' || $video == 'video/avi' || $video == 'video/MP4') {
            $random = rand(0000,9999);
            $certvie = $_FILES['video']['tmp_name'];
            $certvie_name = $_FILES["video"]["name"];
            $ext = strtolower(pathinfo($certvie_name, PATHINFO_EXTENSION));
            $videoname = strtolower(str_replace(array(' ', "'", '"'), '-', $random . "." . $ext));

            $certvie = $vpath1.'/'.$videoname;
            move_uploaded_file($_FILES["video"]["tmp_name"], $vpath.'/'.$videoname);
			$advideo .= ", ad_video   =   '" . $certvie . "' ";

    } else {
        if ($video != '') {
            $_SESSION["errormsg"] .= "Sorry, only wmv, mp4 & avi files are allowed.<br>";
            $str = false;
        }
    }
	}
	
	if($str==true){
	$sql = "INSERT INTO ad_post SET member_id = ".$memberid.", ad_title = '".$adtitle."', ad_text = '".$adtext."', ".
			" call_action = '".$callaction."', call_action_link = '".$callactlink."' ".$adimage." ".$advideo.", ".
			" ad_location =	'".$location."', ad_zip = '".$zipcode."', ad_ethnicity = '".$nationality."', ".
			" ad_languages = '".$languages."', ad_hobbies = '".$hobbies."', ad_agerangefrom = '".$agefrom."', ".
			" ad_agerangeto = '".$ageto."', ad_gender = '".$gender."', ad_status = '".$status."', ".
			" ad_startdate = '".$scstart."', ad_enddate = '".$scuntil."', area_code = '".$numbercode."', ".
			" phone = '".$phonenumber."', email = '".$email."', dtdate = NOW()";
	
	$result = $db->query($sql);		
	
	$lastID	= $result->insertID();
		
	
	$sqlTemp	=	"SELECT * FROM temp_images WHERE user_id = '".$_SESSION['temuser']."' ORDER BY id DESC";
	
	$resultTemp	=  $db->query($sqlTemp);
		while($rows = $resultTemp->fetch())
		{
			
			$file = base_path."ajax/".$rows['image'];
			
			$fullimage	=	str_replace("temp/","",$rows['image']);

			copy($file, $path.'/'.$fullimage);

			unlink($file);

			$sql = "INSERT INTO ad_post_image(ad_post_id,image)VALUES('".$lastID."','".$path1.'/'.$fullimage."')";
			$result = $db->query($sql);	
		}
		
		foreach($toLB as $i => $metro_area){
			
			$sql = "INSERT INTO ad_post_metro(ad_id,metro_area)VALUES('".$lastID."','".$metro_area."')";
			$result = $db->query($sql);
		}
		foreach($allNa as $i => $location){
			
			$sql = "INSERT INTO ad_post_ethnicity(ad_id,ethnicity)VALUES('".$lastID."','".$location."')";
			$result = $db->query($sql);	
		}
		foreach($allLang as $i => $language){
			
			$sql = "INSERT INTO ad_post_languages(ad_id,languages)VALUES('".$lastID."','".$language."')";
			$result = $db->query($sql);	
		}
		foreach($allHobby as $i => $hobbies){
			
			$sql = "INSERT INTO ad_post_hobbies(ad_id,hobbies)VALUES('".$lastID."','".$hobbies."')";
			$result = $db->query($sql);	
		}
		
		
		unset($_SESSION['temuser']);
		cheader("ads-list.php");
	}
	$sql = "DELETE FROM temp_images WHERE user_id = '".$_SESSION['temuser']."'";
	$db->query($sql);
}else{
	$sql = "DELETE FROM temp_images WHERE user_id = '".$_SESSION['temuser']."'";
	$db->query($sql);	
}



$sql = "SELECT * FROM ethnicity";
$resultna = $db->query($sql);

$sql = "SELECT * FROM language";
$resultlan = $db->query($sql);

$sql = "SELECT * FROM hobbies";
$resulthob = $db->query($sql);

?>
<script type="text/javascript" src="<?php echo base_path?>/js/popup.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_path?>/css/popup_box.css" />
<script src="<?php echo  base_path?>js/ajaxUploader.js"></script>
<script language="javascript"> 
$(document).ready(function(e) {
	$('#addMT').click(function() {  
  		return !$('#selectMT1 option:selected').remove().appendTo('#selectMT2');  
 	});  
 	$('#removeMT').click(function() {  
  		return !$('#selectMT2 option:selected').remove().appendTo('#selectMT1');  
 	});  
    
	$('#addNA').click(function() {  
  		return !$('#selectNA1 option:selected').remove().appendTo('#selectNA2');  
 	});  
 	$('#removeNA').click(function() {  
  		return !$('#selectNA2 option:selected').remove().appendTo('#selectNA1');  
 	});  
    
	$('#addLANG').click(function() {  
  		return !$('#selectLANG1 option:selected').remove().appendTo('#selectLANG2');  
 	});  
 	$('#removeLANG').click(function() {  
  		return !$('#selectLANG2 option:selected').remove().appendTo('#selectLANG1');  
 	});  
    
	$('#addHOBBY').click(function() {  
  		return !$('#selectHOBBY1 option:selected').remove().appendTo('#selectHOBBY2');  
 	});  
 	$('#removeHOBBY').click(function() {  
  		return !$('#selectHOBBY2 option:selected').remove().appendTo('#selectHOBBY1');  
 	}); 
	
	$('#allnationality').click(function() {
		$('#selectNA1 option').prop('selected', true);
		$('#selectNA2 option').prop('selected', false);
		
	});
	$('#selectivenationality').click(function() {
		$('#selectNA1 option').prop('selected', false);
		$('#selectNA2 option').prop('selected', true);
		
	});
	 
	$('#alllanguages').click(function() {
		$('#selectLANG1 option').prop('selected', true);
		$('#selectLANG2 option').prop('selected', false);
		
	});
	$('#selectivelanguages').click(function() {
		$('#selectLANG1 option').prop('selected', false);
		$('#selectLANG2 option').prop('selected', true);
		
	}); 
	
	$('#allhobby').click(function() {
		$('#selectHOBBY1 option').prop('selected', true);
		$('#selectHOBBY2 option').prop('selected', false);
		
	}); 
	$('#selectivehobby').click(function() {
		$('#selectHOBBY1 option').prop('selected', false);
		$('#selectHOBBY2 option').prop('selected', true);
		
	}); 
    
});

function checkmember(){
	$('.loading').show();
	var memberid = $('#memberid').val();
	var data = 'memberid=' + memberid;
	$.ajax({	  
		url: '<?php echo base_path ?>ajax/checkmember.php',
		data: data,
		dataType: 'json',
		type: "POST",		
		success: function (stateform)
		{	
			if(stateform.status == 'yes') {
				$('#userid').val(stateform.id);
			var	pto  = '<div class="member-icon">';
 	   			pto += '<img id="memberimage" src="<?php echo base_path ?>'+stateform.image+'" />';
    			pto += '</div>';
				pto += '<div class="comment-content">';
    			pto += '<p class="member-name">'+stateform.name+'</p>';
        		pto += '<p class="member-email">Email : '+stateform.email+'</p>';
        		pto += '<p class="member-phone">Phone : '+stateform.phone+'</p>';
        		pto += '<p class="member-location">Location : '+stateform.location+'</p>';
				pto += '</div>';
				
				
			}else{
				$('#userid').val('');
				pto = '<p class="error">Member not found</p>';
			}
			$('#member_area').html(pto);	
			$('.loading').hide();
		}
	});

}

$(function () {
    $("#mainimage").change(function () {
        $("#dvPreview").html("");
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        if (regex.test($(this).val().toLowerCase())) {
            if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
                $("#dvPreview").show();
                $("#dvPreview")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
            }
            else {
                if (typeof (FileReader) != "undefined") {
                    $("#dvPreview").show();
                    $("#dvPreview").append("<img />");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#dvPreview img").attr("src", e.target.result);
						$("#cancel").show();
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            }
        } else {
            alert("Please upload a valid image file.");
        }
    });
	$('#cancel').click(function(e)
    {
    	$('#dvPreview').html("");
     	$('#dvPreview img').attr("src","");
		$('#dvPreview').hide();
		$('#cancel').hide();
		$('#mainimage').val("");
    })
});

$(document).ready(function(){
	new AjaxUpload('otherimage', {
			
			action : '<?php echo base_path?>ajax/adimageajax.php?pagetype=ADDIMAGE&userid=<?php echo $_SESSION['temuser']?>',
			type: "POST",
			name : 'image',
			responseType : 'json',
			onSubmit : function(file, extension) {
				$('.hideshowloading').show();
			},
			onComplete: function(file, response) {
				
				if(response.status)
				{
					imageRowted('','');
				}else
				{
					alert(response.msg);
				}
			}
		});  
});

function imageDelete(id){
	
	$('.hideshowloading').show();
	var data = '<?php echo base_path ?>ajax/adimageajax.php?pagetype=DELETE&imageno='+id+'&userid=<?php echo $_SESSION['temuser']?>';
	$.ajax({
		url : data,
        type: 'get',
		dataType:'json',
        success: function(data) {
			if(data.action == 'yes'){
				
				imageRowted('','');
				$('.hideshowloading').hide();
			}
        }
    });
}	
function imageRowted(type,no)
{
	
	var data = '<?php echo base_path ?>ajax/adimageajax.php?pagetype=IMAGE&type='+type+"&imageno="+no+"&userid=<?php echo $_SESSION['temuser']?>";
	//alert(data);
	$.ajax({
		url : data,
        type: 'get',
		dataType:'html',
        success: function(data) {

			$('#preview').html(data);
			$('#preview').show();
        }
    });
}

function showadpreview(){
	
	var adtitle		= $('#adtitle').val();
	var adtext 		= $('#adtext').val();
	var callaction 	= $('#callaction').val();
	var calllink 	= $('#callactionlink').val();
	var adimage		= $('#dvPreview img').attr('src');
	var adphone 	= $('#phonenumber').val();
	var ademail 	= $('#email').val();
	var membername 	= $('.member-name').text();
	var memberimg	= $('#memberimage').attr('src');
	
	if(memberimg != '' && memberimg != undefined){
		
		$('#memimg').html('<img src="'+memberimg+'" width="100" />');
	}else{
		$('#memimg').text('No preview');
	}
	$('#membername').text(membername);
	
	$('#adtexts').text(adtext);
	if(adimage != '' && adimage != undefined){
		$('#adimage').html('<img src="'+adimage+'" />');
	}
	
	$('#callaction a').text(callaction);
	$('#calllink').attr('href',calllink);
	
	$('#adphone').text(adphone);
	$('#ademail').text(ademail);
	
	$('#getlikes').wPopup();
	
}

function getLatLng(val){
	var zipcode = $("#zipcode").val();
	if(zipcode != ''){
    $.ajax({
       url : '<?php echo base_path ?>ajax/getradiouslnt.php?zipcode='+zipcode,
       method: "POST",
	   dataType:"json",
       success:function(data){
		   var tr = data.data.length;
		   var pto = '<select multiple size="10" id="selectMT1" name="FromLB[]" style="background:none; width:350px">';
		   for(i = 0; i < tr; i++){
			 //alert(data.data[i].metro_name);
			  pto += '<option value="'+data.data[i].metro_name+'">'+data.data[i].metro_name+'</option>';
		   }
		   pto += '</select>';
		   
		   $('#metroname').html(pto);
		   $('#selectMT3').hide();
       }
    });
	}else{
		
		alert('Please enter zip code')
	}
}
function  getradiouslnt(lat,lng){

	$.ajax({
       url : '<?php echo base_path ?>ajax/getradiouslnt.php?lat='+lat+"&lng="+lng,
       type: 'get',
	   dataType:'json',
       success:function(data){

       }

    });
}
</script>
<link href="<?php echo base_path?>css/jquery.datetimepicker.css" rel="stylesheet">
<style>
.verify_button {
	float: right
}
.adsdetails {
	margin-top: 30px;
}
.adsdetails h3 {
	float: left;
	margin: 0
}
#dvPreview {
    filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image);
	height: 100px;
	width: 100px;
	display: none;
	overflow:hidden;
}
#dvPreview img {
	width: 100px;
	
}
.fileUpload2 {
  left: 5px;
  overflow: hidden;
  position: relative;
  width: 148px;
}
.set_photos2 {
  background: #e1e1e1;
  color: #747474;
  display: inline-block;
  font-size: 16px;
  margin: 0 auto;
  padding: 9px 4px;
  position: relative;
  text-align: center;
  width: 145px;
}
.fa {
  display: inline-block;
  font-family: FontAwesome;
  font-feature-settings: normal;
  font-kerning: auto;
  font-language-override: normal;
  font-size: inherit;
  font-size-adjust: none;
  font-stretch: normal;
  font-style: normal;
  font-synthesis: weight style;
  font-variant: normal;
  font-weight: normal;
  line-height: 1;
  text-rendering: auto;
}
.fileUpload2 input[type="file"] {
 cursor: pointer;
  font-size: 20px;
  margin: 0;
  opacity: 0;
  padding: 0;
  position: absolute;
  right: 7px;
  top: -3px;
  width: 154px;
}


.fileUpload3 {
  /*left: 33px;
  overflow: hidden;
  position: relative;
  width: 148px;*/
}
.set_photos3 {
  background: #e1e1e1;
  color: #747474;
  display: inline-block;
  font-size: 16px;
  margin: 0 auto;
  padding: 9px 4px;
  position: relative;
  text-align: center;
  width: 145px;
}

.fileUpload3 input[type="file"] {
  cursor: pointer;
  font-size: 20px;
  margin: 0;
  opacity: 0;
  padding: 0;
  position: absolute;
  right: 7px;
  top: -3px;
  width: 154px;
}


.fileUpload4 {
  left: 5px;
  overflow: hidden;
  position: relative;
  width: 148px;
}
.set_photos4 {
   background: #e1e1e1;
  color: #747474;
  display: inline-block;
  font-size: 16px;
  margin: 0 auto;
  padding: 9px 4px;
  position: relative;
  text-align: center;
  width: 145px;
}

.fileUpload4 input[type="file"] {
  cursor: pointer;
  font-size: 20px;
  margin: 0;
  opacity: 0;
  padding: 0;
  position: absolute;
  right: 7px;
  top: -3px;
  width: 154px;
}

</style>

<div class="popup_box" id="getlikes" style="display:none; width:550px; left:375.5px; top:auto;" >
  <div class="head_title" id="head_ttl">Ad preview</div>
  <div class="close_but" style="" onClick="jQuery('#getlikes').wPopup().close();"> <img src="<?php echo base_path ?>/images/close_but.png" width="22" height="22" /></div>
  <div class="in_box">
    <div id="memimg"></div>
    <div id="membername"></div>
    <div id="adtexts"></div>
    <div id="adimage"></div>
    <div id="ademail"></div>
    <div id="adphone"></div>
    <div id="callaction"><a id="calllink" href=""></a></div>
  </div>
</div>
<div class="content-box"><!-- Start Content Box -->
  
  <div class="content-box-header">
    <h3 style="cursor: s-resize;"> <a href="<?php echo base_path . 'MyCP/country.php'; ?>">Country</a> > <?php echo $PageTitle; ?></h3>
  </div>
  <div class="clear"></div>
  <div class="content-box-content">
    <?php 
		$ERROR_MSG = isset($_SESSION["errormsg"]) ? $_SESSION["errormsg"] : '';
		$MSG = isset($_SESSION["msg"]) ? $_SESSION["msg"] : '';
		if ($ERROR_MSG != "") {
	?>
    <div class="notification errormsg png_bg"> <a class="close" href="javascript:showDetails('msgError');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>images/cross.png"></a>
      <div><?php echo $ERROR_MSG; ?></div>
    </div>
    <?php } elseif ($MSG != "") {?>
    <div class="notification success png_bg"> <a class="close" href="javascript:showDetails('msgOk');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>images/cross.png"></a>
      <div><?php echo $MSG; ?></div>
    </div>
    <?php } unset($_SESSION["errormsg"]); unset($_SESSION["msg"]);?>
    <div class="adsForm">
      <form name="adsform" id="adsform" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="userid" id="userid" value="">
        <div class="csForm">
        <div class="member_input">
          <label for="memberid">Member / Customer ID : </label>
          <input type="text" name="memberid" id="memberid" autocomplete="off">
          <input type="button" onClick="checkmember()" value="Verify Member">
          <img class="loading" style="display:none" src="<?php echo base_path ?>/images/loader.gif"> 
          </div>
          <div id="member_area"> </div>
          </div>
        <div style="clear:both"></div>
        <div class="adsdetails">
          <h3>Ad Details</h3>
          <div class="verify_button">
            <input type="button" onClick="showadpreview()" value="Preview Ad">
          </div>
          <div class="clr"></div>
          <div class="csForm">
            <label for="adtitle">Ad Title :</label>
            <input type="text" name="adtitle" id="adtitle" class="ipinput" autocomplete="off">
          </div>
          <div class="csForm">
            <label for="adtext" style="vertical-align:top">Ad Text :</label>
            <textarea name="adtext" id="adtext"></textarea>
          </div>
          <div class="csForm">
            <label for="callaction">Call To Action :</label>
            <select name="callaction" id="callaction" style="background:none">
              <option value="">Choose Button</option>
              <option value="Shop Now">Shop Now</option>
              <option value="Book Now">Book Now</option>
              <option value="Learn More">Learn More</option>
              <option value="Sign Up">Sign Up</option>
              <option value="Download">Download</option>
            </select>
          </div>
          <div class="csForm">
            <label for="callactionlink">Call To Action Link/URL :</label>
            <input type="text" name="callactionlink" id="callactionlink" class="ipinput" autocomplete="off">
          </div>
          <div class="csForm">
            <label for="mainimage" style="float:left">Main Image :</label>
            <div class="fileUpload2" style="float:left"> 
          	<span class="set_photos2"><i class="fa fa-upload"></i> Add Photo    	 		
            <input type="file" name="mainimage" id="mainimage">
                </span>
           </div>
            <div class="fileUpload3" style="float:left; margin-left:10px;"> 
          	<span class="set_photos3"><i class="fa fa-upload"></i> Add Video    	 		
            <input type="file" name="video" id="video">
                </span>
           </div>
            <div class="dvimage">
            <div id="dvPreview"></div>
            <a id="cancel" style="display:none" href="javascript:;"><i class="fa fa-times"></i></a>
            </div>
            <div style="clear:both"></div>
          </div>
          <div class="csForm">
            <label for="otherimage" style="float:left">Other Image :</label>
             <div class="fileUpload4" style="float:left"> 
          	<span class="set_photos4"><i class="fa fa-upload"></i> Add Photos    	 		
             <input type="file" name="otherimage" id="otherimage" multiple>
                </span>
           </div>
           <div style="clear:both"></div>
           <label></label>
            <div id="preview" style="display:none"></div>
            <div style="clear:both"></div>
          </div>
          
        </div>
        <div style="clear:both"></div>
        <div class="adaudience">
          <h3>Ad Audience</h3>
          <div class="csForm">
            <label for="location" style="vertical-align:top">Location : </label>
            <div class="location">
            <span class="radio">
              <input type="radio" name="location" value="-1" id="national">
              <label for="national">National</label>
           </span>
           <span class="radio">   
              <input type="radio" name="location" value="1" id="regional">
              <label for="regional">Regional</label>
           </span>
           <div style="clear:both"></div>   
           <label></label>
              <div class="zip_area">
                <label for="zip">Zip / Postal code</label>
                <input type="text" name="zipcode" id="zipcode" autocomplete="off">
                <input type="button" name="metroarea" id="metroarea" onclick="getLatLng()" value="Search Metro Area">
              </div>
              <div class="metroarea">
                <table>
                  <tr>
                    <td>
                    <div id="metroname">
                  <select multiple size="10" id="selectMT3" name="FromLB[]" style="background:none; width:402px">
                  </select>
                      </div>
                    </td>
                    <td align="center" style="vertical-align:middle">
                    	<a href="#" id="addMT" class="arrow">&gt;&gt;</a> <br />
                      	<a href="#" id="removeMT" class="arrow">&lt;&lt;</a></td>
                    <td>
                  <select multiple size="10" id="selectMT2"  name="ToLB[]" style="background:none; width:402px">
                  </select></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="csForm">
            <label for="location">Ethnicity / Nationality : </label>
            <div class="nationality">
            <span class="radio"> 
              <input type="radio" name="nationality" value="-1" id="allnationality">
              <label for="all">All</label>
              </span>
              <span class="radio"> 
              <input type="radio" name="nationality" value="1" id="selectivenationality">
              <label for="selective">Selective Ethnicities</label>
              </span>
              <div class="nationalityarea">
                <table>
                  <tr>
                    <td>
                  <select multiple id="selectNA1" size="10" name="FromNA[]" style="background:none; width:402px">
                    <?php while($datana = $resultna->fetch() ) { ?>
                    <option value="<?php echo $datana['ethnicity']?>"><?php echo $datana['ethnicity']?></option>
                    <?php } ?>    
                      </select></td>
                    <td align="center" style="vertical-align:middle">
                      <a href="#" id="addNA" class="arrow">&gt;&gt;</a> <br />
                      <a href="#" id="removeNA" class="arrow">&lt;&lt;</a></td>
                    <td>
                    <select multiple id="selectNA2" size="10" name="ToNA[]" style="background:none; width:402px">
                    </select></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="csForm">
            <label for="languages">Languages : </label>
            <div class="languages">
            <span class="radio"> 
              <input type="radio" name="languages" value="-1" id="alllanguages">
              <label for="all">All</label>
              </span>
              <span class="radio"> 
              <input type="radio" name="languages" value="1" id="selectivelanguages">
              <label for="selective">Selective Languages</label>
              </span>
              <div class="languagesarea">
                <table>
                  <tr>
                    <td>
                    <select multiple id="selectLANG1" size="10" name="FromLANG[]" style="background:none; width:402px">
                        <?php while($datalan = $resultlan->fetch() ) { ?>
                    <option value="<?php echo $datalan['language']?>"><?php echo $datalan['language']?></option>
                    <?php } ?>  
                      </select></td>
                    <td align="center" style="vertical-align:middle">
                    	<a href="#" id="addLANG" class="arrow">&gt;&gt;</a> <br />
                      	<a href="#" id="removeLANG" class="arrow">&lt;&lt;</a></td>
                    <td><select multiple id="selectLANG2" size="10" name="ToLANG[]" style="background:none; width:402px">
                      </select></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="csForm">
          <label for="hobbies">Hobbies : </label>
          <div class="languages">
          <span class="radio"> 
            <input type="radio" name="hobbies" value="-1" id="allhobby">
            <label for="all">All</label>
            </span>
            <span class="radio"> 
            <input type="radio" name="hobbies" value="1" id="selectivehobby">
            <label for="selective">Selective Hobby</label>
            </span>
            <div class="languagesarea">
              <table>
                <tr>
                  <td><select multiple id="selectHOBBY1" size="10" name="FromHOBBY[]" style="background:none; width:402px">
                      <?php while($datahob = $resulthob->fetch() ) { ?>
                        <option value="<?php echo $datahob['hobby']?>"><?php echo $datahob['hobby']?></option>
                    <?php } ?>  
                    </select></td>
                  <td align="center" style="vertical-align:middle">
                  	<a href="#" id="addHOBBY" class="arrow">&gt;&gt;</a> <br />
                    <a href="#" id="removeHOBBY" class="arrow">&lt;&lt;</a></td>
                  <td><select multiple  id="selectHOBBY2"size="10" name="ToHOBBY[]" style="background:none; width:402px">
                    </select></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="csForm">
          <label for="agerange">Age Range : </label>
          <select name="from" id="from" style="background:none;">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
          </select>
          <select name="to" id="to" style="background:none;">
            <option value="50+">50+</option>
            <option value="55+">55+</option>
            <option value="60+">60+</option>
            <option value="65+">65+</option>
          </select>
        </div>
       
      <link rel="stylesheet" href="<?php echo base_path ?>/MyCP/css/jquery-radio-ui.css">
		<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <script>
		 $(function() {
			$( "#radio" ).buttonset();
			$( "#radio2" ).buttonset();
		});
</script>
        <div class="csForm">
          <label for="gender">Gender : </label>
          <div id="radio">
          		<span class="radio"> 
             	<input type="radio" name="gender" value="gall" id="gall" checked="checked">
              	<label id="option" for="gall">All</label>
                </span>
                  <span class="radio"> 
                  <input type="radio" name="gender" value="male" id="male">
                  <label for="male">Male</label>
                  </span>
                  <span class="radio"> 
                  <input type="radio" name="gender" value="female" id="female">
                  <label for="female">Female</label>
                 </span>
          </div> 
        </div>
        <div class="csForm">
          <label for="status">Status : </label>
          <div id="radio2">
          <span class="radio"> 
          <input type="radio" name="status" value="active" id="active" checked="checked">
          <label for="active">Active</label>
          </span>
          <span class="radio"> 
          <input type="radio" name="status" value="paused" id="paused">
          <label for="paused">Paused</label>
          </span>
          <span class="radio"> 
          <input type="radio" name="status" value="delete" id="delete">
          <label for="delete">Deleted</label>
          </span>
          </div>
        </div>
        <div class="csForm">
          <label for="schedules">Schedules : </label>
          <span class="date" style="position:relative"> 
          <label for="startdate">Start Date</label>
          <input type="text" id="startdate" name="start" autocomplete="off">
          </span>
          <span class="date" style="position:relative"> 
          <label for="untildate">Run this ad until </label>
          <input type="text" id="untildate" name="until" autocomplete="off">
          </span>
        </div>
        <div class="csForm">
          <label for="schedules">Ad Response : </label>
          <span class="radio"> 
          <label for="phone">Phone Number</label>
          <select name="numbercode" id="numbercode" style="background:none;">
            <option value="us">United States (+1)</option>
            <option value="us">India (+91)</option>
          </select>
          <input type="text" name="phonenumber" id="phonenumber" autocomplete="off">
          </span>
          <div style="clear:both"></div>
          <label></label>
          <span class="radio" style="margin-top:10px"> 
          <label for="phone">Email Address</label>
          <input type="text" name="email" id="email" autocomplete="off">
          </span>
        </div>
        <input type="submit" name="submitad" id="submitad" value="Save">
      </form>
    </div>
  </div>
</div>
<script src="<?php echo base_path?>js/jquery.datetimepicker.js"></script> 
<script>
$('#startdate').datetimepicker({
	format:'Y/m/d',
  onShow:function( ct ){
   this.setOptions({
    maxDate:jQuery('#untildate').val()?jQuery('#untildate').val():false
   })
  },
  closeOnDateSelect:true,
  timepicker:false
});
$('#untildate').datetimepicker({
	 format:'Y/m/d',
  onShow:function( ct ){
   this.setOptions({
    minDate:jQuery('#startdate').val()?jQuery('#startdate').val():false
   })
  },
  closeOnDateSelect:true,
  timepicker:false
 });

</script>
<?php include('footer.php'); ?>
