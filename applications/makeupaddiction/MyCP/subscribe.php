<?php
$PageTitle = "Manage Users";
include('header.php');
require_once('../includes/user.class.php');
$USER = new USER_CLASS;

$where = " WHERE 1 ";
$PAGE_SIZE = 10;

if (isset($_REQUEST['mode']) && intval($_REQUEST['id']) > 0 && $_REQUEST['mode'] == 'delete') {

	$id = intval($_REQUEST['id']);
	$sqlselect1 = "SELECT * FROM subscribe WHERE id = '" . $id . "'";
	$queryse1 = $db->query($sqlselect1);
	$rsCount = $queryse1->size();

	try {
		$db->begainTransaction();

		if ($rsCount > 0) {
			$db->query("delete from subscribe where id =" . $id);
			$db->commit();
			$_SESSION["msg"] = "Successfully deleted.";
		}
	} catch (Exception $e) {
		$db->rollBack();
		$_SESSION['errormsg'] = "We are sorry.Something goes wrong, please try again.<br>";
	}
	cheader('subscribe.php');
}

if (isset($_REQUEST['email']) && trim($_REQUEST['email']) != '') {
	$email = security(trim($_REQUEST['email']));
	$where .= " and UPPER(email) like '%" . strtoupper($email) . "%' ";
}
?>
<style>
    #managetable tbody td{vertical-align:top !important;}
    .sendcheckbox{ float:none !important; width:auto !important;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_path ?>css/popup_box.css" />


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
        <h3 style="cursor: s-resize;">Manage Subsriber</h3>

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

        <div style="padding-left:5px; padding-right:5px">
            <div>
                <form action="subscribe.php" method="get">
                    <table cellpadding="2" cellspacing="2" width="100%">
                        <tr>
                            <td colspan="7"><h3>Search By</h3></td>
							<td>
							<?php		
								$var	=	"&page@subscribers.php&name@subscribers.pdf";
								$var	= 	base64_encode( $var );
								$var 	=	urlencode($var);
								?>
								<div style="float:right;margin-top: 5px;">
								 <a href="<?php echo base_path?>MyCP/print/mainexport.php?type=pdf&var=<?php echo $var;?>">
									 <i class="fa fa-download"></i> PDF File ||</a>
								 <a href="<?php echo base_path?>MyCP/print/mainexport.php?type=excel&var=<?php echo $var;?>">
									  <i class="fa fa-download"></i> excel File</a>
									  </div>
							</td>
                        </tr>
                        <tr>
                            <td width="13%" align="right">Email</td>
                            <td width="10%" align="left">
                                <input type="text" name="email" value="<?php echo $email ?>" />
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
			$sql = "SELECT * FROM subscribe " . $where;



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

						case "email":
							$orderBy = " email ";
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
			$qStr = $_SERVER['PHP_SELF'] . "?pageindex=" . $pageindex . "&so=" . $so . "&pagesize=" . ($pagesize) . "&email=" . $_GET["email"];
			$qStrPageSize = $_SERVER['PHP_SELF'] . "?pageindex=" . $pageindex . "&so=" . $so . "&oby=" . $_GET["oby"] . "&email= " . $_GET["email"];
			?>

			<table border="1" width="100%" id="managetable">
				<thead>
                    <tr>
                        <th width="80" height="">Sr.No</th>
                        <th width="250">
				<div align="left">
					<a href="<?php echo $qStr . '&oby=' . 'email' ?>">Email <?php if ($_GET['oby'] == 'email') echo '<img src="' . base_path . 'MyCP/images/' . strtolower($so) . '.gif" />'; ?></a>
				</div>
				</th>
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
							?>
							<tr>
								<td height="30px;" valign="top"><?php echo $i; ?></td>
								<td valign="top"><?php echo unEscapeChars($row['email']) ?></td>
								<td valign="top">
									<a href="subscribe.php?id=<?php echo $row['id']; ?>&mode=delete" onclick="return confirmDelete()" title="Delete"><img src="<?php echo base_path ?>MyCP/images/dd.gif" /></a>
								</td>

							</tr>
							<?php
						}
					} else {
						?>
						<tr><td colspan="7"><center>Record not found.</center></td></tr>
				<?php }
				?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="7"><div class="pagination">
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
									$url = $_SERVER['PHP_SELF'] . "?so=" . $_GET["so"] . "&pagesize=" . ($pagesize) . "&oby=" . $_GET["oby"] . "&email=" . $_GET["email"];
									echo getPagingHtml($resultCount, $pagesize, $pageindex, $url)
									?>
								</div>
							</div></td>
					</tr>
				</tfoot>
			</table>

            <div style="clear:both"></div>

        </div>
    </div>
    <div class="clear"></div> 
</div>
<?php include("footer.php"); ?>