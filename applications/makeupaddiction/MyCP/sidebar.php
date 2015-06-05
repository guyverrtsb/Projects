
<div id="sidebar">
    <div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
<div class="logoBg">
        <h1 id="sidebar-title">LOGO</h1>

        <!-- Logo (221px wide) --> 
        <a class="lgo_in" href="<?php echo base_path ?>MyCP/welcome.php">
            <img src="<?php echo  base_path ?>MyCP/images/logo.png" width="220px" style="padding-top:10px;" />
        </a> 

        <!-- Sidebar Profile links -->
        <div id="profile-links" class="pl_link"> <span>Hello,</span> <a href="#" ><?php echo $_SESSION["adminname"] ?></a>&nbsp;&nbsp;&nbsp;
            <?php /* ?><a href="<?php echo base_path?>" title="View the Site" target="new">View the Site</a><?php */ ?>
            <a href="<?php echo $_SERVER['PHP_SELF'] ?>?mode=logout" title="Sign Out">Sign Out</a> </div>
     </div>
        
            <ul id="main-nav">
            <li> <a href="<?php echo base_path ?>MyCP/welcome.php" class="nav-top-item no-submenu"><abbr><i class="fa fa-dashboard"></i></abbr> Dashboard </a> </li>
            <li> <a href="<?php echo base_path ?>MyCP/manage-users.php" class="nav-top-item no-submenu"> <abbr><i class="fa fa-user"></i></abbr> Manage Users </a> </li>
   
            <li> <a href="<?php echo base_path ?>MyCP/post.php" class="nav-top-item no-submenu"><abbr><i class="fa fa-dashboard"></i></abbr> Manage Post </a> </li>
      <li> <a href="<?php echo base_path ?>MyCP/post-reports.php" class="nav-top-item no-submenu"><abbr><i class="fa fa-dashboard"></i></abbr> Post Reports </a> </li>
			<li> <a style="padding-right: 15px;" href="#" class="nav-top-item"><abbr><i class="fa fa-gear"></i></abbr> Settings <span class="i"><i class="fa fa-angle-down"></i></span></a>
                <ul style="display: none;">

                    <li><a href="<?php echo base_path ?>MyCP/change-pass.php">Change Password</a></li>

                    <li><a href="<?php echo $_SERVER['PHP_SELF'] ?>?mode=logout" title="Sign Out">Sign Out</a></li>
                </ul>
            </li>
           
            </ul>
        
           

    </div>
</div>
