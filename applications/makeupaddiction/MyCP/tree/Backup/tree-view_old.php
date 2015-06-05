<?php 
$PageTitle = "Add Survey";
include('header.php');
		SetRef($PageTitle);
	$row_over_alternate_color	=	"#e6e6e6";
	$row_over_color				=	"#FFF8DB";
	$bgcolor					=	"#FBFCFC";

?>     
<script src="<?php echo base_path?>js/jquery-1.7.2.min.js" type="text/javascript"></script>
  
<div class="content-box"><!-- Start Content Box -->
<link rel="stylesheet" href="tree/jquery.treeview.css" />
<script src="tree/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript">
		$(function(){
			$("#treeview").treeview({
				collapsed: true,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
		})

	</script>

<div id="sidetree">
<div class="treeheader"></div>
<div id="sidetreecontrol"><a href="?#">Collapse All</a>|<a href="?#">Expand All</a>
</div>
<?php     
$sql_main_category       =    "SELECT * FROM main_category where 1"; 
$result_main_category    = 	$db->query($sql_main_category);
if($result_main_category->size()>0)
{
	echo '<ul id="treeview">'; 
	while ($row	=	$result_main_category->fetch())
	{ 
		echo '<li><a href="#">'.$row['name'].'</a>'; 
        $sql_sub_category       =    " SELECT * FROM sub_category WHERE id='".$row['id']."' ";
		$result_sub_category    = 	$db->query($sql_sub_category); 
		if($result_main_category->size()>0)
		{ 
	      echo '<ul>';
          while ($row_sub	=	$result_sub_category->fetch())
		  { 
		  	echo '<li><a href="#">'.$row_sub['sub_name'].'</a>';
			$sql_survey_category = "SELECT * FROM survey_master WHERE  sub_cat_id='".$row_sub['cat_id']."' "; 
			$result_survey_category  = 	$db->query($sql_survey_category);
			if($result_survey_category->size()>0)
			{  	
               echo '<ul>';
               while ($row_survey	=	$result_survey_category->fetch())
			   { 
			   		echo '<li><a href="#">'.$row_survey['subject'].'</a>';
                    $sql_lession = "SELECT * FROM mini_lesson WHERE sub_cat_id='".$row_sub['cat_id']."' AND survey_id='".$row_survey['survey_id']."'  "; 
					$sql_quiz = "SELECT * FROM quiz_master WHERE  cat_id='".$row['id']."' AND  sub_cat_id='".$row_sub['cat_id'].
								"' AND survey_id='".$row_survey['survey_id']."' ";
					$result_lession  = 	$db->query($sql_lession);
					$result_quiz  = 	$db->query($sql_quiz);
				    if($result_lession->size()>0 )
					{ 
						echo '<ul><li><a href="#">Lesson</a><ul>';
                   		while ($row_lession	=	$result_lession->fetch())
						{ 
							echo '<li><a href="#">'.$row_lession['mini_lesson_name'].'</a></li>';
                        } 
                    echo '</ul></li>';
                    } 
				   if($result_quiz->size()>0 )
				   { 
				   		echo '<li><a href="#">Quiz</a><ul>';
                  		while ($row_quiz	=	$result_quiz->fetch())
						{ 
                  			echo '<li><a href="#">'.$row_quiz['question'].'</a></li>';
                         }
					echo '</ul></li></ul>';
				   } 
                   echo '</li>';
                 } 
                 echo '</ul>';
               } 
            echo '</li>';
            
           }
	   echo '</ul>';
    	}
  	echo '</li>';
	}  
 echo '</ul>';
} ?>
</div>
       
      </div>
      <div class="clr"></div>
    

       <?php include("footer.php"); ?>

  
 