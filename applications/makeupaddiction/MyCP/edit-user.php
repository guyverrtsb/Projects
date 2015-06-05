<?php
$PageTitle = "Edit User Details";
include('header.php');
require_once('../includes/image_lib/image.class.php');
require_once('../includes/ws-user.class.php');

$USER=new USER_CLASS;

$userid = base64_decode($_GET['userid']);

if ($userid <= 0) {
    cheader("manage-users.php");
}

$sql = "select * from users WHERE" .
        " userid = '" . $userid . "'";
$result1 = $db->query($sql);
if ($result1->size() <= 0) {
    cheader("manage-users.php");
}
$row = $result1->fetch();

$path = $row['user_image'];
if ($path == '') {
    $path = 'uploads/defalut_img@2x.png';
}
function checkValidUserName($userName, $userid) {
		global $db;
		if (validate_username($userName) and $userName != "") {
			$sql = "select * from users where trim(upper(user_name))='" . strtoupper($userName) . "' AND userid!='" . $userid . "'";
			$result = $db->query($sql);
			if ($result->size() > 0) {
				//$this->msg = "Username already exits.Please try with other username";
				unset($result);
				return false;
			}
		} else {
			//$this->msg = " Not a valid username";
			return false;
		}

		return true;
	}

	function checkValidEmail($email, $userid) {
		global $db;
		/* echo $email;
		  die; */
		if (is_email_address($email) and $email != "") {
			$sql = "select * from users where trim(upper(email))='" . strtoupper($email) . "' AND userid!='" . $userid . "'";
			$result = $db->query($sql);

			if ($result->size() > 0) {
				//$this->msg = "The email address entered is already registered";
				unset($result);
				return false;
			}
		} else {
			//$this->msg = " Not a valid email";
			return false;
		}
		return true;
	}

if (isset($_POST['btnsubmit'])) {

    $str = true;

    $id = $_POST['id'];

    $fname = security(trim($_POST['fname']));
    $lname = security(trim($_POST['lname']));
   
    $email = security(trim($_POST['email']));
    $user_bio = security(trim($_POST['user_bio']));
    $gender = security(trim($_POST['gender']));
    
	
    if($email=='')
    {
        $_SESSION["errormsg"]	.=	"Email address is a required field."."<br>";
		$str	=	false;
    }
    else if(!is_email_address($email))
    {
        $_SESSION["errormsg"]	.=	"Not a valid email address."."<br>";
		$str	=	false;
    }
	else if(!checkValidEmail($email,$id))
	{
		$_SESSION["errormsg"]	.=	"The email address entered is already registered ."."<br>";
		$str	=	false;
	}


    if ($str == true) {

        if ($id > 0) {
            // Update user

            if ($_FILES['photo']['tmp_name']!="") {
				$ar = $USER->uploadImg($_FILES['photo']['tmp_name'], $_FILES['photo']['name'], $id);
			}
            $sqlUpdate = " UPDATE users SET " .
                    " fname     =   '" . $fname . "'," .
                    " lname     =   '" . $lname . "'," .
                    " email         =   '" . $email . "'," .
                    " user_bio           =   '" . $user_bio . "'," .
                    " gender        =   '" . $gender . "'" .
                    " WHERE userid = '" . $id . "' ";

            $db->query($sqlUpdate);

            $_SESSION['msg'] = "Updated successfully.";
        }
        cheader("manage-users.php");
    }
}
?>
<link rel="stylesheet" href="<?php echo base_path ?>MyCP/css/validationEngine.jquery.css" type="text/css"/>

<!--<script src="<?php echo base_path ?>js/jquery-1.7.2.min.js" type="text/javascript">-->
<!--</script>-->
<script src="<?php echo base_path; ?>js/jquery.validate.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function(e) {
        $('#dob').datepicker({
            changeYear: true,
            changeMonth: true,
            maxDate: '<?php echo date("Y-m-d"); ?>',
            numberOfMonths: 1,
            yearRange: '-100:+0',
            dateFormat: "yy-mm-dd"

        });
        $('#passform').validate();
    });



    function chkform() {
        str = true;
        msg = "";

        username = $("#username").val().trim();
        if (username == "") {
            msg = msg + "Please enter the user name. \n";
            str = false;
        }
        pemail = $("#p-email").val().trim();
        if (pemail == "") {
            msg = msg + "Please enter the email. \n";
            str = false;
        }

        oldpass = $("#oldpass").val().trim();
        if (oldpass == "") {
            msg = msg + "Please enter the old password. \n";
            str = false;
        }

        pass = $("#pass").val().trim();
        if (pass == "") {
            msg = msg + "Please enter the new password. \n";
            str = false;
        }

        confpass = $("#confpass").val().trim();
        if (confpass == "") {
            msg = msg + "Please enter the confirm password. \n";
            str = false;
        }
        if (pass != "" && confpass != "") {
            if (pass != confpass) {
                msg = msg + "New password and confirm password did not match. \n";
                str = false;
            }

        }

        if (str == false) {
            alert(msg);
        }

        return str;
    }
</script>


