<?php
if(isset($_GET['mode']) != 'edit'){
$PageTitle = "Add Member";
$buttonname = 'btnsubmit';
$buttonvalue = 'Save';
}else{
	$PageTitle = "Edit Member";
	$buttonname = 'btnupdate';
	$buttonvalue = 'Update';
}
include('header.php');
$id = intval(base64_decode($_REQUEST['id']));
if ($id > 0) {
    $sqlCat = "SELECT * FROM `member` WHERE id = '" . $id . "' ";
    $resCat = $db->query($sqlCat);
    if ($resCat->size() > 0) {
        $rowCat   =  $resCat->fetch();
        $memberid    =  $rowCat['member_id'];
        $name 	  =  $rowCat['member_name'];
		$email    =  $rowCat['member_email'];
		$phone    =  $rowCat['member_phone'];
		$location    =  $rowCat['member_location'];
		
    } else {
        cheader("member.php");

    }
}

if (isset($_POST['btnupdate'])) {
	$path	=	'../memberphoto';
	$path1	=	'memberphoto';
    $str = true;
    
    $memberid     =  security(trim($_POST['memberid']));
    $name		  =  security(trim($_POST['name']));
	$email	      =  security(trim($_POST['email']));
	$phone	      =  security(trim($_POST['phone']));
	$location     =  security(trim($_POST['location']));
	$memberimage  =  $_FILES['memberimage']['type'];
	$memimage  	  =  $_FILES['memberimage']['name'];
//print_r($memberimage);
    if ($memberid == '') {
        $_SESSION['errormsg'] .= "Member id is a required field" . "<br />";
        $str = false;
    }
    if ($name == '') {
        $_SESSION['errormsg'] .= "Name is a required field" . "<br />";
        $str = false;
    }
	if ($email == '') {
        $_SESSION['errormsg'] .= "Email is a required field" . "<br />";
        $str = false;
    }elseif( !is_email_address($email))
	{
		$_SESSION["errormsg"]	.=	"Email is not valid<br>";
		$str	=	false;
	}
	if ($phone == '') {
        $_SESSION['errormsg'] .= "Phone is a required field" . "<br />";
        $str = false;
    }
	if ($location == '') {
        $_SESSION['errormsg'] .= "Location is a required field" . "<br />";
        $str = false;
    }
	
		if($memimage != ''){
        if ($memberimage == 'image/jpeg' || $memberimage == 'image/gif' || $memberimage == 'image/png') {
            /*             * **********certificate*********************** */
               $random = rand(0000,9999);
               $certimg = $_FILES['memberimage']['tmp_name'];
               $certimg_name = $_FILES["memberimage"]["name"];
               $ext = strtolower(pathinfo($certimg_name, PATHINFO_EXTENSION));
               $picname = strtolower(str_replace(array(' ', "'", '"'), '-', $random . "." . $ext));
               $certori = $path1 . '/' . $picname;
               move_uploaded_file($_FILES["memberimage"]["tmp_name"], $path . '/' . $picname);
               $memimages .=", member_image   =   '" . $certori . "' ";

            /*             * **********certificate*********************** */
        } else {
            if ($memberimage != '') {
                $_SESSION["errormsg"] .= "Image type not allowed." . "<br>";
                $str = false;
            }
        }
    	
		}
    if ($str == true) {
     $sql1 = " SELECT member_id FROM member WHERE ".
                    " UPPER(member_id) = '" . strtoupper($memberid) . "' AND ".
                    " id != '" . $id . "'";
            $result1 = $db->query($sql1);
            if ($result1->size() > 0) {
                $_SESSION['errormsg'] .= "This member id already exists!" . "<br>";
                cheader("member.php?id=".  base64_encode($id)."&mode=edit");
            }

             $sqlUpdate = 	" UPDATE member SET " .
                          	" member_id       =  '" . $memberid . "' ,".
							" member_name     =  '" . $name . "' ,".
							" member_email    =  '" . $email . "' ,".
							" member_phone    =  '" . $phone . "' ,".
							" member_location =  '" . $location . "' ".$memimages." ".
                         	" WHERE id = '".$id."' ";

            $db->query($sqlUpdate);

            $_SESSION['msg'] = "Updated successfully.";
        
        cheader("member.php");
    }
}

