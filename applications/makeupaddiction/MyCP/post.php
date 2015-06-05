<?php
$PageTitle = "Manage Posts";
include('header.php');
//require_once '../services/ws-post.php';
$USER = new MISC_CLASS;

$where = " WHERE 1 ";
$PAGE_SIZE = 10;

if (isset($_REQUEST['mode']) && intval($_REQUEST['post']) > 0 && $_REQUEST['mode'] == 'delete') {

    $post_id = intval($_REQUEST['post']);
    $user_id = intval($_REQUEST['user']);


    $sqlselect1 = " SELECT * FROM post WHERE " .
            " post_id = '" . $post_id . "'";
    $queryse1 = $db->query($sqlselect1);
    $row = $queryse1->fetch();
    $post_type = $row['post_type'];

    try {
        $db->begainTransaction();

        

        $sql = " DELETE FROM post_report WHERE post_id = '" . $post_id . "'";
        $db->query($sql);
        
        $sql = " DELETE FROM hashtags WHERE relative_id = '" . $post_id . "' and type='post'";
        $db->query($sql);
      
        $sql = " DELETE FROM tagged_users WHERE relative_id = '" . $post_id . "' and type='post'";
        $db->query($sql);
        
        $sql = " DELETE FROM post_comment WHERE post_id = '" . $post_id . "'";
        $db->query($sql);

        

        $sql = " DELETE FROM post_like WHERE post_id = '" . $post_id . "'";
        $db->query($sql);




        $sql = " DELETE FROM post WHERE post_id = '" . $post_id . "'";
        $db->query($sql);
        $db->commit();
    } catch (Exception $e) {
        $msg = $e->getMessage();
        $db->rollback();
    }

    $_SESSION["msg"] = "Successfully deleted.";


    cheader('post.php');
}



if (isset($_REQUEST['name']) && trim($_REQUEST['name']) != '') {
    $name = security(trim($_REQUEST['name']));
    $where .= " and user_name like '%" . ($name) . "%' ";
}
if (isset($_REQUEST['post_id']) && trim($_REQUEST['post_id']) != '') {
    $post_id = security(trim($_REQUEST['post_id']));
    $where .= " and post_id = '" . ($post_id) . "' ";
}


if (isset($_REQUEST['type']) && trim($_REQUEST['type']) != '') {
    $type = security(trim($_REQUEST['type']));
    $where .= " and P.dtdate like '%" . date("Y-m-d") . "%' ";
}
if (isset($_REQUEST['title']) && trim($_REQUEST['title']) != '') {
    $title = security(trim($_REQUEST['title']));
    $where .= " and P.title like '%" . $title . "%' ";
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
        var agree = confirm("Are you sure you want to change post's status?");
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
                <form action="post.php" method="get">
                    <table cellpadding="2" cellspacing="2" width="100%">
                        <tr>
                            <td colspan="7"><h3>Search By</h3></td>
                        </tr>
                        <tr>

                            <td width="7%" align="right">UserName</td>
                            <td width="10%" align="left">
                                <input type="text" name="name" value="<?php echo $name ?>" />
                            </td>
                            <td width="4%" align="right">Title</td>
                            <td width="10%" align="left">
                                 <input type="text" name="title" value="<?php echo $title ?>" />

                            </td>
                            <td><input  class="button" type="submit" name="btngo" value="Search" style="padding:0px; width:100px; margin-top:5px"/></td>
                        </tr>

                    </table>
                </form>
            </div>
        </div>
        <!--Search Div-->

        <div class="Registerinner">
            <?php
            $so = "DESC";

          $sql = " SELECT P.*, U.email AS email, U.fname AS first_name, " .
                    " U.user_name FROM post as P INNER JOIN " .
                    " users as U ON P.user_id = U.userid " . $where;

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


                        case "user_name":
                            $orderBy = " user_name ";
                            break;

                        case "post_type":
                            $orderBy = " category ";
                            break;

                        default:
                            $orderBy = "post_id";
                    }
                    $queryB = $sql . " order by " . $orderBy . " $so $limitstr";
                } else {
                    $queryB = $sql . " ORDER BY post_id DESC $limitstr";
                }
