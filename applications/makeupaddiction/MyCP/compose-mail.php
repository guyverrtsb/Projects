<?php
$PageTitle = "Compose Mail";
include('header.php');
$row_over_alternate_color = "#F2F1EE";
$row_over_color = "#FFF8DB";
$bgcolor = "#FBFCFC";
$MSG = '';
$ID = base64_decode($_GET['email']);
$ID = intval($ID);
if ($ID == 0)
    cheader("MyCP/emailmanager.php");
if (isset($_POST['btnsubmit']) and ! empty($_POST['btnsubmit'])) {
    
    $_body = addslashes(trim($_POST['desc']));
    $_subject = addslashes(trim($_POST['subject']));
    $_id = intval($_POST['_action']);

    $_upSql = " UPDATE mail_body SET " .
            " mail_body	= '" . $_body . "'" .
            " ,subject	= '" . $_subject . "' " .
            " WHERE id=" . $_id;

    if ($db->query($_upSql))
        $_SESSION["msg"] = "Mail Body successfully Updated!!";
}


if ($ID < 1)
    cheader("MyCP/emailmanager.php");

function rteSafe($strText) {
    //returns safe code for preloading in the RTE
    $tmpString = $strText;
    //convert all types of single quotes
    $tmpString = str_replace(chr(145), chr(39), $tmpString);
    $tmpString = str_replace(chr(146), chr(39), $tmpString);
    $tmpString = str_replace("'", "&#39;", $tmpString);

    //convert all types of double quotes
    $tmpString = str_replace(chr(147), chr(34), $tmpString);
    $tmpString = str_replace(chr(148), chr(34), $tmpString);
    //	$tmpString = str_replace("\"", "\"", $tmpString);
    //replace carriage returns & line feeds
    $tmpString = str_replace(chr(10), " ", $tmpString);
    $tmpString = str_replace(chr(13), " ", $tmpString);

    return $tmpString;
}

/* 	who is online	 */
$sqluser = "SELECT userno FROM adminlogin WHERE userid ='" . $_SESSION['admin'] . "'";
$queryuser = $db->query($sqluser);
$rowuser = $queryuser->fetch();

/* 	Which Mail	 */
$_sql = "SELECT * FROM mail_body WHERE id = " . $ID;
$_query = $db->query($_sql);
if ($_query->size())
    $_row = $_query->fetch();
?>
<script type="text/javascript" src="<?php echo base_path ?>js/ajax.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_path ?>MyCP/html2xhtml.js"></script> 
<script language="JavaScript" type="text/javascript" src="<?php echo base_path ?>MyCP/richtext.js"></script>
<script language="JavaScript" type="text/javascript">

    function Validate(frm)
    {
        updateRTE('desc');
        strValid = "";
        var illegalChars = /\W/; // allow letters, numbers, and underscores

        if (frm.subject.value == "")
            strValid += "Enter Subject.<br>";

        if (frm.desc.value == "")
            strValid += "Enter Message.<br>";

        if (strValid != "")
        {
            document.getElementById("errorMsg").innerHTML = "<p><b>Please correct the following error's : </b><br>" + strValid + "</p>";
            document.getElementById('errorMsg').className = "msg-error";
            document.getElementById("errorMsg").style.display = "block";
            window.scrollTo(0, 0);
            return false;
        }
        return true;
    }
</script>  

<!--******************************Interface*****************************-->

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">
        <h3 style="cursor: s-resize;"> 
            <a href="<?php echo base_path . 'MyCP/welcome.php'; ?>">Dashboard</a> >

            <?php echo $PageTitle; ?></h3>

    </div>
    <div class="clear"></div> 


    <div class="content-box-content"> 

        <div style="display: block;" class="tab-content default-tab" id="tab1">

            <div class="clear"></div>
            <div  class="Registerinner">    

                <form action="#" method="post" name="frmmessage" onSubmit=" return Validate(this);" class="block-content form" style="display:block">
                    <input type="hidden" name="_action" id="from" value="<?php echo $ID; ?>" />
                    <div id="errorMsg" style="display:<?php
                    if ($strErr != "") {
                        echo "block";
                    } else {
                        echo "none";
                    }
                    ?>; "> </div>
                         <?php
                         $ERROR_MSG = isset($_SESSION["errormsg"]) ? $_SESSION["errormsg"] : '';
                         $MSG = isset($_SESSION["msg"]) ? $_SESSION["msg"] : '';
                         if ($ERROR_MSG != "") {
                             ?>
                        <div class="notification error png_bg"> <a class="close" href="javascript:showDetails('msgError');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>MyCP/images/cross.png"></a>
                            <div><?php echo $ERROR_MSG; ?></div>
                        </div>
                    <?php } elseif ($err_msg != '') {
                        ?>

                        <div class="notification error png_bg" id="msgError"> <a class="close" href="javascript:showDetails('msgError');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>images/icons/cross.png"></a>
                            <div><?php echo $err_msg; ?></div>

                        </div>
                    <?php } elseif ($MSG != "") {
                        ?>
                        <div class="notification success png_bg"> <a class="close" href="javascript:showDetails('msgOk');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>MyCP/images/cross.png"></a>
                            <div><?php echo $MSG; ?></div>
                        </div>
                        <?php
                    }

                    unset($_SESSION["errormsg"]);
                    unset($_SESSION["msg"]);
                    ?>   
                    <dl> 
                        <dt>Subject *</dt>
                        <dd><input type="text" style="width:100%;" name="subject" id="subject" value="<?php echo $_row['subject'] ?>" /> </dd>
                    </dl>
                    <dl> 
                        <dt>Message *</dt>
                        <dd>
                            <div style=" height:400px;">


                                <script language="JavaScript" type="text/javascript">
                                    initRTE("images/", "", "", true);
                                    //        <!--
                                    //Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)

                                    var rte1 = new richTextEditor('desc');
                                    rte1.html = '<?php echo rteSafe(stripslashes($_row['mail_body'])) ?>';
                                    rte1.width = 570;
                                    rte1.height = 300;
                                    rte1.build();
                                    //-->
                                </script>
                            </div>
                        </dd></dl>
                    <dl> 
                        <dt>&nbsp;</dt>
                        <dd>
                            <ul class="actions-left">
                                <li><a class="button red" style=" height: 15px;  margin-top: 3px;  padding-top: 7px !important;" href="<?php echo base_path; ?>MyCP/emailmanager.php" id="reset-validate-form" >Cancel</a></li>
                            </ul>
                            <ul class="actions-right">
                                <li>
                                    <input style="width:100px;margin-right:20px" type="submit" class="button"  name="btnsubmit" id="btnsubmit" value=" Update " />
                                </li>
                            </ul>

                        </dd></dl>


                </form>

            </div>
            <div class="clear"></div> 
        </div>
    </div>

</div>
<?php include("footer.php"); ?>
