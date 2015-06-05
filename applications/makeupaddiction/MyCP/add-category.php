<?php
$PageTitle = "Add Category";
include('header.php');
require_once('../includes/image_lib/image.class.php');


extract($_REQUEST);

$catid = intval(base64_decode($_REQUEST['catid']));
if ($catid > 0) {
	

	
    $sqlDeal = "SELECT * FROM `category` WHERE cat_id = '" . $catid . "' ";
    $resDeal = $db->query($sqlDeal);
    if ($resDeal->size() > 0) {
        $rowDeal   =  $resDeal->fetch();
        $catid    =  $rowDeal['cat_id'];
		$cat_name    =  $rowDeal['cat_name'];
			$cat_img    =  $rowDeal['cat_img'];
		
		
		
        
		
    } else {
        cheader("category.php");

    }
}
function createDir($path) {
	return ((!is_dir($path)) ? @mkdir($path, 0777) : TRUE);
}

function checkUniqueCategory($catname,$catid)
{
	global $db;
	$sql_cat	=	"SELECT cat_name FROM category WHERE cat_name='".$catname."' AND cat_id!='".$catid."'";
	$exe_cat	=	$db->query($sql_cat);
	if($exe_cat->size()>0)
	{
		return false;
	}
	return true;
	
}

if (isset($_POST['btnsubmit'])) {

    $str = true;
	
	$cat_name	=	security(trim($_REQUEST['cat_name']));
	$catid		=	intval($_REQUEST['catid']);
	$prod_thumb_img	=	$_REQUEST['prod_thumb_img'];
	$img			=   $_FILES['cat_img']['tmp_name'];
	$img_name		=   $_FILES['cat_img']['name'];
	$img_type		=   $_FILES['cat_img']['type'];
	
		$filePath = "";
		$photo_dir = "../uploads";
		$dirCreated = (createDir($photo_dir));
		$filePath .="uploads/";
		
		$photo_dir.="/category";
		$dirCreated = (createDir($photo_dir));
		$filePath .="category/";
		
		 $img_name	=	str_replace(' ','-',$img_name); 
		
  
	if($cat_name=='')
	{
		$_SESSION["errormsg"]	.=	"Category name is a required field."."<br>";
		$str	=	false;
	}
	else if(!checkUniqueCategory($cat_name,$catid))
	{
		$_SESSION["errormsg"]	.=	"Category name should be unique.Please choose another category name."."<br>";
		$str	=	false;
	}
	
	else if($img!='') {
		if ($img_type != 'image/jpg' && $img_type != 'image/jpeg' )
		{
		
		$_SESSION["errormsg"] = "Invalid image type.Please upload only JPG,JPEG.";
		$str	=	false;
	} 
	if (count(glob($photo_dir . $img_name)) > 0) {
				$random_digit = rand(000, 999);
				$ext = pathinfo($img_name, PATHINFO_EXTENSION);
				$flName = basename($img_name, "." . $ext) . $random_digit;
				$flNameSmall = $random_digit.($flName . "-thumb." . $ext);
				$flName = $random_digit.($flName . "." . $ext);
			} else {
				$random_digit = rand(000, 999);
				$ext = pathinfo($img_name, PATHINFO_EXTENSION);
				$flName = basename($img_name, "." . $ext).$random_digit;
				$flNameSmall = $random_digit.($flName . "-thumb." . $ext);
				$flName = $random_digit.($flName . "." . $ext);
			}
			$photo_dir = $photo_dir . '/';
			$target_ori = "{$photo_dir}{$flName}";

			$target_small = "{$photo_dir}{$flNameSmall}"; 
			$bigphoto = "{$flName}";
			
			$prod_img		=	$filePath . $flName;
			$prod_thumb_img	=	$filePath . $flNameSmall;
			
		}
		else
		{
		$prod_img		=	$prod_img; 
		$prod_thumb_img	=	$prod_thumb_img; 
		}
	
		
if($str==true)
{
	if($img!='')
		{
			$IMAGE = new UPLOAD_IMAGE();
			$IMAGE->init($img);

			//move_uploaded_file($img, $target_ori);

			$extension = strrchr($target_small, '.');
			$extension = strtolower($extension);

			$IMAGE->resizeImage(200, 200, 'crop');
			$IMAGE->saveImage($target_small, 100);
		}
        if ($catid > 0) {
			
            

            $sqlUpdate =  " UPDATE category SET " .
								" cat_name   =  '" . $cat_name . "' , ".
								" cat_img   =  '" . $prod_thumb_img . "'  ".
												 	
								" WHERE cat_id        =  '".$catid."' ";

            $db->query($sqlUpdate);

            $_SESSION['msg'] = "Updated successfully.";
        } else {
			


            $sql =  " INSERT INTO category SET " .
                  " cat_name   =  '" . $cat_name . "', ".
				 " cat_img   =  '" . $prod_thumb_img . "'  ";
                   
            $db->query($sql);

            $_SESSION["msg"] = "Added successfully. ";
        }
        cheader("category.php");
}
    }


