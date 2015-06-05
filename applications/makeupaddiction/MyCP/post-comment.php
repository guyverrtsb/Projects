<?php
$PageTitle = "Manage Comments";
include('header.php');

//require_once '../services/ws-post.php';
//require_once '../services/ws-comment.php';
$USER = new MISC_CLASS;

$post_id = intval($_REQUEST['post']);

$where = " WHERE 1 AND PC.post_id = '" . $post_id . "'";
$PAGE_SIZE = 10;


if (isset($_REQUEST['mode']) && intval($_REQUEST['post']) > 0 && $_REQUEST['mode'] == 'delete') {


    $id = intval($_REQUEST['id']);
    $post_id = intval($_REQUEST['post']);

    $sql = " DELETE FROM post_comment WHERE id = '" . $id . "'";
    $db->query($sql);

    

    $_SESSION["msg"] = "Successfully deleted.";


    cheader('post.php');
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
            <a href="<?php echo base_path . 'MyCP/post.php'; ?>">Post</a> >
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


        <div class="Registerinner">
            <?php
            $so = "DESC";

            $sql = " SELECT PC.* ,P.post_id,P.category,P.thumb_image FROM post_comment AS PC "
                    . " JOIN post AS P  ON "
                    . " PC.post_id = P.post_id " . $where;


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


                        case "name":
                            $orderBy = " first_name ";
                            break;

                        case "post_type":
                            $orderBy = " post_type ";
                            break;

                        default:
                            $orderBy = "id";
                    }
                    $queryB = $sql . " order by " . $orderBy . " $so $limitstr";
                } else {
                    $queryB = $sql . " ORDER BY id DESC $limitstr";
                }

                $resultB = $db->query($queryB);
            }
            $qStr = $_SERVER['PHP_SELF'] . "?pageindex=" . $pageindex . "&pagesize=" . ($pagesize) . "&so=" . $so . "&name=" . $_GET["name"] . "&post_type=" . $_GET["post_type"];
            $qStrPageSize = $_SERVER['PHP_SELF'] . "?pageindex=" . $pageindex . "&so=" . $so . "&oby=" . $_GET["oby"] . "&name=" . $_GET["name"] . "&post_type=" . $_GET["post_type"];
            ?>

            <table border="1" width="100%" id="managetable">
                <thead>
                    <tr>
                        <th width="80" height="">Sr.No</th>
                        <th width="150"><div align="left">UserName </div></th>
                <th width="150"><div align="left">Post Type</div></th>
                <th width="150">Post Image</th>
                <th width="150">comment</th>
                <th width="100">Delete</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultCount > 0) {
                        $result = $db->query($sql);
                        $i = $pagesize * ($pageindex - 1);
                        while ($row = $resultB->fetch()) {
                            $i++;
                            //$photo = $row['thumb_image'];

                            $path = $row['thumb_image'];

                            if ($path == '') {
                                $path = 'uploads/default_img.jpg';
                            }

                            $user = $USER->getUserInfo($row['user_id']);
                            ?>
                            <tr><td height="30px;" valign="top"><?php echo $i; ?></td>

                                <td valign="top"><?php echo unEscapeChars($user['name']) ?></td>
                                <td valign="top"><?php echo unEscapeChars(ucfirst(strtolower($row['category']))) ?></td>
                                <td valign="top"><img src="<?php echo base_path . $path ?>" width="70" height="70"/></td>
                                <td valign="top">
                                    <?php echo $row['comment']; ?>
                                </td>
                                <td valign="top">
                                    <a href="<?php echo base_path ?>MyCP/post-comment.php?post=<?php echo $row['post_id']; ?>&id=<?php echo $row['id']; ?>&mode=delete" onclick="return confirmDelete()" title="Delete"><img src="<?php echo base_path ?>MyCP/images/dd.gif" /></a>
                                </td>

                            </tr>
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
                                        $url = $_SERVER['PHP_SELF'] . "?so=" . $_GET["so"] . "&pagesize=" . ($pagesize) . "&oby=" . $_GET["oby"] . "&name=" . $_GET["name"] . "&post=" . $_GET["post"];
                                        echo getPagingHtml($resultCount, $pagesize, $pageindex, $url)
                                        ?>
                                    </div>
                                </div></td>
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

            <div style = "clear:both"></div>

        </div>
    </div>
    <div class = "clear"></div>
</div>
<?php include("footer.php");
?>