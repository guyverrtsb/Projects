<?php
$PageTitle = "User Detail";
include('header.php');
//require_once '../services/ws-post.php';
//require_once '../services/ws-tribe.php';
$USER = new MISC_CLASS;


$userid = base64_decode($_GET['userid']);

if ($userid <= 0) {
    cheader("welcome.php");
}

$sql = "select * from users WHERE" .
        " userid = '" . $userid . "'";
$result1 = $db->query($sql);
if ($result1->size() <= 0) {
    cheader("welcome.php");
}
$row = $result1->fetch();


$path = $row['user_thumbimage'];
if ($path == '') {
    $path = 'uploads/default_img.png';
}
?>

<!--******************************Interface*****************************-->
<style>
    td{
        width: 20%;
        text-align: justify;
    }
</style>
<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">
        <h3 style="cursor: s-resize;"> 
            <a href="<?php echo base_path . 'MyCP/welcome.php'; ?>">Dashboard</a> >
            <a href="<?php echo base_path . 'MyCP/manage-users.php'; ?>">Users</a> >
            User Detail </h3>
    </div>
    <div class="clear"></div>
    <div class="content-box-content">
        <div style="display: block;" class="tab-content default-tab" id="tab1">

            <div  class="Registerinner">

                <table width="100%" border="0" class="bx_tbl">
                    <tbody>
                        <tr>
                            <td align="left" valign="middle"><label for=textfield>Name</label></td>
                            <td align="left" valign="middle"><?php echo $row['fname']." ".$row['lname']; ?></td>
                        </tr>
						<tr>
                            <td align="left" valign="middle"><label for=textfield>User Name</label></td>
                            <td align="left" valign="middle"><?php echo $row['user_name']; ?></td>
                        </tr>

                        <tr>
                            <td align="left" valign="middle"><label for=textfield>Email</label></td>
                            <td align="left" valign="middle"><?php echo $row['email']; ?></td>
                        </tr>
                        
                        <tr>
                            <td align="left" valign="middle"><label for=textfield>Gender</label></td>
                            <td align="left" valign="middle"><?php echo $row['gender']; ?></td>
                        </tr>
						 <tr>
                            <td align="left" valign="middle"><label for=textfield>User Bio</label></td>
                            <td align="left" valign="middle"><?php echo $row['user_bio']; ?></td>
                        </tr>
						
						
                        

                        
                        <tr>
                            <td align="left" valign="middle"><label for=textfield>Status</label></td>
                            <td align="left" valign="middle"><?php echo $row['status']==1?'ACTIVE':'INACTIVE'; ?></td>
                        </tr>

                        <tr>
                            <td align="left" valign="middle"><label for=textfield>Photo</label></td>
                            <td align="left" valign="middle"><img src="<?php echo base_path . $path ?>" width="70" height="70"/></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
