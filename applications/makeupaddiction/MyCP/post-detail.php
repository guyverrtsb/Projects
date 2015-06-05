<?php
$PageTitle = "Post Detail";
include('header.php');
//require_once '../services/ws-post.php';
$USER = new MISC_CLASS;

$post_id = base64_decode($_GET['post_id']);

if ($post_id <= 0) {
    cheader("welcome.php");
}

$sql = " SELECT * FROM post WHERE" .
        " post_id = '" . $post_id . "' ";
$result1 = $db->query($sql);
if ($result1->size() <= 0) {
    cheader("welcome.php");
}


$row = $result1->fetch();
$post_type = $row['category'];

$user = $USER->getUserInfo($row['user_id']);

$path = $user['user_thumbimage'];
if ($path == '') {
    $path = 'uploads/default_img.png';
}

?>

<style>
    td {
        width: 10%;
        text-align: justify;
    }
</style>
<!--******************************Interface*****************************-->

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">
        <h3 style="cursor: s-resize;">
            <a href="<?php echo base_path . 'MyCP/welcome.php'; ?>">Dashboard</a> >
            <a href="<?php echo base_path . 'MyCP/post.php'; ?>">Post</a> >
            Post Detail </h3>
    </div>
    <div class="clear"></div>
    <div class="content-box-content">
        <div style="display: block;" class="tab-content default-tab" id="tab1">

            <div  class="Registerinner">
                <table width="100%" border="0" class="bx_tbl">
                    <tbody>
                        <tr>
                            <td align="left" valign="middle"><label for="textfield">UserName</label></td>
                            <td align="left" valign="middle"><?php echo $user['user_name'] ; ?></td>
                        </tr>

                        <tr>
                            <td align="left" valign="middle"><label for="textfield">User Email</label></td>
                            <td align="left" valign="middle"><?php echo $user['email']; ?></td>
                        </tr>
                        <tr>
                            <td align="left" valign="middle"><label for="textfield">User Photo</label></td>
                            <td align="left" valign="middle"><img src="<?php echo base_path . $path ?>" width="70" height="70"/></td>
                        </tr>
                        

                        
                        <tr>
                            <td align="left" valign="middle"><label for="textfield">Post Title</label></td>
                            <td align="left" valign="middle"><?php 
                             $arr =   array("+","%26");
                             $replacearray    =   array(" ","&" );
                             $title   = str_replace($arr, $replacearray, $row['title']);
                             echo $title;
                             ?></td>
                        </tr>
                        
                        <tr>
                            <td align="left" valign="middle"><label for="textfield">Post Total comments</label></td>
                            <td align="left" valign="middle"><?php 
                            
                            echo PostComment::count("post_id='".$row['post_id']."'")->count
                          
                             ?></td>
                        </tr>
                        <tr>
                            <td align="left" valign="middle"><label for="textfield">Post total likes</label></td>
                            <td align="left" valign="middle"><?php 
                          echo PostLike::count("post_id='".$row['post_id']."'")->count
                          
                             ?></td>
                        </tr>
                        <tr>
                            <td align="left" valign="middle"><label for="textfield">Post Type</label></td>
                            <td align="left" valign="middle"><?php 
                          echo $row['data_type'];
                          
                             ?></td>
                        </tr>
                        <tr>
                            <td align="left" valign="middle"><label for="textfield">Post Photo</label></td>
                            <td align="left" valign="middle">
                                
                               <img width="70" height="70" src="<?php echo base_path . $row['thumb_image'] ?>">
                                
                                       
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
