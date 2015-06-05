<?php 
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
// Include database connection
require_once('../includes/global.inc.php');
// Include general functions
require_once('../includes/functions_general.php');


//This stops SQL Injection in POST vars
foreach ($_POST as $key => $value) {
  $_POST[$key] = mysql_real_escape_string($value);
}
//This stops SQL Injection in GET vars
foreach ($_GET as $key => $value) {
  $_GET[$key] = mysql_real_escape_string($value);
}
if (isset($_POST['submit']))
{
		if (isset($_POST['pass']) && (isset($_POST['userid']))) 
		{ // if first
		$pass   =   md5($_POST['pass']);
		$userid =   $_POST['userid'];
		$result1=   $db->query("select * from adminlogin where userid='$userid' and pass='$pass'");
		
		if ($result1->size()>0)
			{ // if second
			$rs=$result1->fetch();
			$_SESSION['admin']=$userid;
			$_SESSION['adminname']=$rs['name'];
			$_SESSION['LAST_LOGIN']=$rs['last_login'];
			
			
			$sql="update adminlogin set last_login=NOW() where userno=".$rs['userno'];
			$res=$db->query($sql);
		
				
				cheader("welcome.php");
			
			}// end if second
		else
			{
				cheader("index.php?err=1");
			}
	}
		
	}
?>
