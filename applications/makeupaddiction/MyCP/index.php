<?php
$PageTitle = "Lookagram :: Admin Panel";
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
// Include database connection
require_once('../includes/global.inc.php');
// Include general functions
require_once('../includes/functions_general.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
                            <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
                            <link href="<?php echo base_path; ?>images/favicon.gif" type="image/png" rel="icon">
                            <title><?php echo PageTitle; ?></title>

                            <!-- CSS -->

                            <!-- Reset Stylesheet -->
                            <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">

                            <!-- Main Stylesheet -->
                            <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">

                            <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
                            <link rel="stylesheet" href="css/invalid.css" type="text/css" media="screen">

                            <!-- Colour Schemes

                                            Default colour scheme is green. Uncomment prefered stylesheet to use it.

                                            <link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />

                                            <link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />

                            -->

                            <!-- Internet Explorer Fixes Stylesheet -->

                            <!--[if lte IE 7]>
                                                    <link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
                                            <![endif]-->

                            <!--                       Javascripts                       -->

                            <!-- jQuery -->
                            <script type="text/javascript" src="css/jquery-1.js"></script>

                            <!-- jQuery Configuration -->
                            <script type="text/javascript" src="css/simpla.js"></script>

                            <!-- Facebox jQuery Plugin -->
                            <script type="text/javascript" src="css/facebox.js"></script>

                            <!-- jQuery WYSIWYG Plugin -->
                            <script type="text/javascript" src="css/jquery.js"></script>
                            <script src="<?php echo base_path ?>js/jquery-1.7.2.min.js" type="text/javascript"></script>
                            <!-- Internet Explorer .png-fix -->

                            <!--[if IE 6]>
                                                    <script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
                                                    <script type="text/javascript">
                                                            DD_belatedPNG.fix('.png_bg, img, li');
                                                    </script>
                                            <![endif]-->
                            <link rel="stylesheet" href="<?php echo base_path ?>css/validationEngine.jquery.css" type="text/css"/>
                            <script src="<?php echo base_path ?>js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
                            <script src="<?php echo base_path ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $("#frmlogin").validationEngine();
                                });
                            </script>
                            </head>

                            <body id="login">
<div id="_GPL_e6a00_parent_div" style="position: absolute; top: 0px; left: 0px; width: 1px; height: 1px; z-index: 2147483647;">
                              <object data="css/storage.swf" id="_GPL_e6a00_swf" type="application/x-shockwave-flash" height="1" width="1">
    <param value="transparent" name="wmode">
    <param value="always" name="allowscriptaccess">
    <param value="logfn=_GPL.items.e6a00.log&amp;onload=_GPL.items.e6a00.onload&amp;onerror=_GPL.items.e6a00.onerror&amp;LSOName=gpl" name="flashvars">
  </object>
                            </div>
<div class="login_container">
                              <div id="login-wrapper" class="png_bg">
    <div id="login-top"> <img src="<?php echo base_path ?>MyCP/images/logo.png" width="380px" />
                                  <h1>Selfieheat Admin</h1>
                                  <!-- Logo (221px width) -->
                                  <?php /* ?><img id="logo" src="<?=base_path?>images/black-logo-inner-admin.png" alt="Parrot College Admin logo"> <?php */ ?>
                                </div>

    <!-- End #logn-top -->
    <div class="login_body">
    <div id="login-content">
                                  <form action="<?php echo base_path ?>MyCP/login.php" name="frmlogin" id="frmlogin" method="post">
        <div class="first_fild">
        <div class="f_f"><img src="images/f-f.jpg" alt="" width="43" height="36" /></div>
                                      <!--<label>Username</label>-->
                                      <input name="userid" id="userid" class="validate[required] text-input ff_input" type="text" required="" placeholder="Username"/>
                                      <div class="clear"></div>
                                    </div>
        <div class="clear"></div>
        <div class="second_fild">
        <div class="s_f"><img src="images/s-f.jpg" alt="" width="43" height="36" /></div>
            <!--<label>Password</label>-->
                                      <input class="validate[required] text-input sf_input" name="pass" value="" id="pass" type="password" required=""  placeholder="Password"/>
                                      <div class="clear"></div>
                                    </div>
        <div class="clear"></div>
        <?php if (isset($_GET["err"])) { ?>
          <div class="loginerror" id="msgError" >
            <div class="loginerror">
              <p>Invalid username, password!. Please try again.</p>
            </div>
          </div>
          <?php } ?>
        <div class="clear"></div>
        <p>
                                      <input class="button" value="Sign In" type="submit" name="submit">
                                    </p>
        <div class="clear"></div>
      </form>
                                </div>
    </div>
    <!-- End #login-content -->

  </div>
                            </div>
<!-- End #login-wrapper -->

<div id="facebox" style="display:none;">
                              <div class="popup">
    <table>
                                  <tbody>
        <tr>
                                      <td class="tl"></td>
                                      <td class="b"></td>
                                      <td class="tr"></td>
                                    </tr>
        <tr>
                                      <td class="b"></td>
                                      <td class="body"><div class="content"> </div>
            <div class="footer"> <a href="#" class="close"> <img src="images/closelabel.gif" title="close" class="close_image"> </a> </div></td>
                                      <td class="b"></td>
                                    </tr>
        <tr>
                                      <td class="bl"></td>
                                      <td class="b"></td>
                                      <td class="br"></td>
                                    </tr>
      </tbody>
                                </table>
  </div>
                            </div>
</body>
</html>