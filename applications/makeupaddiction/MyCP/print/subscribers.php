<?php
require_once('../../includes/app_top.php');
// Include MySQL class
require_once('../../includes/mysql.class.php');
// Include database connection
require_once('../../includes/global.inc.php');
// Include general functions
require_once('../../includes/functions_general.php');
// Include mail functions
// Start the session
require_once('../../includes/export.class.php');
require_once('../../includes/user.class.php');
$USER	=	new USER_CLASS;
$exp=new EXPORT_CLASS;
$base_sql	=	"SELECT * FROM subscribe WHERE 1 order by id desc";
$res		=	$db->query($base_sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Site Report</title>
<style>
table{font-family:Arial, Helvetica, sans-serif;}
table tr{padding:10px;font-family:Arial, Helvetica, sans-serif;}
table tr td{padding:10px;font-family:Arial, Helvetica, sans-serif;}
table tr th{padding:10px;font-family:Arial, Helvetica, sans-serif;}
</style>
</head>
<body>
	<table border="1px" cellpadding="0px" cellspacing="0px;">
    	<tr>
        	<th style="width:1%;" >Sr.No.</th>
            <th style="width:90%;text-align: left;" >Email Address</th>
        </tr>
        <?php 
		if($res->size()>0) {
			$i=0;
			while($row=$res->fetch()) {
				
				$i=$i+1;
				
				?>
				<tr>
					<td style="width:1%;"><?php echo $i; ?></td>
					<td style=""><?php echo $row['email']; ?></td>
				</tr>
				<?php 
			}
		} else { ?>
			<tr><td colspan="2">Record not found.</td></tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
if ($_REQUEST['tp']=='excel')
	$exp->exportWithPage("subscribers.php","subscribers.xls");



?>

