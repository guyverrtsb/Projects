<?php $PageTitle = "Manage Users";
include('header.php');

$USER = new MISC_CLASS;

$where = " WHERE 1 ";
$PAGE_SIZE = 10;

if (isset($_REQUEST['mode']) && intval($_REQUEST['user']) > 0 && $_REQUEST['mode'] == 'delete') {

    $userid = intval($_REQUEST['user']);

    $sqlselect1 = " SELECT * FROM users WHERE " .
            " userid = '" . $userid . "'";
    $queryse1 = $db->query($sqlselect1);
    $row = $queryse1->fetch();
    

    try {
        $db->begainTransaction();

            $sql = " DELETE FROM post WHERE " .
                    " user_id = '" . $userid . "'";
            $db->query($sql);
       
  $sql = " DELETE FROM users WHERE " .
                    " userid = '" . $userid . "'";
            //$db->query($sql);
       
        

        $sql = " DELETE FROM post_report WHERE user_id = '" . $userid . "'";
        $db->query($sql);
        
        $db->query("delete from `activity_log` where activity_user='$userid' or notify_to='$userid'");
        $db->query("delete from `notification_settings` where user_id='$userid' ");
        $db->query("delete from `subscriptions` where user_id='$userid' ");
        $db->query("delete from `user_block` where user_id='$userid'  or block_user_id='$userid'");
        $db->query("delete from user_devices where user_id='$userid'  ");
        $db->query("delete from user_follow where follow_to='$userid' or follow_from='$userid' ");
        $sql = " DELETE FROM tagged_users WHERE user_id = '" . $userid . "'";
        $db->query($sql);
       
        
        $sql = " DELETE FROM post_comment WHERE user_id = '" . $userid . "'";
        $db->query($sql);

       

        $sql = " DELETE FROM post_like WHERE user_id = '" . $userid . "'";
        $db->query($sql);

       

        $sql = " DELETE FROM post WHERE user_id = '" . $userid . "'";
        $db->query($sql);

       

       /* $albPath = "../photos/" . $userid;

        rrmdir($albPath);*/
echo " DELETE FROM users WHERE userid = '" . $userid . "' ";

        $db->query(" DELETE FROM users WHERE userid = '" . $userid . "' ");
        $db->commit();
          $_SESSION["msg"] = "Successfully deleted.";
    } catch (Exception $e) { 
          $_SESSION["errormsg"] = "user not deleted try again.";
        $msg = $e->getMessage();print_r($msg);die;
        $db->rollback();
    }

//    $_SESSION["msg"] = "Successfully deleted.";

    cheader('manage-users.php');
}


if (($_REQUEST["mode"] == "status") && intval($_REQUEST['user_id'] > 0)) {

    $user_no = intval($_REQUEST["user_id"]);
    $status = $_REQUEST["stat"];

    if (strtoupper($status) == 'ACTIVE') {
        $db_status = 1;
    } else if (strtoupper($status) == 'SUSPEND') {
        $db_status = 0;
    }


    $sql = " UPDATE users SET status='" . $db_status . "' " .
            " WHERE userid=" . $user_no;
    $db->query($sql);
    $_SESSION["msg"] = "User updated successfully.";
    cheader("manage-users.php");
}

if (isset($_REQUEST['name']) && trim($_REQUEST['name']) != '') {
    $name = security(trim($_REQUEST['name']));
    $where .= " and user_name like '%" . ($name) . "%' ";
}

if (isset($_REQUEST['email']) && trim($_REQUEST['email']) != '') {
    $email = security(trim($_REQUEST['email']));
    $where .= " and UPPER(email) like '%" . strtolower($email) . "%' ";
}
if (isset($_REQUEST['userid']) && trim($_REQUEST['userid']) != '') {
    $userid = security(trim($_REQUEST['userid']));
    $where .= " and userid = '".$userid."' ";
}
//if (isset($_REQUEST['mobile']) && trim($_REQUEST['mobile']) != '') {
//    $mobile = security(trim($_REQUEST['mobile']));
//    $where .= " and mobile like '%" . $mobile . "%' ";
//}


if (isset($_REQUEST['type']) && trim($_REQUEST['type']) != '') {
    $type = security(trim($_REQUEST['type']));
    if ($type == 'today')
        $where .= " and dtdate like '%" . date("Y-m-d") . "%' ";
}

?>
<style>
    #managetable tbody td{vertical-align:top !important;}
    .sendcheckbox{ float:none !important; width:auto !important;}
</style>
<link rel="stylesheet" type="text/css" href="<?php //echo base_path ?>MyCP/css/popup_box.css" />