<!--******************************Interface*****************************-->

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">
        <h3 style="cursor: s-resize;">
            <a href="<?php echo base_path . 'MyCP/welcome.php'; ?>">Dashboard</a> >
            <a href="<?php echo base_path . 'MyCP/manage-users.php'; ?>">Users</a> >
            <?php echo $PageTitle; ?>
        </h3>
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
            ?><div class-"clear"></div>
            <div  class="Registerinner">    
                <form name="passform" id="passform"  style="display:block" id="frmuser" action="#" enctype="multipart/form-data" method="post" class="block-content form" >
                    <div id="errorMsg" style="display:<?php
                    if ($strErr != "") {
                        echo "block";
                    } else {
                        echo "none";
                    }
                    ?>; "></div>
                    <input type='hidden' name='id' size='25' value="<?php echo $userid ?>">
                    <table width="100%" border="0" class="bx_tbl">
<!--        <thead>
          <tr>
            <td align="left" valign="middle">User Detail</td>
            <td align="left" valign="middle">&nbsp;</td>
          </tr>
        </thead>-->
                        <tbody>
                            <tr>
                                <td align="left" valign="middle"><label for=textfield> First Name</label></td>
                                <td align="left" valign="middle">
                                    <input type="text" name="fname" value="<?php echo $row['fname']; ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle"><label for=textfield> Last Name</label></td>
                                <td align="left" valign="middle">
                                    <input type="text" name="lname" value="<?php echo $row['lname']; ?>"/>
                                </td>
                            </tr>
                            <tr>
                        
                            <tr>
                                <td align="left" valign="middle"><label for=textfield>Email</label></td>
                                <td align="left" valign="middle">
                                    <input type="text" name="email" value="<?php echo $row['email']; ?>"/>
                                </td>
                            </tr>
                            <!--<tr>
                                <td align="left" valign="middle"><label for=textfield>Dob</label></td>
                                <td align="left" valign="middle">
                                    <input type="text" name="dob" id="dob" value="<?php echo $row['dob']; ?>"/>
                                </td>
                            </tr>-->
                            <tr>


                                <td align="left" valign="middle"><label for=textfield>Gender</label></td>
                                <td align="left" valign="middle">
                                    <label style="float:left; font-weight:normal;"><input type="radio" style=" width:30px;margin-top:3px;" id="gender" class="" name="gender" value="male" <?php if (strtoupper($row['gender']) == 'MALE') print('checked="checked"') ?>/>Male</label>

                                    
                                    <label style="float:left; font-weight:normal;">
                                    <input type="radio" id="gender" style=" width:30px; margin-top:3px;" class="" name="gender" value="female" <?php if (strtoupper($row['gender']) == 'FEMALE') print('checked="checked"') ?>/>Female</label>

                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle"><label for=textfield>User Bio</label></td>
                                <td align="left" valign="middle">
                                    <input type="text" name="user_bio" value="<?php echo $row['user_bio']; ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle"><label for=textfield>User Image</label></td>
                                <td align="left" valign="middle">
                                    <input type="file" name="photo" />
                                    <?php if( $row['user_thumbimage']!=""){
                                        echo "<img src='../".$row['user_thumbimage']."' width=100 height=100 />";
                                    } ?>
                                </td>
                            </tr>

                           
<!--                            <tr>
                                <td align="left" valign="middle"><label for=textfield>Photo</label></td>
                                <td align="left" valign="middle"><img src="<?php echo base_path . $path ?>" width="70" /></td>
                            </tr>-->
                        </tbody>
                    </table>             
                    <div class=clear></div>
                    <!--<div class="error"><?php
                    if ($msg != "") {
                        echo "<div class='error'>$msg";
                    }
                    ?></div>--><div class=clear></div>
                    <div class="block-actions">
                        <dl>
                            <dd style=" margin-left:53.3%; float:left;">
                                <input type="submit" class="button" style="width:100px;margin-right:20px; margin-top:5px;" name="btnsubmit" value=" Submit ">
                                <a class="rest"  href="<?php echo base_path; ?>MyCP/manage-users.php">Cancel</a>
                            </dd>

                        </dl>
                    </div>

                </form>
            </div> <div class="clear"></div> 
        </div>




    </div></div>


<script langauge="javascript">
    function getChangeFaq(fid, title, comment, order) {

        $('#fid').val(fid);
        $('#title').val(title);
        $('#comment').val(comment);
        $('#order').val(order);
        $('#flag').val(flag);
        //$('#popup').wPopup();
    }


    function confirmDelete()
    {
        var agree = confirm("Are you sure to delete this Category?");
        if (agree)
            return true;
        else
            return false;
    }
    function Changepagesize(url, pagesize)
    {
        var url = url + "&pagesize=" + pagesize;
        window.location = url;
    }

    function edit_cat() {
        $('#tab1').css('display', 'none');
        $('#tab2').css('display', 'block');
        $('#ttab1').removeClass('current');
        $('#ttab2').addClass('current');
        $('#ttab2').html('Edit');
        $('#savecat').val('Update');
    }
</script>
<?php include("footer.php"); ?>
