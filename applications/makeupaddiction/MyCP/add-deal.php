<?php
$PageTitle = "Add Deal";
include('header.php');
require_once('../includes/image_lib/image.class.php');

function rteSafe($strText) {
		//returns safe code for preloading in the RTE
		$tmpString = $strText;
		//convert all types of single quotes
		$tmpString = str_replace(chr(145), chr(39), $tmpString);
		$tmpString = str_replace(chr(146), chr(39), $tmpString);
		$tmpString = str_replace("'", "&#39;", $tmpString);
		
		//convert all types of double quotes
		$tmpString = str_replace(chr(147), chr(34), $tmpString);
		$tmpString = str_replace(chr(148), chr(34), $tmpString);
	//	$tmpString = str_replace("\"", "\"", $tmpString);
		
		//replace carriage returns & line feeds
		$tmpString = str_replace(chr(10), " ", $tmpString);
		$tmpString = str_replace(chr(13), " ", $tmpString);
		
		return $tmpString;
	}
extract($_REQUEST);

$dealid = intval(base64_decode($_REQUEST['dealid']));
if ($dealid > 0) {
	
    $sqlDeal = "SELECT * FROM `deal_post` WHERE deal_id = '" . $dealid . "' ";
    $resDeal = $db->query($sqlDeal);
    if ($resDeal->size() > 0) {
        $rowDeal    =  $resDeal->fetch();
        $dealid     =  $rowDeal['deal_id'];
		$deal_name  =  $rowDeal['deal_name'];
		$start_date =  $rowDeal['start_date'];
		$end_date   =  $rowDeal['end_date'];
		$productname   =  $rowDeal['prod_name'];
		$description   =  $rowDeal['description'];
		$price      =  $rowDeal['price'];
		$totalvote  =  $rowDeal['vote_claim'];
		$hours_perform  =  $rowDeal['hours_to_perform'];
		$minute_perform  =  $rowDeal['minute_to_perform'];
		$prod_thumb_img	=	$rowDeal['prod_thumb_img'];
		$prod_img		=	$rowDeal['prod_img'];
		
    } else {
        cheader("deal.php");

    }
}
function createDir($path) {
	return ((!is_dir($path)) ? @mkdir($path, 0777) : TRUE);
}