?>
<style>
							.wysihtml5-sandbox
							{
								width: 398.82px !important;
							}
						</style>
						<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<!--Load Script and Stylesheet -->
	<script type="text/javascript" src="jquery.simple-dtpicker.js"></script>
	<link type="text/css" href="jquery.simple-dtpicker.css" rel="stylesheet" />
						
<script>
	 $(document).ready(function(e) {
       /* $('#start_date').datepicker({
            changeYear: true,
            changeMonth: true,
            maxDate: '<?php echo date("Y-m-d"); ?>',
            numberOfMonths: 1,
            yearRange: '-10:+100',
            dateFormat: "yy-mm-dd "
	 

        });
		$('#end_date').datepicker({
            changeYear: true,
            changeMonth: true,
            maxDate: '<?php echo date("Y-m-d"); ?>',
            numberOfMonths: 1,
            yearRange: '-10:+100',
            dateFormat: "yy-mm-dd "
	 

        });*/
	
	
		$(function(){
			$('*[name=start_date]').appendDtpicker();
		});
		$(function(){
			$('*[name=end_date]').appendDtpicker();
		});
	
		
		<?php if($dealid>0){ ?>
		$('#prodimg').removeAttr('required','required');
		<?php } ?>
		
		});
	</script>

<!--******************************Interface*****************************-->

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">
        <h3 style="cursor: s-resize;"> 
             <a href="<?php echo base_path . 'MyCP/welcome.php'; ?>">Dashboard</a> >
             <?php 
             /*$catDetail = $USER->getMainCategorie(trim($main_id));
             $subDetail = $USER->getSubCategorie(trim($sub_id));*/
             ?>
             <a href="<?php echo base_path . 'MyCP/category.php' ?>">Catgory</a> >
             <a href="<?php echo base_path . 'MyCP/sub-faith.php?main_id='.  base64_encode($main_id);?>"><?php echo ucfirst($catDetail['faith']); ?></a> >
             <a href="<?php echo base_path . 'MyCP/child-faith.php?main_id='.  base64_encode($main_id)."&sub_id=".  base64_encode($sub_id);?>"><?php echo ucfirst($subDetail['sub_faith']); ?></a> >
    <?php echo $PageTitle; ?>
        </h3>
    </div>
    <div class="clear"></div> 


    <div class="content-box-content"> 

        <div style="display: block;" class="tab-content default-tab" id="tab1">
            <?php
            $ERROR_MSG = isset($_SESSION["errormsg"]) ? $_SESSION["errormsg"] : '';
            $MSG = isset($_SESSION["msg"]) ? $_SESSION["msg"] : '';
            if ($ERROR_MSG != "") {
                ?>
                <div class="notification errormsg png_bg"> <a class="close" href="javascript:showDetails('msgError');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>images/cross.png"></a>
                    <div><?php echo $ERROR_MSG; ?></div>
                </div>
            <?php } elseif ($MSG != "") {
                ?>
                <div class="notification success png_bg"> <a class="close" href="javascript:showDetails('msgOk');"><img alt="close" title="Close this notification" src="<?php echo base_path ?>images/cross.png"></a>
                    <div><?php echo $MSG; ?></div>
                </div>
                <?php
            }
            unset($_SESSION["errormsg"]);
            unset($_SESSION["msg"]);
            ?>
            <div class="clear"></div>
            <div  class="Registerinner">    
                <div class="cm_bx1" style="width: 100%; float: left; margin-top: 21px;">
					<form action="" method="post" name="form" id="optionform" enctype="multipart/form-data">
                    <input type="hidden" name="catid" id="catid" value="<?php echo intval($catid); ?>" />
                    <input type="hidden" name="prod_thumb_img" value="<?php echo $cat_img; ?>">
					
                  
                    
                    <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Category Name</label></div>
                        <div class="in_colRight">
                             <input type="text" class="required" placeholder="Category Name" value="<?php echo $cat_name; ?>" name="cat_name" id="cat_name" style="float:left" required="required"/>
                        </div>
                        <div class="clr"></div>
                    </div>
                    
                     <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Category Image</label></div>
                        <div class="in_colRight">
                             <input type="file" class="required" placeholder="Category Name"  name="cat_img" id="cat_img" style="float:left" />
                             <?php if($catid>0){ if($cat_img!=''){ ?><img src="<?php echo base_path.$cat_img; ?>" width="50px" height="50px" style="border:1px solid; margin-left:10px;" /><?php } ?> <?php } ?>
                        </div>
                        <div class="clr"></div>
                    </div>
                  
					
                    
                     <div class="in_row">
                        <div class="in_colLeft">&nbsp;</div>
                        <div class="in_colRight">
                            <input  class="button" type="submit" name="btnsubmit" value="Save" style="padding:0px; width:100px; margin-top:5px"/> 
                            <a class="rest"  href="<?php echo base_path; ?>MyCP/category.php" >Cancel</a>
                        </div>
                        <div class="clr"></div>
                    </div>
                    


                </form>
</div>
            </div>
            <div class="clear"></div> 
        </div>
    </div>

</div>
<?php include("footer.php"); ?>