///echo $queryB;
                $resultB = $db->query($queryB);
            }
            $qStr = $_SERVER['PHP_SELF'] . "?pageindex=" . $pageindex . "&pagesize=" . ($pagesize) . "&so=" . $so . "&name=" . $_GET["name"] . "&post_type=" . $_GET["post_type"];
            $qStrPageSize = $_SERVER['PHP_SELF'] . "?pageindex=" . $pageindex . "&so=" . $so . "&oby=" . $_GET["oby"] . "&name=" . $_GET["name"] . "&post_type=" . $_GET["post_type"];
            ?>

            <table border="1" width="100%" id="managetable">
                <thead>
                    <tr>
                        <th width="50" height="">Sr.No</th>
                        <th width="150">
                <div align="left">
                    <a href="<?php echo $qStr . '&oby=' . 'user_name' ?>">UserName    <?php
                        if ($_GET['oby'] == 'name')
                            echo '<img src="' . base_path . 'MyCP/images/' . strtolower($so) . '.gif" />';
                        ?></a>
                </div>
                </th>
             <th width="150">Post title</th>
                
                <th width="150">Post Image</th>
       
                 <th width="150">Post Date</th>
                <th width="70">Post Details</th>
<!--                <th width="150">Comments</th>
                <th width="150">Likes</th>
                <th width="150">Dislikes</th>-->
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
                         
                           
							$path	=	$row['thumb_image'];
                            if ($path == '') {
                                $path = 'uploads/default_img.png';
                            }
 
                            $user = $USER->getUserInfo($row['user_id']);
                            ?>
                            <tr><td height="30px;" valign="top"><?php echo $i; ?></td>

                                <td valign="top"><?php echo unEscapeChars($user['user_name'] ) ?></td>
                                <td valign="top"><?php echo unEscapeChars($row['title'] ) ?></td>
                                 <td valign="top"><img src="<?php echo base_path . $path ?>" width="70" height="70"/></td>
                                <td valign="top"><?php echo FormatDateNewTime($row['dtdate'] ) ?></td>
                                <td valign="top">
                                    <a href="<?php echo base_path ?>MyCP/post-detail.php?post_id=<?php echo base64_encode($row['post_id']); ?>"  ><i class="fa fa-eye"></i></a>
                                </td>
<!--                                <td valign="top"><a href="<?php echo base_path ?>MyCP/post-comment.php?post=<?php echo $row['post_id']; ?>"><?php //echo $USER->countCommentPost($row['post_id']); ?> </a></td>
                                <td valign="top">
                                    <?php //echo $USER->countLikePost($row['post_id']); ?>
                                </td>
                                <td valign="top">
                                    <?php //echo $USER->countDisLikePost($row['post_id']); ?>
                                </td>-->
                                <td valign="top">
                                    <a href="<?php echo base_path ?>MyCP/post.php?user=<?php echo $row['user_id']; ?>&post=<?php echo $row['post_id']; ?>&mode=delete" onclick="return confirmDelete()" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>

                            </tr>
                             <?php
					} } else {
                    ?>
                    <tr><td colspan="10"><center>Record not found.</center></td></tr>
                    <?php
                }
                ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8"><div class="pagination">
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
                                        $url = $_SERVER['PHP_SELF'] . "?so=" . $_GET["so"] . "&pagesize=" . ($pagesize) . "&oby=" . $_GET["oby"] . "&name=" . $_GET["name"] . "&post_type=" . $_GET["post_type"];
                                        echo getPagingHtml($resultCount, $pagesize, $pageindex, $url)
                                        ?>
                                    </div>
                                </div></td>
                        </tr>
                    </tfoot>
                  
            </table>

            <div style = "clear:both"></div>

        </div>
    </div>
    <div class = "clear"></div>
</div>
<?php include("footer.php");
?>