if (isset($_POST['btnsubmit'])) {
/*echo "<pre>";
print_r($_POST); die;*/
    $str = true;
	
	$deal_name      = security(trim($_REQUEST['deal_name']));
    $start_date     = trim($_REQUEST['start_date']);
    $end_date       = trim($_REQUEST['end_date']);
    $productname    = security(trim($_REQUEST['productname']));
    $description    = addslashes(trim($_REQUEST['description']));
    $price          = security(trim($_REQUEST['price']));
    $totalvote      = security(trim($_REQUEST['totalvote']));
    $hours_perform  = security(trim($_REQUEST['hours_perform']));
	$minute_perform  = security(trim($_REQUEST['minute_perform']));
    $img            = $_FILES['prodimg']['tmp_name'];
    $img_name       = $_FILES['prodimg']['name'];
    $img_type       = $_FILES['prodimg']['type'];
    $img_size       =   $_FILES['prodimg']['size'];
    $dealid         = intval($_REQUEST['dealid']);
    $prod_img       = $_REQUEST['prod_img'];
    $prod_thumb_img	= $_REQUEST['prod_thumb_img'];
	
    $price	=	str_replace(' ','',$price);
	$totalvote	=	str_replace(' ','',$totalvote);
	$hours_perform	=	str_replace(' ','',$hours_perform);
    
		$filePath = "";
		$photo_dir = "../uploads";
		$dirCreated = (createDir($photo_dir));
		$filePath .="uploads/";
		
		$photo_dir.="/deal";
		$dirCreated = (createDir($photo_dir));
		$filePath .="deal/";
		
	 $img_name	=	str_replace(' ','-',$img_name); 
		
  
	if($deal_name=='')
	{
		$_SESSION["errormsg"]	.=	"Deal name is a required field."."<br>";
		$str	=	false;
	}
if($start_date=='')
	{
		$_SESSION["errormsg"]	.=	"Start date is a required field."."<br>";
		$str	=	false;
	}
	if($end_date=='')
	{
		$_SESSION["errormsg"]	.=	"End date is a required field."."<br>";
		$str	=	false;
	}
	 if($start_date>$end_date)
	{
		$_SESSION["errormsg"]	.=	"End date should be greater then start date."."<br>";
		$str	=	false;
	}
	if($productname=='')
	{
		$_SESSION["errormsg"]	.=	"Product name is a required field."."<br>";
		$str	=	false;
	}
	if($description=='')
	{
		$_SESSION["errormsg"]	.=	"Description is a required field."."<br>";
		$str	=	false;
	}
	if($totalvote=='')
	{
		$_SESSION["errormsg"]	.=	"Vote for claim is a required field."."<br>";
		$str	=	false;
	}
	else if(!is_numeric($totalvote))
	{
		$_SESSION["errormsg"]	.=	"Vote should be numeric."."<br>";
		$str	=	false;
	}
    else if($totalvote<1)
    {
        $_SESSION["errormsg"]	.=	"Vote value atleast 1."."<br>";
		$str	=	false;
    }
	if($hours_perform=='')
	{
		$_SESSION["errormsg"]	.=	"Hours to perform is a required field."."<br>";
		$str	=	false;
	}
	else if(!is_numeric($hours_perform))
	{
		$_SESSION["errormsg"]	.=	"Hours should be numeric."."<br>";
		$str	=	false;
	}
	if($minute_perform=='')
	{
		$_SESSION["errormsg"]	.=	"Minute to perform is a required field."."<br>";
		$str	=	false;
	}
	else if(!is_numeric($minute_perform))
	{
		$_SESSION["errormsg"]	.=	"Minute should be numeric."."<br>";
		$str	=	false;
	}
	
		
		else if($img!='') {
			if ($img_type != 'image/jpg' && $img_type != 'image/jpeg' && $img_type != 'image/png')
			{

			$_SESSION["errormsg"] .= "Invalid image type.Please upload only JPG,JPEG,PNG.";
			$str	=	false;
		} 
        if($img_size>(4*1024*1024))
        {
            $_SESSION["errormsg"] .= "Image size should be 4 MB or less then 4MB.";
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
    if ($str == true) {
		if($img!='')
		{
			$IMAGE = new UPLOAD_IMAGE();
			$IMAGE->init($img);

			move_uploaded_file($img, $target_ori);

			$extension = strrchr($target_small, '.');
			$extension = strtolower($extension);

			$IMAGE->resizeImage(400, 400, 'crop');
			$IMAGE->saveImage($target_small, 100);
		}
//echo "hi"; die;
        if ($dealid > 0) {
            

            $sqlUpdate =  " UPDATE deal_post SET " .
								" deal_name   =  '" . $deal_name . "' , ".
								" start_date       =  '" .$start_date ."' ,".
								 " end_date       =  '" .$end_date ."' ,".
								 " 	hours_to_perform       =  '" .$hours_perform ."' ,".
								 " 	minute_to_perform       =  '" .$minute_perform ."' ,".
								 " vote_claim       =  '" .$totalvote ."' ,".
								 " prod_name       =  '" .$productname ."' ,".
								 " prod_img       =  '" . $prod_img ."' ,".
								 " prod_thumb_img       =  '" .$prod_thumb_img ."' ,".
								 " description       =  '" .$description ."' ,".
								 " price       =  '" .$price ."' ".					 	
								" WHERE deal_id        =  '".$dealid."' ";

            $db->query($sqlUpdate);

            $_SESSION['msg'] = "Updated successfully.";
        } else {
			

			
          

            $sql =  " INSERT INTO deal_post SET " .
                    " deal_name   =  '" . $deal_name . "' , ".
                    " start_date       =  '" .$start_date ."' ,".
					 " end_date       =  '" .$end_date ."' ,".
					 " 	hours_to_perform       =  '" .$hours_perform ."' ,".
					 " 	minute_to_perform       =  '" .$minute_perform ."' ,".
					 " vote_claim       =  '" .$totalvote ."' ,".
					 " prod_name       =  '" .$productname ."' ,".
					 " prod_img       =  '" . $prod_img ."' ,".
					 " prod_thumb_img       =  '" . $prod_thumb_img ."' ,".
					 " description       =  '" .$description ."' ,".
					 " price       =  '" .$price ."' ,".					 	
                    " dtdate        =  NOW() ";
            $db->query($sql);

            $_SESSION["msg"] = "Added successfully. ";
        }
        cheader("deal.php");
    }
}

if($dealid>0)
{
    $startdate   =   date('Y-m-d h:i:s',strtotime($start_date));
	 $enddate   =   date('Y-m-d h:i:s',strtotime($end_date));
    
}
else
{
    $startdate	= date('Y-m-d h:i:s');
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

<link rel="stylesheet" type="text/css" href="<?php echo base_path ?>MyCP/js/jquery.datetimepicker.css"/>
<script src="<?php echo base_path ?>MyCP/js/jquery.datetimepicker.js"></script>

						
<script>
	 $(document).ready(function(e) {
       
	$('#start_date').datetimepicker({
            dayOfWeekStart : 1,
            lang:'en',
            //disabledDates:['1986-01-08','1986-01-09','1986-01-10'],
            startDate:	'<?php echo $startdate ?>',
            minDate:'<?php echo $startdate ?>',
});
$('#end_date').datetimepicker({
            dayOfWeekStart : 1,
            lang:'en',
            //disabledDates:['1986-01-08','1986-01-09','1986-01-10'],
            startDate:	'<?php echo $enddate ?>',
            minDate:'<?php echo $startdate ?>',
});
		
		<?php if($dealid>0){ ?>
		$('#prodimg').removeAttr('required','required');
		<?php } ?>
		
		});
	</script>
    <script type="text/javascript">
$('#hours_perform').timepicker({
minuteStep: 1,
template: 'modal',
appendWidgetTo: 'body',
showSeconds: true,
showMeridian: false,
defaultTime: false
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
             <a href="<?php echo base_path . 'MyCP/deal.php' ?>">Deal</a> >
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
            <div  class="Registerinner" style="float:none; margin-top:0;">   
            
               <div class="clear"></div>
                <div class="cm_bx1" style="width: 100%; margin-top: 21px;box-sizing:border-box; padding:0px 25px; display:inline-block;">
                    <form action="" method="post" name="form" id="optionform" enctype="multipart/form-data">
                        <input type="hidden" name="dealid" id="dealid" value="<?php echo intval($dealid); ?>" />
                        <input type="hidden" name="prod_thumb_img" value="<?php echo $prod_thumb_img; ?>">
                        <input type="hidden" name="prod_img" value="<?php echo $prod_img; ?>">
                  
                   
                     <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Deal Name:</label></div>
                        <div class="in_colRight">
                             <input type="text" class="required" placeholder="Deal Name" value="<?php echo $deal_name; ?>" name="deal_name" id="deal_name" style="float:left;  padding:10px !important; width:35%; " required="required"/>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Start Date:</label></div>
                        <div class="in_colRight">
                             <input type="text" name="start_date" id="start_date" value="<?php echo $start_date; ?>" style=" padding:10px !important; width:35%;" required="required" readonly="readonly"/>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>End Date:</label></div>
                        <div class="in_colRight">
                               <input type="text" name="end_date" id="end_date" value="<?php echo $end_date; ?>" style=" padding:10px !important; width:35%;" required="required" readonly="readonly"/>
                        </div>
                        <div class="clr"></div>
                    </div>
					 <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Product Name:</label></div>
                        <div class="in_colRight">
                               <input type="text" name="productname" id="productname"  style=" padding:10px !important; width:35%;" value="<?php echo $productname; ?>" required="required"/>
                        </div>
                        <div class="clr"></div>
                    </div>
					 <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Product Image:</label></div>
                        <div class="in_colRight">
                               <input type="file" name="prodimg" id="prodimg"  style=" padding:10px !important; width:35%;" required="required"  />
                                 <?php if($dealid>0){ if($prod_thumb_img!=''){ ?><img src="<?php echo base_path.$prod_thumb_img; ?>" width="50px" height="50px" style="border:1px solid; margin-left:10px;" /><?php } ?> <?php } ?>
                                 <br/>&nbsp;
                                 <span> (IMAGE SIZE SOULD BE 4MB OR LESS)</span>
                        </div>
                      
                        <div class="clr"></div>
                    </div>
					 <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Product Description:</label></div>
						 <div class="in_colRight">
                        <textarea id="description" placeholder="" name="description" style=" padding:15px; width:34.3% !important; margin-left: -2px; resize:vertical;" maxlength="1000"><?php echo $description; ?></textarea>
							
                        </div>
                        <div class="clr"></div>
                   
					 <div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Price:</label></div>
                        <div class="in_colRight">
							<input type="text" name="price" id="price" style=" padding:10px !important; width:35%;" value="<?php echo $price; ?>" />
                        </div>
                        <div class="clr"></div>
                    </div>
					<div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Vote require for claim:</label></div>
                        <div class="in_colRight" >
							<input type="number" min="1" name="totalvote" style=" padding:10px !important; width:35%;" id="totalvote" required="required" value="<?php echo $totalvote; ?>"  style="width:25%;"  />
                        </div>
                        <div class="clr"></div>
                    </div>
					<div class="in_row">
                        <div class="in_colLeft"><label for=textfield>Time require for deal:</label></div>
                        <div class="in_colRight">
							<input type="number" min="0" max="12" name="hours_perform" id="hours_perform" required="required" value="<?php echo $hours_perform; ?>" style="width:14%; padding:10px !important; "  /> <span style="margin-top:7px; margin-left:7px; font-size:14px">HH</span>
                           
                            <input type="number" min="0" max="59" name="minute_perform" id="minute_perform" required="required" value="<?php echo $minute_perform; ?>" style="width:14%;  padding:10px !important; margin-left:10px;"  /> <span style="margin-top:7px; margin-left:7px; font-size:14px">MM</span>
                        </div>
                        <div class="clr"></div>
                    </div>
					
                    
                     <div class="in_row">
                        <div class="in_colLeft">&nbsp;</div>
                        <div class="in_colRight">
                            <input  class="button" type="submit" name="btnsubmit" value="Save" style="padding:0px; width:100px; margin-top:5px"/> 
                            <a class="rest"  href="<?php echo base_path; ?>MyCP/deal.php" >Cancel</a>
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
