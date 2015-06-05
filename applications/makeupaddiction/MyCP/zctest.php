<?php 
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
// Include database connection
require_once('../includes/global.inc.php');
// Include general functions
require_once('../includes/functions_general.php');


 // if first
        $pass   =   md5("WMiltz001");
		$userid =   "admin";
        $sql = "select * from adminlogin where userid='$userid' and pass='$pass'";
error_log("sql:".$sql, 0);
        $result1=   $db->query($sql);
error_log("result1->size():".$result1->size(), 0);
		if ($result1->size()>0)
			{ // if second
            error_log("SUCCESS in Login", 0);
			$rs=$result1->fetch();
			$_SESSION['admin']=$userid;
			$_SESSION['adminname']=$rs['name'];
			$_SESSION['LAST_LOGIN']=$rs['last_login'];
			
			
			$sql="update adminlogin set last_login=NOW() where userno=".$rs['userno'];
			$res=$db->query($sql);
		
printf("GOOD");
			
			}// end if second
		else
			{
printf("BAD");
			}
?>
