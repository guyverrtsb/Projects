<?php
$PageTitle = "Manage Member";
include('header.php');


$USER = new MISC_CLASS;

$where = " WHERE 1 ";
$PAGE_SIZE = 10;

$id  	  =  base64_decode($_GET['id']);
$sql      =  " SELECT * FROM member WHERE ".
             " id = '".$id."' limit 1";
$result   =  $db->query($sql);
$resultCount            =  $result->size();



$row = $result->fetch();

 

if (isset($_REQUEST['mode']) && intval($_REQUEST['id']) > 0 && $_REQUEST['mode'] == 'delete') {

    $id = intval($_REQUEST['id']);

    $sqlselect1 =   " SELECT * FROM member WHERE ".
                    " id = '" . $id . "'";
    $queryse1 = $db->query($sqlselect1);
    $rsCount = $queryse1->size();

        if ($rsCount > 0) {
            $db->query("DELETE FROM member where id = '" . $id . "' ");
            $_SESSION["msg"] = "Successfully deleted.";
        }
    
    cheader('member.php');
}


?>
<style>
    #managetable tbody td{vertical-align:top !important;}
    .sendcheckbox{ float:none !important; width:auto !important;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_path ?>MyCP/css/popup_box.css" />


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
        <span style="float: right;margin: 10px 10px ">
            <a href="<?php echo base_path ?>MyCP/add-member.php"  class="inner-link" style="cursor:pointer;"> Add Member</a>
        </span>
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
      

        <div class="Registerinner">
            <?php
            $so = "DESC";
            $sql = "SELECT * FROM member " . $where;

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


                        case "country":
                            $orderBy = " country ";
                            break;
                        
                   
                        default:
                            $orderBy = "id";
                    }
                    $queryB = $sql . " order by " . $orderBy . " $so $limitstr";
                } else {
                    $queryB = $sql . " ORDER BY id $limitstr";
                }

                $resultB = $db->query($queryB);
            }
            $qStr = $_SERVER['PHP_SELF'] . "?pageindex=" . $pageindex . "&pagesize=" . ($pagesize) . "&so=" . $so .  "&country=" . $_GET["country"];
            $qStrPageSize = $_SERVER['PHP_SELF'] . "?pageindex=" . $pageindex . "&so=" . $so . "&oby=" . $_GET["oby"] . "&country=" . $_GET["country"];
            ?>

            <table border="1" width="100%" id="managetable">
                <thead>
                    <tr>
                        <th  width="5%">Sr.No</th>
                        <th width="10%">Image</th>
                        <th width="20%">Member ID</th>
                        <th width="20%">Name</th>
                        <th width="20%">Email</th>
                        <th width="10%">phone</th>
                        <th width="10%">Location</th>
                        <th width="10%">Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultCount > 0) {
                        $result = $db->query($sql);
                        $i = $pagesize * ($pageindex - 1);
                        while ($row = $resultB->fetch()) {
                            $i++;
                            
                            ?>
                            <tr>
                                <td height="30px;" valign="top"><?php echo $i; ?></td>
                                <td valign="top"><img src="<?php echo base_path.$row['member_image'] ?>" width="50" /></td>
                                <td valign="top"><?php echo $row['member_id'] ?></td>
                                <td valign="top"><?php echo $row['member_name'] ?></td>
                                <td valign="top"><?php echo $row['member_email'] ?></td>
                                <td valign="top"><?php echo $row['member_phone'] ?></td>
                                <td valign="top"><?php echo $row['member_location'] ?></td>
                                <td valign="top">
                                    <a href="<?php echo base_path ?>MyCP/add-member.php?id=<?php echo base64_encode($row['id']); ?>&mode=edit"  class="inner-link" style="cursor:pointer;"> <img src="<?php echo base_path ?>MyCP/images/pencil.png" border="0" alt="Edit" /></a>
                                    <a href="<?php echo base_path ?>MyCP/member.php?id=<?php echo $row['id']; ?>&mode=delete" onclick="return confirmDelete()" title="Delete"><img src="<?php echo base_path ?>MyCP/images/dd.gif" /></a>
                                </td>

                            </tr>
                            <?php
                        }
                 
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <div class="pagination">
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
                                    $url = $_SERVER['PHP_SELF'] . "?so=" . $_GET["so"] . "&pagesize=" . ($pagesize) . "&oby=" . $_GET["oby"] . "&country=" . $_GET["country"];
                                    echo getPagingHtml($resultCount, $pagesize, $pageindex, $url)
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
                 <?php
                } else {
                ?>
                <tr><td colspan="10"><center>Record not found.</center></td></tr>
                <?php
                }
                ?>
            </table>

            <div style="clear:both"></div>

        </div>
    </div>
    <div class="clear"></div> 
</div>
<?php include("footer.php"); ?>