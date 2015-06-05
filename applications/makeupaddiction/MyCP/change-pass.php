<?php
$PageTitle = "Change Admin Password";
include('header.php');

$sql = "select * from adminlogin where userid='" . $_SESSION["admin"] . "'";
$result1 = $db->query($sql);
if ($result1->size() > 0) {
    $row = $result1->fetch();
    $userid = $row["userid"];
    $email = $row["email"];
    
    $username = $row["name"];
}

if ($_POST["btnsubmit"]) {
    $email = $_POST["p-email"];

    $sql = " select * from adminlogin where userid='" . $_SESSION["admin"] . "' " .
            " and pass='" . md5($_POST["oldpass"]) . "'";
    $result1 = $db->query($sql);

    if ($result1->size() > 0) {
//        if ($_POST['username'] == $_SESSION["admin"]) {

            $sql1 = "update `adminlogin` set `userid`='" . $_POST["username"] . "', `pass`='" . md5($_POST["confpass"]) . "', email='" . $email . "' where `userid`='" . $_POST["id"] . "'";

            $result = $db->query($sql1);
//            $_SESSION["msg"] = "Username and password Successfully changed !";
//        } else {
//            $sql2 = "select * from adminlogin where userid='" . $_POST['username'] . "'";
//            $res = $db->query($sql2);

//            if ($res->size() > 0) {
//                $_SESSION['errormsg'] = "User name already exist!";
//            } else {
//                $sql1 = "update `adminlogin` set `userid`='" . $_POST["username"] . "', `pass`='" . md5($_POST["confpass"]) . "' where `userid`='" . $_POST["id"] . "'";
//                $result = $db->query($sql1);
//                $_SESSION["msg"] = "User name and password Successfully changed !";
//            }
//        }
        cheader("change-pass.php?mode=logout");
    } else
        $_SESSION['errormsg'] = "User name and old password does not match !";
}
?>
<link rel="stylesheet" href="<?php echo base_path ?>MyCP/css/validationEngine.jquery.css" type="text/css"/>

<!--<script src="<?php echo  base_path ?>js/jquery-1.7.2.min.js" type="text/javascript">-->
<!--</script>-->
<script src="<?php echo base_path; ?>js/jquery.validate.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function(e) {
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
        <h3 style="cursor: s-resize;"> Reset  User Name & Password</h3>
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
<div class="cm_bx1">                
                <form name="passform" id="passform"  style="display:block" id="frmuser" action="#" method="post" class="block-content form" >
                    <div id="errorMsg" style="display:<?php
                    if ($strErr != "") {
                        echo "block";
                    } else {
                        echo "none";
                    }
                    ?>; "></div>
                    <input type='hidden' name='id' size='25' value="<?php echo $userid ?>">
                    <dl>
                        <dt><label for=textfield>User Name</label></dt>
                        <dd><input type='text' class="validate[required] text-input" name='username' id='username' placeholder="Enter User name" size='25' value="<?php echo $userid ?>" style="width:245px;" /></dd>
                    </dl>

                    <dl>
                        <dt><label for=textfield>Email</label></dt>
                        <dd><input type='email'  class="text-input" class="validate[required,custom[email]]" name='p-email' placeholder="Enter Email" size='25' value="<?php echo $email ?>"style="width:245px;"  id='p-email'  /></dd>
                    </dl>

                    <dl>
                        <dt><label for=textfield>Old Password</label></dt>
                        <dd><input type="password" name="oldpass" placeholder="Enter Old password" id="oldpass" minlength="5" class="text-input" size="25" class="validate[required]"style="width:245px;" required=""/></dd>
                    </dl>

                    <dl>
                        <dt><label for=textfield>New Password</label></dt>
                        <dd><input type="password" class="text-input" name="pass" placeholder="Enter New password" id="pass"  size="25" minlength="5" maxlength="15" class="validate[required]"style="width:245px;" required=""/></dd>
                    </dl>
                    <dl>

                        <dt><label for=textfield>Confirm Password</label></dt>
                        <dd><input type="password" class="text-input"  name="confpass" id="confpass" equalTo="#pass" placeholder="Enter confirm password" size="25"  class="validate[required,equals[pass]]"style="width:245px;" required=""/></dd>
                    </dl>                
                    <div class=clear></div>
                    <!--<div class="error"><?php
                    if ($msg != "") {
                        echo "<div class='error'>$msg";
                    }
                    ?></div>--><div class=clear></div>
                    <div class="block-actions">
                        <dl>
                            <dd>
                                <input type="submit" class="button" style="width:100px;margin-right:20px" name="btnsubmit" value=" Submit ">
                                <input type="reset" class="button red" style=" width:100px;" name="clear" value="Clear ">
                            </dd>
                        </dl>
                    </div>

                </form>
</div>    
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
