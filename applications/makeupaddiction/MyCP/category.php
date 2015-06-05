<?php
$PageTitle = "Category";
include('header.php');
$USER = new MISC_CLASS;

$where = " WHERE 1 ";
$PAGE_SIZE = 10;

if (isset($_REQUEST['mode']) && intval($_REQUEST['catid']) > 0 && $_REQUEST['mode'] == 'delete') {

    $catid = intval($_REQUEST['catid']);

    
       

        

        $sql = " DELETE FROM category WHERE cat_id = '" . $catid . "'";
        $db->query($sql);

       

        

       

       /* $albPath = "../photos/" . $userid;

        rrmdir($albPath);*/


      

    $_SESSION["msg"] = "Successfully deleted.";


    cheader('category.php');
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
    $where .= " and (cat_name) like '%" . ($name) . "%' ";
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
<h3 style="float: right;"><a href="add-category.php" class="button"><i class="fa fa-plus"></i> Add Category</a></h3>
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
                <form action="category.php" method="get">
                    <table cellpadding="2" cellspacing="2" width="100%">
                        <tr>
                            <th colspan="7"><h3>Search By</h3></th>
                        </tr>
                        <tr>
                            
                            <td  align="left" style="text-align:center;">Name &nbsp;
                                <input type="text" name="name" value="<?php echo $name ?>" />
                            
                                <input  class="button" type="submit" name="btngo" value="Search" style="padding:0px; width:100px; margin-left:3px; margin-top:5px"/>
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
            $sql = "SELECT * FROM category " . $where;

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
                        case "name":
                            $orderBy = " first_name ";
                            break;

                        case "email":
                            $orderBy = " email ";
                            break;
                    
                        case "login_type":
                            $orderBy = " login_type ";
                            break;

                        default:
                            $orderBy = "cat_id";
                    }
                    $queryB = $sql . " order by " . $orderBy . " $so $limitstr";
                } else {
                    $queryB = $sql . " ORDER BY cat_id DESC $limitstr";
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
                        <th width="250" height=""><a href="<?php echo $qStr . '&oby=' . 'userid' ?>">Name    <?php
                        if ($_GET['oby'] == 'userid')
                            echo '<img src="' . base_path . 'MyCP/images/' . strtolower($so) . '.gif" />';
                        ?></a></th>
                        
                        
  <th width="100">Category Image</th>
               
                <th width="70">Edit</th>

                <th width="70">Delete</th>
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
                                <td height="30px;" valign="top"><?php echo $row['cat_name']; ?></td>
                                
                               <td height="30px;" valign="top"><?php if($row['cat_img']!=''){ ?><img src="<?php echo base_path.$row['cat_img']; ?>" width="50px" height="50px" style="border:1px solid;" /><?php } ?></td>
                               
                               
                                       
                                <td valign="top">
                                    <a href="<?php echo base_path ?>MyCP/add-category.php?catid=<?php echo base64_encode($row['cat_id']); ?>"><i class="fa fa-pencil"></i></a>
                                </td>
                                <td valign="top">
                                    <a href="<?php echo base_path ?>MyCP/category.php?catid=<?php echo $row['cat_id']; ?>&mode=delete" onclick="return confirmDelete()" title="Delete"><i class="fa fa-trash-o"></i></a>
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
<?php include("footer.php");
?>