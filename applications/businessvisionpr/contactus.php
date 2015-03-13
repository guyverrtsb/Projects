<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Business Vision....</title>
<style>
html	{	height:100%;	}
body	{	margin:0px; font-family:arial; color:#000000; height:100%;	}
div	{ border:0px red solid; }
header	{ text-align:center; margin:0px; border-bottom:none;	}
ul li	{ list-style-type:none;
		font-size:10px; font-weight:bold; color:#ffffff;  }
#footer	{ position:fixed; bottom:0px; right:0px; left:0px; background-color:#000000;	}

p	{ font-size:10px; font-weight:bold; color:#ffffff; width:325px;	}
.rounded	{ -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;
	padding:5px; border:#000000 1px solid; margin:2px;	}

.roundedError	{ -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;
	padding:5px; border:red 1px solid; margin:2px; background-color:#FFD4FF;	}

#cbxmessage	{	color:red; font-weight:bold;
}
</style>
<script src="com.gd.core.mimes/js/jquery-1.7.1.js"></script>
<script src="mimes/js/jquery.backstretch.min.js"></script>
<script>
$(document).ready(function() {
    $.backstretch("mimes/images/one.jpg");
});

function checkemaileform()
{
	var messages = new Array();
	if($("#emailfrm #name").val() == "" || $("#emailfrm #name").val() == "Name*")
	{
		$("#emailfrm #name").attr("class", "roundedError");
		messages[messages.length] = "Name is Required";
	}
	else
	{
		$("#emailfrm #name").attr("class", "rounded");
	}
	if($("#emailfrm #email").val() == "" || $("#emailfrm #email").val() == "Email*")
	{
		$("#emailfrm #email").attr("class", "roundedError");
		messages[messages.length] = "E-Mail is Required";
	}
	else
	{
		$("#emailfrm #email").attr("class", "rounded");
	}
	if($("#emailfrm #company").val() == "" || $("#emailfrm #company").val() == "Company*")
	{
		$("#emailfrm #company").attr("class", "roundedError");
		messages[messages.length] = "Company is Required";
	}
	else
	{
		$("#emailfrm #company").attr("class", "rounded");
	}

	var cbxwypchecked = false;
	if($("#emailfrm #wyp_brand").attr("checked") == "checked")
		cbxwypchecked = true;
	if($("#emailfrm #wyp_www").attr("checked") == "checked")
		cbxwypchecked = true;
	if($("#emailfrm #wyp_photo").attr("checked") == "checked")
		cbxwypchecked = true;
	if($("#emailfrm #wyp_social").attr("checked") == "checked")
		cbxwypchecked = true;
	if($("#emailfrm #wyp_other").attr("checked") == "checked")
		cbxwypchecked = true;

	if(!cbxwypchecked)
		messages[messages.length] = "Atleast one Project Type is Required";

	if(!$("#emailfrm #wyt").is(':checked'))
		messages[messages.length] = "Atleast one Project Budget is Required";

	if(!$("#emailfrm #wyb").is(':checked'))
		messages[messages.length] = "Atleast one Project Time is Required";

	if(messages.length > 0)
	{
		var o = "";
		for(var idx = 0; idx < messages.length; idx++)
		{
			o += "<p style=\"font-weight:bold; color:red;\">" + messages[idx] + "</p>";
		}
		$("#cbxmessage").html(o);
	}
	else
	{
		$("#performemailsend").val("true");
		$("#emailfrm").submit();
	}
}
$(document).ready(function(){
<?php
function GDBuildHtmlMessage()
{
	$tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$o = "<html>";
	$o .= "<head>";
	$o .= "<title>" . $_REQUEST["company"] . "</title>";
	$o .= "</head>";
	$o .= "<body>";
	$o .= "<ul>";
	$o = "<li>Name:" . $_REQUEST["name"] . "</li>";
	$o = "<li>Email:" . $_REQUEST["email"] . "</li>";
	$o = "<li>Company:" . $_REQUEST["company"] . "</li>";
	$o = "<li>Project Type:</li>";
	if (isset($_REQUEST["wyp_brand"]))
		$o .= "<li>" . $tab . "Identity/Branding</li>";
	if (isset($_REQUEST["wyp_www"]))
		$o .= "<li>" . $tab . "Web Development</li>";
	if (isset($_REQUEST["wyp_photo"]))
		$o .= "<li>" . $tab . "Photography</li>";
	if (isset($_REQUEST["wyp_social"]))
		$o .= "<li>" . $tab . "Social Media</li>";
	if (isset($_REQUEST["wyp_other"]))
		$o .= "<li>" . $tab . "Other</li>";
	$o .= "<li>Budget:" . $_REQUEST["wyb"] . "</li>";
	$o .= "<li>Timeframe:" . $_REQUEST["wyt"] . "</li>";
	$o .= "</ul>";
	$o .= "<br/><img src=\"http://bv.guyverdesigns.com/mimes/images/Header/centerlogo.png\"/>";
	$o .= "</body>";
	$o .= "</html>";
	return $o;
}

if (isset($_REQUEST["performemailsend"]))
{
	// if "email" is filled out, send email
	$email = $_REQUEST["email"];
	$subject = "New Project Request - " . $_REQUEST["name"] . $_REQUEST["company"];
	$message = GDBuildHtmlMessage();
	$headers = "";
		$headers .= "From:" . $email . "\r\n";
		$headers .= "BCC:audit@guyverdesigns.com\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

	mail("cameron@businessvisionpr.com",
		$subject,
		$message,
		$headers);
?>
	$("#cbxmessage").html("<p style=\"font-weight:bold; color:orange;\">Thank you for your request.  We will be in contact with you immediately.</p>");
	$("#emailfrm #name").val("<?php echo($_REQUEST["name"]) ?>");
	$("#emailfrm #email").val("<?php echo($_REQUEST["email"]) ?>");
	$("#emailfrm #company").val("<?php echo($_REQUEST["company"]) ?>");
<?php
}
?>
});
</script>
</head>
<body>
<header>
<div style="background-color:#000000; height:76px;">&nbsp;</div>
<div style="margin:auto; width:900px; margin-top:-76px;"><ul style="margin:0px;">
<li style="float:left; padding-top:50px;"><a href="index.html"><img src="mimes/images/Header/button_home.png" border="0px"/></a></li>
<li style="float:left; padding-top:50px; padding-left:20px;"><a href="portfolio.html"><img src="mimes/images/Header/button_portfolio.png" border="0px"/></a></li>
<li style="float:left; padding-top:50px; padding-left:20px;"><img src="mimes/images/Header/button_contact.png"/></li>
<li style="float:left; padding-left:50px;"><a href="index.html"><img src="mimes/images/Header/centerlogo.png" border="0px"/></a></li>
<li style="float:left; padding-top:50px; padding-left:80px;">&nbsp;</li>
<li style="float:left; padding-top:50px; padding-left:80px;">&nbsp;</li>
<li style="float:left; padding-top:50px; padding-left:100px;"><img src="mimes/images/Header/followus.png"/></li>
</ul></div>
</header>
<div class="span10" style="width:600px; text-align:left; margin:auto; margin-top:75px;">
<form id="emailfrm" name="emailfrm" method="post">
<ul>
<li style="padding-top:0px; margin-left:-150px;"><img src="mimes/images/contactus/contactu_us.png" style="text-align:left;"/></li>
<li style="padding-top:0px; margin-left:-150px;"><p>Let's talk.  At BusinessVision, every great relationship starts with a conversation and some free advice.  We'll provide a compliemntary review of your brand, your brochure, your website, or your next big idea and give you some insight.</p>
<p class="">To schedule a free consultation, fill out the form to below.</p>
<p class=""> we look forward in being your resource for your next big idea</p></li>
<li id="cbxmessage" style="margin-left:-150px;">&nbsp;</li>
<li style="padding-top:0px; margin-left:-150px;"><input class="rounded" style="width:400px;" type="text" id="name" name="name" value="Name*"/></li>
<li style="padding-top:0px; margin-left:-150px;"><input class="rounded" style="width:350px;" type="text" id="email" name="email" value="Email*"/></li>
<li style="padding-top:0px; margin-left:-150px;"><input class="rounded" style="width:375px;" type="text" id="company" name="company" value="Company*"/></li>
<li style="float:left; margin-left:-160px;"><ul style="padding:10px;">
	<li><img src="mimes/images/contactus/whats_your_project.png" style="text-align:left;"/></li>
	<li><input type="checkbox" id="wyp_brand" name="wyp_brand" value="true"/>&nbsp;Identity/Branding</li>
	<li><input type="checkbox" id="wyp_www" name="wyp_www" value="true"/>&nbsp;Web Development</li>
	<li><input type="checkbox" id="wyp_photo" name="wyp_photo" value="true"/>&nbsp;Photography</li>
	<li><input type="checkbox" id="wyp_social" name="wyp_social" value="true"/>&nbsp;Social Media</li>
	<li><input type="checkbox" id="wyp_other" name="wyp_other" value="true"/>&nbsp;Other</li>
</ul></li>
<li style="float:left;"><ul style="padding:10px;">
	<li><img src="mimes/images/contactus/whats_your_budget.png" style="text-align:left;"/></li>
	<li><input type="radio" id="wyb" name="wyb" value="Less then $5,000"/>&nbsp;Less then $5,000</li>
	<li><input type="radio" id="wyb" name="wyb" value="$5,000 = $15,000"/>&nbsp;$5,000 = $15,000</li>
	<li><input type="radio" id="wyb" name="wyb" value="Other"/>&nbsp;Other</li>
</ul></li>
<li><ul style="padding:10px;">
	<li><img src="mimes/images/contactus/whats_your_timeline.png" style="text-align:left;"/></li>
	<li><input type="radio" id="wyt" name="wyt" value="Days"/>&nbsp;Days</li>
	<li><input type="radio" id="wyt" name="wyt" value="Weeks"/>&nbsp;Weeks</li>
	<li><input type="radio" id="wyt" name="wyt" value="Months"/>&nbsp;Months</li>
</ul></li>
<li style="margin-top: 50px; margin-left:-100px;"><a href="javascript:void(0);" onclick="checkemaileform();"><img src="mimes/images/contactus/submit_button.png" border="0px"/></a></li>
</ul>
<input type="hidden" id="performemailsend" name="performemailsend" value="false"/>
</form>
</div>
<div id="footer">
<div style="margin:auto; width:900px;">
<ul style="margin:5px; text-align:right;">
<li style="font-size:8px;"><span style="color:#ffffff; font-weight:bold;">BUSINESS VISION</span>  <span style="color:#F1641F;">2012 All Rights Reserved</span></li>
<li style="font-size:8px;"><span style="color:#F1641F;">1407 N Batavia St | Ste#107 | Orange CA, 928670 | (310) 210.4650</span></li>
</ul>
</div>
</div>
</body>
</html>