if (isset($_POST['btnsubmit'])) {
	$path	=	'../memberphoto';
	$path1	=	'memberphoto';
    $str = true;
    
    $memberid     =  security(trim($_POST['memberid']));
    $name		  =  security(trim($_POST['name']));
	$email	      =  security(trim($_POST['email']));
	$phone	      =  security(trim($_POST['phone']));
	$location     =  security(trim($_POST['location']));
	$memberimage  =  $_FILES['memberimage']['type'];
	$memimage  	  =  $_FILES['memberimage']['name'];
//print_r($memberimage);
    if ($memberid == '') {
        $_SESSION['errormsg'] .= "Member id is a required field" . "<br />";
        $str = false;
    }
    if ($name == '') {
        $_SESSION['errormsg'] .= "Name is a required field" . "<br />";
        $str = false;
    }
	if ($email == '') {
        $_SESSION['errormsg'] .= "Email is a required field" . "<br />";
        $str = false;
    }elseif( !is_email_address($email))
	{
		$_SESSION["errormsg"]	.=	"Email is not valid<br>";
		$str	=	false;
	}
	if ($phone == '') {
        $_SESSION['errormsg'] .= "Phone is a required field" . "<br />";
        $str = false;
    }
	if ($location == '') {
        $_SESSION['errormsg'] .= "Location is a required field" . "<br />";
        $str = false;
    }
	
	 if ($memimage != '') {

        if ($memberimage == 'image/jpeg' || $memberimage == 'image/gif' || $memberimage == 'image/png') {
            /*             * **********certificate*********************** */
               $random = rand(0000,9999);
               $certimg = $_FILES['memberimage']['tmp_name'];
               $certimg_name = $_FILES["memberimage"]["name"];
               $ext = strtolower(pathinfo($certimg_name, PATHINFO_EXTENSION));
               $picname = strtolower(str_replace(array(' ', "'", '"'), '-', $random . "." . $ext));
               $certori = $path1 . '/' . $picname;
               move_uploaded_file($_FILES["memberimage"]["tmp_name"], $path . '/' . $picname);
               $memimages .=", member_image   =   '" . $certori . "' ";
            

            /*             * **********certificate*********************** */
        } else {
            if ($memberimage != '') {
                $_SESSION["errormsg"] .= "Image type not allowed." . "<br>";
                $str = false;
            }
        }
    }else{
		$_SESSION["errormsg"] = "Please select image." . "<br>";
        $str = false;
		
	}
    if ($str == true) {
      
            $sql1 = " SELECT member_id FROM member WHERE ".
                    " UPPER(member_id) = '" . strtoupper($memberid) . "' ";
            $result1 = $db->query($sql1);
            if ($result1->size() > 0) {
                $_SESSION['errormsg'] .= "This member id already exists!" . "<br>";
                cheader("add-member.php");
            }

           $sql =  " INSERT INTO member SET " .
                    " member_id       =  '" . $memberid . "' ,".
					" member_name     =  '" . $name . "' ,".
					" member_email    =  '" . $email . "' ,".
					" member_phone    =  '" . $phone . "' ,".
					" member_location =  '" . $location . "' ".$memimages.", ".
                    " dtdate          =  NOW() ";
			
            $db->query($sql);

            $_SESSION["msg"] = "Added successfully. ";
			cheader("member.php");
        
        
    }
}

?>


<!--******************************Interface*****************************-->

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">
        <h3 style="cursor: s-resize;"> 
 <a href="<?php echo base_path . 'MyCP/member.php'; ?>">Member</a> >
 
    <?php echo $PageTitle; ?></h3>
        
    </div>
    <div class="clear"></div> 


    <div class="content-box-content"> 

        <div style="display: block;" class="tab-content default-tab" id="tab1">
            <?php
            $ERROR_MSG = isset($_SESSION["errormsg"]) ? $_SESSION["errormsg"] : '';
            $MSG = isset($_SESSION["msg"]) ? $_SESSION["msg"] : '';
            if ($ERROR_MSG != "") {
                ?>
                <div class="notification errormsg png_bg"> <a class="close" href="javascript:showDetails('msgError');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>images/cross.png"></a>
                    <div><?php echo $ERROR_MSG; ?></div>
                </div>
            <?php } elseif ($MSG != "") {
                ?>
                <div class="notification success png_bg"> <a class="close" href="javascript:showDetails('msgOk');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>images/cross.png"></a>
                    <div><?php echo $MSG; ?></div>
                </div>
                <?php
            }
            unset($_SESSION["errormsg"]);
            unset($_SESSION["msg"]);
            ?>
            <div class="clear"></div>
            <div  class="Registerinner">    
<div class="cm_bx1" style="width:100%">
                <form action="" method="post" name="form" id="optionform" enctype="multipart/form-data">
                    <input type="hidden" name="Id" id="Id" value="<?php echo $Id; ?>" />
                  
                    <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Member / Customer ID</label></div>
                        <div class="in_colRight">
                            <input type="text" class="required" placeholder="Member / Customer ID" value="<?php echo $memberid; ?>" name="memberid" id="memberid" style="float:left" required=""/>
                        </div>
                        <div class="clr"></div>
                    </div>
                    
                    <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Name</label></div>
                        <div class="in_colRight">
                            <input type="text" class="required" placeholder="Name" value="<?php echo $name; ?>" name="name" id="name" style="float:left" required=""/>
                        </div>
                        <div class="clr"></div>
                    </div>
                    
                    <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Email</label></div>
                        <div class="in_colRight">
                            <input type="text" class="required" placeholder="Email" value="<?php echo $email; ?>" name="email" id="email" style="float:left" required=""/>
                        </div>
                        <div class="clr"></div>
                    </div>
                    
                    <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Phone</label></div>
                        <div class="in_colRight">
                            <input type="text" class="required" placeholder="Phone" value="<?php echo $phone; ?>" name="phone" id="phone" style="float:left" required=""/>
                        </div>
                        <div class="clr"></div>
                    </div>
                    
                    <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Location</label></div>
                        <div class="in_colRight">
                            <input type="text" class="required" placeholder="Location" value="<?php echo $location; ?>" name="location" id="location" style="float:left" required=""/>
                        </div>
                        <div class="clr"></div>
                    </div>
                    
                    <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Image</label></div>
                        <div class="in_colRight">
                            <input type="file" name="memberimage" id="memberimage" style="float:left;width: 208px;" />
                        </div>
                        <div class="clr"></div>
                    </div>
                    
                    <div class="in_row">
                        <div class="in_colLeft">&nbsp;</div>
                        <div class="in_colRight">
                            <input  class="button" type="submit" name="<?php echo $buttonname ?>" value="<?php echo $buttonvalue ?>" style="padding:0px; width:100px; margin-top:5px"/> 
                            <a class="rest"  href="<?php echo base_path; ?>MyCP/member.php"  >Cancel</a>
                        </div>
                        <div class="clr"></div>
                    </div>


                </form>
</div>
            </div>
            <div class="clear"></div> 
        </div>
    </div>

</div>
<?php include("footer.php"); ?>
