<?php
require_once('includes/app_top.php');
require_once('includes/mysql.class.php');
require_once('includes/global.inc.php');
require_once('includes/functions_general.php');



//activation account



$actmsg = '';



$actemail = trim(strtolower($_GET['email']));



$actverifycode = urlencode($_REQUEST['token']); /* Get varify code */



$msgafteractive = '';



if ($actverifycode != '' && $actemail != '') {



	$_chk_user = " SELECT userid ,user_name from users " .
			" WHERE  token  = '" . $actverifycode . "' AND email = '" . $actemail . "'";



	$user_check = $db->query($_chk_user);



	if ($user_check->size() > 0) {



		$_row = $user_check->fetch();





		/* update restaurant details for login */

		$sqlup = "UPDATE  users SET
						email_verify 	=	'1',
						token			=	''
						WHERE userid	= '" . $_row['userid'] . "' ";

		$result = $db->query($sqlup);



		$msgafteractive = "YES";
	} else {



		echo "<h1>Lookagram: <span>Invalid Request</span></h1>";

		return false;
	}
} else {



	echo "<h1>Lookagram: <span>Invalid Request</span></h1>";

	return false;
}

$msgafteractive = "YES"
?>



<script type="text/javascript" language="javascript">

	/* Function for redirection */

	/*var timeslide	=	0;



	 function timer(){



	 timeslide		= parseInt(timeslide)+1;



	 if(timeslide>=5){



	 window.location=	$('#go').attr('href');



	 //setTimeout("timer()",1000);



	 }

	 setTimeout("timer()",1000);



	 }

	 $(document).ready(function(e) {

	 timer();

	 });*/


</script>







<div class="mid_fit">



    <div class="container top_gap">

    </div>

</div>







<div class="mid_fit">



   <div style=' width:700px; margin:0 auto'>

		<div style='background:#fff; border:#888 solid 1px; border-radius:15px; margin-top:20px; padding:20px; box-shadow:0 0 8px #999'>
            <div style='border-bottom:1px solid #ccc; padding-bottom:18px; background:none repeat scroll 0 0 #aeaeae;'>
<!--<img style=' width:250px;' src='" <?php echo base_path ?> "uploads/logo.png' />-->LookaGram</div>
<div style='font-size:16px; padding-top:20px;'>
			

			<h1>Lookagram: <span>Email verified. You can now log into the App.</span></h1>
</div>
        </div>
       
		</div>



		<?php
		$ERROR_MSG = isset($_SESSION["errormsg"]) ? $_SESSION["errormsg"] : '';

		$MSG = isset($_SESSION["fmsg"]) ? $_SESSION["fmsg"] : '';

		if ($ERROR_MSG != "") {
			?>

			<div class="msg" id="msgError" >

				<div class="msg-error">

					<p><?php echo $ERROR_MSG; ?></p>

				</div></div>

		<?php } elseif ($MSG != "") {
			?>

			<div class="msg" id="msgOk" >

				<div class="msg-ok">

					<p><?php echo $MSG; ?></p></div></div>

			<?php
		}

		unset($_SESSION["errormsg"]);

		unset($_SESSION["fmsg"]);
		?>



		<div class="order_searchBox">



			<?php
			if ($msgafteractive == "YES") {

			}
			?>

		</div>



	</div>





</div>



</div>