<script src="<?php echo base_path ?>js/popup.js" type="text/javascript"></script>
<script>

    function confirmDelete()
    {
        var agree = confirm("Are you sure you want to delete this?");
        if (agree)
            return true;
        else
            return false;
    }
    function confirmStatus()
    {
        var agree = confirm("Are you sure you want to change user's status?");
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

</script>

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">
        <h3 style="cursor: s-resize;">
            <a href="<?php echo base_path . 'MyCP/welcome.php'; ?>">Dashboard</a> >
            <?php echo $PageTitle; ?>
        </h3>

        <div class="clear"></div>
    </div>

    <div class="content-box-content">
        <?php
        $ERROR_MSG = isset($_SESSION["errormsg"]) ? $_SESSION["errormsg"] : '';
        $MSG = isset($_SESSION["msg"]) ? $_SESSION["msg"] : '';
        if ($ERROR_MSG != "") {
            ?>
            <div class="notification error png_bg"> <a class="close" href="javascript:showDetails('msgError');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>images/cross.png"></a>
                <div><?php echo $ERROR_MSG; ?></div>
            </div>
        <?php } elseif ($err_msg != '') {
            ?>

            <div class="notification error png_bg" id="msgError"> <a class="close" href="javascript:showDetails('msgError');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>images/icons/cross.png"></a>
                <div><?php echo $err_msg; ?></div>

            </div>
        <?php } elseif ($MSG != "") {
            ?>
            <div class="notification success png_bg"> <a class="close" href="javascript:showDetails('msgOk');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>images/cross.png"></a>
                <div><?php echo $i; ?><?php echo $MSG; ?></div>
            </div>
            <?php
        }

        unset($_SESSION["errormsg"]);
        unset($_SESSION["msg"]);
        ?>  
        
        <!--Search Div-->

        <div style="">
            <div>
                <form action="manage-users.php" method="get">
                    <table cellpadding="2" cellspacing="2" width="100%">
                        <tr>
                            <td colspan="7"><h3>Search By</h3></td>
                        </tr>
                        <tr>
                            <td  align="right">Name</td>
                            <td  align="left">
                                <input type="text" name="name" value="<?php echo $name ?>" />
                            </td>
                            <td  align="right">Email</td>
                            <td align="left">
                                <input type="text" name="email" value="<?php echo $email ?>" />
                            </td>
                            <td  align="right">Member ID</td>
                            <td align="left">
                                <input type="text" name="userid" value="<?php echo $userid ?>" />
                            </td>
                            <td>
                                <input  class="button" type="submit" name="btngo" value="Search" style="padding:0px; width:100px; margin-top:5px"/>
                            </td>
                        </tr>

                        
                    </table>
                </form>
            </div>
        </div>
        <!--Search Div-->
 
        <div class="Registerinner">
            <?php
            $so = "DESC";
            $sql = "SELECT * FROM users " . $where;

            $res = $db->query($sql);
            $resultCount = $res->size();
            $so = "DESC";
            if ($resultCount > 0) {


                if (!isset($_GET['pagesize']))
                    $pagesize = $PAGE_SIZE;
                else {
                    if (intval($_GET['pagesize']) <= 0)
                        $pagesize = $PAGE_SIZE;
                    else
                        $pagesize = intval($_GET['pagesize']);
                }

                if (!isset($_GET['pageindex']))
                    $pageindex = 1;
                else {
                    if (intval($_GET['pageindex']) <= 0)
                        $pageindex = 1;
                    else
                        $pageindex = intval($_GET['pageindex']);
                }
                $totalpages = ceil($resultCount / $pagesize);
                $limitstr = "limit " . ($pageindex - 1) * $pagesize . ", " . $pagesize;
                $rcount = $pageindex * $pagesize;

                if (isset($_GET["so"])) {
                    $so = $_GET["so"];
                    if ($so == "ASC")
                        $so = "DESC";
                    else
                        $so = "ASC";
                } else
                    $so = "ASC";

                if (isset($_GET["oby"]) && $_GET["oby"] != "") {
                    switch ($_GET["oby"]) {


                        case "userid":
                            $orderBy = " userid ";
                            break;
                        case "user_name":
                            $orderBy = " user_name ";
                            break;

                        case "email":
                            $orderBy = " email ";
                            break;
                    
                        case "login_type":
                            $orderBy = " login_type ";
                            break;

                        default:
                            $orderBy = "id";
                    }
                    $queryB = $sql . " order by " . $orderBy . " $so $limitstr";
                } else {
                    $queryB = $sql . " ORDER BY userid DESC $limitstr";
                }

                $resultB = $db->query($queryB);
            }
            $qStr = $_SERVER['PHP_SELF'] . "?pageindex=" . $pageindex . "&pagesize=" . ($pagesize) . "&so=" . $so . "&name=" . $_GET["name"] . "&email=" . $_GET["email"];
            $qStrPageSize = $_SERVER['PHP_SELF'] . "?pageindex=" . $pageindex . "&so=" . $so . "&oby=" . $_GET["oby"] . "&name=" . $_GET["name"] . "&email=" . $_GET["email"];
			
            ?>

            <table border="1" width="100%" id="managetable">
                <thead>
                    <tr>
                        <th width="50" height="">Sr.No</th>
                      
                        <th width="80" height=""><a href="<?php echo $qStr . '&oby=' . 'userid' ?>">Member ID    <?php
                        if ($_GET['oby'] == 'userid')
                            echo '<img src="' . base_path . 'MyCP/images/' . strtolower($so) . '.gif" />';
                        ?></a></th>
                         <th width="100">Image</th>
                        <th width="150">
                <div align="left">
                    <a href="<?php echo $qStr . '&oby=' . 'user_name' ?>">User Name    <?php
                        if ($_GET['oby'] == 'name')
                            echo '<img src="' . base_path . 'MyCP/images/' . strtolower($so) . '.gif" />';
                        ?></a>
                </div>
                </th>

                <th width="150"><div align="left"><a href="<?php echo $qStr . '&oby=' . 'email' ?>">Email Address    <?php
                        if ($_GET['oby'] == 'email')
                            echo '<img src="' . base_path . 'MyCP/images/' . strtolower($so) . '.gif" />';
                        ?></a></div></th>
              
                <th width="190">Added On</th>
                <th width="70">Details</th>
                <th width="100">Status</th>
                <th width="70">Edit</th>
                <th width="70">Delete</th>
                </tr>
                </thead>
                 
                <tbody>
                <?php  //echo die; ?>
                    <?php
                    if ($resultCount > 0) {
                        $result = $db->query($sql);
                        $i = $pagesize * ($pageindex - 1);
                        while ($row = $resultB->fetch()) {
                            $i++;
                            $path = $row['user_thumbimage'];
                            if ($path == '') {
                                $path = 'uploads/default_img.png';
                               
                            }
                           // require_once '../services/ws-post.php';
                            $usrid = (object) $row['userid'];
                            
                            ?>
                            <tr>
                                <td height="30px;" valign="top"><?php echo $i; ?></td>
                                <td height="30px;" valign="top"><?php echo $row['userid']; ?></td>
                                 <td valign="top"><img src="<?php echo base_path . $path ?>" width="70" height="70"/></td>
                                <td valign="top"><?php echo unEscapeChars($row['user_name'] ) ?></td>
                                <td valign="top"><?php echo unEscapeChars($row['email']) ?></td>
                               
                              
                                <td valign="top"><?php echo FormatDateTime($row['dtdate']); ?></td>
                              
                               
                                <td valign="top"> 
                                    <a href="<?php echo base_path ?>MyCP/user-detail.php?userid=<?php echo base64_encode($row['userid']); ?>"  ><i class="fa fa-eye"></i> </a>
                                </td>
                                        <td valign="top" class="text-red">
                                <?php
                                if ($row['status'] == '1') {
                                    $but_lbl = "Active";
//                                        $but_lbl = "Deactivate";
                                    $btn_cls = "button ";
                                    $but_val = 'DEACTIVATE';
                                }

                                if ($row['status'] == '0') {

                                    $but_lbl = "Suspended";
//                                        $but_lbl = "Activate";
                                    $btn_cls = "button red";
                                    $but_val = 'ACTIVE';
                                }
                                ?>
                                    <a href="<?php echo base_path ?>MyCP/manage-users.php?user_id=<?php echo $row['userid'] ?>&mode=status&stat=<?php echo $but_val; ?>"  onclick="return confirmStatus();" style="width:70px;text-align:center;" class="<?php echo $btn_cls; ?>">
                                        <?php echo $but_lbl; ?>
                                   </a>
                                                                </td>
                                <td valign="top">
                                    <a href="<?php echo base_path ?>MyCP/edit-user.php?userid=<?php echo base64_encode($row['userid']); ?>"><i class="fa fa-pencil"></i></a>
                                </td>
                                <td valign="top">
                                    <a href="<?php echo base_path ?>MyCP/manage-users.php?user=<?php echo $row['userid']; ?>&mode=delete" onclick="return confirmDelete()" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="15"><div class="pagination">
                                    <div  class="align-left"><abbr>View</abbr>
                                        <select name="pagesize" onchange="Changepagesize('<?php echo $qStrPageSize ?>', this.value)">
                                            <?php
                                            $i = $PAGE_SIZE;
                                            while ($i <= $resultCount + $PAGE_SIZE) {
                                                if (($i % $PAGE_SIZE) == 0) {
                                                    if ($i == $pagesize) {
                                                        ?>
                                                        <option value="<?php echo($i); ?>" selected><?php echo($i); ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo($i); ?>" ><?php echo($i); ?></option>
                                                        <?php
                                                    }
                                                }
                                                $i = $i + $PAGE_SIZE;
                                            } // end of for loop
                                            ?>
                                        </select>
                                        <abbr>Row(s) per page</abbr>
                                    </div>
                                    <div class="align-right">
                                        <?php
                                        $url = $_SERVER['PHP_SELF'] . "?so=" . $_GET["so"] . "&pagesize=" . ($pagesize) . "&oby=" . $_GET["oby"] . "&name=" . $_GET["name"] . "&email=" . $_GET["email"];
                                        echo getPagingHtml($resultCount, $pagesize, $pageindex, $url)
                                        ?>
                                    </div>
                                </div></td>
                        </tr>
                    </tfoot>
                    <?php
                } else {
                    ?>
                    <tr><td colspan="15"><center>Record not found.</center></td></tr>
                    <?php
                }
                ?>
            </table>

            <div style = "clear:both"></div>

        </div>
       
    </div>
    <div class = "clear"></div>
</div>

<?php include("footer.php"); ?>