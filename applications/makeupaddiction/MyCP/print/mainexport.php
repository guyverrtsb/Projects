<?php
require_once('../../includes/export.class.php');
include('../../includes/html2pdf.class.php');
$exp=new EXPORT_CLASS;
function getOriention($name){
	$name=strtoupper($name);
	
	switch ($name){
		
		case  strtoupper("subscribers.pdf"):
			return "L";
			break;
		default :
			return "P";
			break;
	}
		
}
function exportWithPDF($php_page,$file_name,$whr,$t,$y,$m,$ty,$mv,$extra_value){
		global $db;
		ob_start();
		
		$where=$whr;
		$tp=$t;
		$year=$y;
		$month=$m;
		$type=$ty;
		$monthValue=$mv;
		//echo $php_page;
		//die;
	    include($php_page);
	    
		$content = ob_get_clean();
		$ori=getOriention($file_name); 
		try
    {
        $html2pdf = new HTML2PDF($ori, 'A4', 'en');
        $html2pdf->pdf->SetDisplayMode('fullpage');
	    $html2pdf->writeHTML($content);
        $html2pdf->Output($file_name);
		$exp->setHeader($file_name);
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
       exit;
    }
		
}


$report_type="excel";
$report_type=$_GET['type'];
	$var	=	$_GET['var'];
	//echo ($report_type); echo "<pre>"; die;
	$var	=	base64_decode($_GET['var']);

	$ddd	=	 explode('&', $var);


	$post	=	array();
	
	foreach($ddd as $key)
	{
		if($key!='')
		{
	
		 	$pos = strrpos($key, "@");
		
		 	$index	=	trim(substr($key,0,$pos));
		
		 	$value	=	trim(substr($key,$pos+1));
		 
		 	$post[$index]	=	$value;
	
		}
	}
	/*extra search fealds value*/
	$extra_value	=	array();
	$extra_value['fromdate'] =$post['fromdate'];
    $extra_value['todate'] =$post['todate'];
    $extra_value['material'] =$post['material'];
	/*extra search fealds value*/

	$year	=	0;
	$month	=	0;
	$monthValue=0;
	$page	=	$post['page'];
	
	$name	=	$post['name'];
	
	if(isset($post['where']))
		$where=($post['where']);
	else
		$where='';

	
	if(isset($post['year']))
		$year	=	$post['year'];
	
	
	if(isset($post['month']))
		$month	=	$post['month'];
	
	
	if(isset($_GET['type']))
	
		$type	=	$_GET['type'];
	
	else
		$type	=	'active';
		
	if(isset($_GET['animalclass']))
	
		$animalclass	=	$_GET['animalclass'];
	
	else
		$animalclass	=	'';

	if(isset($post['monthValue']))
	
		$monthValue	=	$post['monthValue'];
		
	if(isset($_GET['user']))
	
		$user	=	$_GET['user'];
		
	$username	=	$_GET['username'];
	$useremail	=	$_GET['useremail'];
//echo $page."?tp=".$report_type."&where=".$where."&year=".$year."&month=".$month."&type=".$type;
//die;

	if ($report_type=='excel'){
		header("location:".$page."?tp=".$report_type."&where=".$where."&year=".$year."&month=".$month."&type=".$type."&monthValue=".$monthValue."&animalclass=".$animalclass."&user=".$user."&username=".$username."&useremail=".$useremail);
	}
	else{
		exportWithPDF($page,$name,$where,$tp,$year,$month,$type,$monthValue,$extra_value);
	}
	