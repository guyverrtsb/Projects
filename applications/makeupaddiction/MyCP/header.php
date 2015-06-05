<?php
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
// Include database connection
require_once('../includes/global.inc.php');
// Include general functions
require_once('../includes/functions_general.php');
// Include user class        
//require_once('../includes/user.class.php');
require_once('../includes/misc.class.php');
require_once('../includes/misc.class.php');

$USER = new MISC_CLASS;

define("PAGE_DETAIL", " ");
if (!is_array($_POST)) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = mysql_real_escape_string($value);
    }
}
//This stops SQL Injection in GET vars
foreach ($_GET as $key => $value) {
    $_GET[$key] = mysql_real_escape_string($value);
}

function checkUserActive($user) {
    global $db;
    $result = $db->query("select * from adminlogin where userid='$user'");

    if ($result->size() <= 0)
        return false;
    else
        return true;
}

if (!isset($_SESSION['admin']) || (!checkUserActive($_SESSION['admin'])) || empty($_SESSION['admin']))
    cheader("index.php");

if (@$_GET["mode"] == "logout") {
    session_unset();
    session_destroy();
    cheader("index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

            <link href="<?php echo base_path; ?>images/favicon.gif" type="image/png" rel="icon">
                <title><?php echo $PageTitle ?></title>

                <!--                       CSS                       -->

                <!-- Reset Stylesheet -->
                <link rel="stylesheet" href="<?php echo base_path ?>MyCP/css/reset.css" type="text/css" media="screen">

                    <!-- Main Stylesheet -->
                    <link rel="stylesheet" href="<?php echo base_path ?>MyCP/css/style.css" type="text/css" media="screen">

                        <link rel="stylesheet" href="<?php echo base_path ?>MyCP/css/font-awesome.css" type="text/css" media="screen">
                        
                            <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
                            <link rel="stylesheet" href="<?php echo base_path ?>MyCP/css/invalid.css" type="text/css" media="screen">
                                <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css" />
                                                            <!--<link href="<?php echo base_path ?>MyCP/css/bootstrap.min.css" rel="stylesheet">-->

                                <script type="text/javascript" src="<?php echo base_path ?>MyCP/js/jquery.min.js"></script>

                                <!-- jQuery Configuration -->
                                <script type="text/javascript" src="<?php echo base_path ?>MyCP/css/simpla.js"></script>

                                <!-- Facebox jQuery Plugin -->
                                <script type="text/javascript" src="<?php echo base_path ?>MyCP/css/facebox.js"></script>

                                <!-- jQuery WYSIWYG Plugin -->
                                <script type="text/javascript" src="<?php echo base_path ?>MyCP/css/jquery.js"></script>
                                <script type="text/javascript" src="<?php echo base_path ?>MyCP/js/jquery-1.7.2.min.js"></script>
                                <!-- jQuery Datepicker Plugin -->
                                <script type="text/javascript" src="<?php echo base_path; ?>MyCP/js/jquery-ui.min.js"></script>
                                <script type="text/javascript" src="<?php echo base_path ?>MyCP/css/jquery_002.js"></script>
                                <script type="text/javascript" src="<?php echo base_path ?>MyCP/ckeditor/ckeditor.js"></script>

                                </head>

                                <body>
                                    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->

                                        <?php require_once('sidebar.php'); ?>
                                        <div id="main-content"> <!-- Main Content Section with everything -->

                                            <noscript>
                                                <!-- Show a notification if the user has disabled javascript -->
                                                <div class="notification error png_bg">
                                                    <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly. </div>
                                                </div>
                                            </noscript>


                                            <!-- Page Head -->

                                            <!-- End .shortcut-buttons-set -->

                                            <div class="clear"></div>
                                            <!-- End .clear -->
                                            <script type="text/javascript">
                                                function menuSelects(id)
                                                {
                                                    if (id == '')
                                                        id = 'index'
                                                    $(".active").removeClass('active');
                                                    $("#" + id).addClass('active');
                                                }
                                            </script>