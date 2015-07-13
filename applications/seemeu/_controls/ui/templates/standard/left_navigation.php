<!-- START - Left Navigation ================================================== -->
<!-- START - Large Navigation ================================================== -->
            <div class="column col-sm-3 col-xs-1 sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                <li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
                </ul>
                <ul class="nav hidden-xs" id="lg-menu">
                <li class="active"><a href="#featured"><i class="glyphicon glyphicon-list-alt"></i> Featured</a></li>
                <li><a href="#stories"><i class="glyphicon glyphicon-list"></i> Stories</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-paperclip"></i> Saved</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-refresh"></i> Refresh</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-folder-close"></i> Groups You Own <b class="caret"></b></a>
                    <ul id="list_groups_you_own" class="dropdown-menu navmenu-nav"></ul>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-folder-close"></i> Groups You Use <b class="caret"></b></a>
                    <ul id="list_groups_you_use" class="dropdown-menu navmenu-nav"></ul>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo "User UID [".zAppSysIntegration()->getAuthUserUid()."]"; ?>">User Data <b class="caret"></b></a>
                    <ul class="dropdown-menu navmenu-nav">
<?php echo "<li>Is Authenticated [".zAppSysIntegration()->getAuthUserIsAuthenticated()."]</li>"; ?>
<?php echo "<li>User Table Key [".zAppSysIntegration()->getAuthUsertablekey()."]</li>"; ?>
                    </ul>
                </li>
                </ul>
                <ul class="list-unstyled hidden-xs" id="sidebar-footer">
                <li><a href="#"><h3>University</h3> <i class="glyphicon glyphicon-heart-empty"></i> NCSU</a></li>
                </ul>
<!-- END - Large Navigation ================================================== -->
<!-- START - Tiny Navigation ================================================== -->
                <ul class="nav visible-xs" id="xs-menu">
                <li><a href="#featured" class="text-center"><i class="glyphicon glyphicon-list-alt"></i></a></li>
                <li><a href="#stories" class="text-center"><i class="glyphicon glyphicon-list"></i></a></li>
                <li><a href="#" class="text-center"><i class="glyphicon glyphicon-paperclip"></i></a></li>
                <li><a href="#" class="text-center"><i class="glyphicon glyphicon-refresh"></i></a></li>
                <li><a href="#" class="text-center"><i class="glyphicon glyphicon-folder-close"></i></a></li>
                <li><a href="#" class="text-center"><i class="glyphicon glyphicon-folder-close"></i></a></li>
                </ul>
<!-- END - Tiny Navigation ================================================== -->
            </div>
<!-- END - Left Navigation ================================================== -->
