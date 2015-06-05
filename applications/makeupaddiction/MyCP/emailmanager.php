<?php
$PageTitle = "Notification Email Manager";
include('header.php');

$USER = new MISC_CLASS;


$PAGE_SIZE = 10;



if (isset($_REQUEST['mode']) && intval($_REQUEST['id']) > 0 && $_REQUEST['mode'] == 'delete') {

    $id = intval($_REQUEST['id']);

    $sqlselect1 = " SELECT * FROM faiths WHERE " .
            " id = '" . $id . "'";
    $queryse1 = $db->query($sqlselect1);
    $rsCount = $queryse1->size();

    if ($rsCount > 0) {
        $db->query("DELETE FROM faiths where id = '" . $id . "' ");
        $_SESSION["msg"] = "Successfully deleted.";
    }

    cheader('faith.php');
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
            <a href="<?php echo base_path ?>MyCP/add-faith.php"  class="inner-link" style="cursor:pointer;"> Add Faith</a>
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
            $sql = "select * from mail_body where status = 1 ORDER BY _order";

            $resultA = $db->query($sql);
            $rsCount = $resultA->size();
            if ($rsCount > 0) {

                $queryB = $sql;
                $resultB = $db->query($queryB);
                ?>

                <table border="1" width="100%" id="managetable">
                    <thead>
                        <tr>
                            <th width="20%"><div align="left">S.No</div></th>
                    <th width="70%"><div align="left">E-Mail Type </div> </th>
                    <th width="10%"><div align="left">Edit</div></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $db->query($sql);
                        $i = $pagesize * ($pageindex - 1);
                        while ($row = $resultB->fetch()):
                            $i++;
                            if ($i % 2)
                                $bgcolor = $row_over_alternate_color;
                            else
                                $bgcolor = "#FBFCFC";
                            ?>
                            <tr id="Row<?php echo $i ?>" bgcolor="<?php echo $bgcolor ?>" onMouseOver="this.bgColor = '<?php echo $row_over_color ?>'" onMouseOut="this.bgColor = '<?php echo $bgcolor ?>'" height="25px">

                                <td align="center" class="text-red"><?php echo $i ?></td>

                                <td class="text-red">
                                    <?php echo ($row['subject']) ?>
                                </td>
                                <td class="text-red">
                                    <a href="<?php echo base_path ?>MyCP/compose-mail.php?email=<?php echo base64_encode($row['id']); ?> ">
                                        <img border="0" alt="Edit" src="<?php echo base_path ?>MyCP/images/pencil.png">

                                    </a>
                                </td>


                            </tr>
                            <?php
                        endwhile;
                    } else
                        echo "<tr><td><div align='center'><br><br><br>Record(s) not found in given search criteria.<br><br><br></div></td></tr>";
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
                                    $url = $_SERVER['PHP_SELF'] . "?so=" . $_GET["so"] . "&pagesize=" . ($pagesize) . "&oby=" . $_GET["oby"] . "&faith=" . $_GET["faith"];
                                    echo getPagingHtml($resultCount, $pagesize, $pageindex, $url)
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>

            <div style="clear:both"></div>

        </div>
    </div>
    <div class="clear"></div> 
</div>
<?php include("footer.php"); ?>