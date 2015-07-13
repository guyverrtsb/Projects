<?php require_once("gd.trxn.com/_controls/classes/_syscore.php"); 
zAppSysIntegration()->setDefaultPageTitle("Prospect - Login / Registraion")
?>
<?php zInc("/_controls/ui/templates/usersafety/head.php"); ?>
<!-- START - Content ================================================== -->
<!-- START - Container ================================================== -->
<div class="container">
<?php zInc("/gd.trxn.com/_controls/ui/components/uimessageline.php"); ?>
    <div id="loginbox" class="row">
        <div class="col-lg-12">
        <form class="usersafety-form" action="_controls/CONTROLLER.php" method="POST" role="form" data-toggle="validator">
        <h2 class="usersafety-form-heading">Please sign in</h2>
        <!-- E-Mail Input Box -->
        <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required>
            <div class="help-block with-errors"></div>
        </div>
        <!-- Password Input Box -->
        <div class="form-group">
            <label for="inputLoginPassword" class="sr-only">Password</label>
            <input type="password" id="inputLoginPassword" name="password" class="form-control" placeholder="Password" required>
            <div class="help-block with-errors"></div>
        </div>
        <!-- Check Box -->
        <div class="checkbox">
            <label>
            <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <!-- Login Button -->
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="UserSafety_Login(this);">Sign in</button>
        Don't have an account! <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">Sign Up Here</a>
        <input type="hidden" id="inputServiceControlKey" name="SERVICE_CONTROL_KEY" class="form-control" value="USERSAFETY-LOGIN_BY_EMAIL_PROSPECT" required>
        </form>
        </div>
    </div>
    <div id="signupbox" class="row" style="display:none;">
        <div class="col-lg-12">
        <form class="usersafety-form" action="_controls/CONTROLLER.php" method="POST" role="form" data-toggle="validator">
        <h2 class="usersafety-form-heading">Please sign up</h2>
        <!-- E-Mail Input Box -->
        <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required 
            data-error="Bruh, that email address is invalid">
            <div class="help-block with-errors"></div>
        </div>
        <!-- Password Input Box -->
        <div class="form-group">
            <label for="inputRegisterPassword" class="sr-only">Password</label>
            <input type="password" id="inputRegisterPassword" name="password" class="form-control" placeholder="Password" required
            data-minlength="6" data-error="Minimum of 6 characters">
            <span class="help-block with-errors"></span>
        </div>
        <!-- Password Confirm Input Box -->
        <div class="form-group">
            <label for="inputRegisterPasswordConfirm" class="sr-only">Confirm Password</label>
            <input type="password" id="inputRegisterPasswordConfirm" name="passwordconfirm" class="form-control" placeholder="Confirm Password" required 
            data-match="#inputRegisterPassword" data-match-error="Whoops, these don't match">
            <div class="help-block with-errors"></div>
        </div>
        <!-- Usertype hidden Box -->
        <!-- Login Button -->
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="UserSafety_Login(this);">Register</button>
        Already have an account! <a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a>
        <input type="hidden" id="inputServiceControlKey" name="SERVICE_CONTROL_KEY" class="form-control" value="USERSAFETY-REGISTER_BY_EMAIL_PROSPECT" required>
        </form>
        </div>
    </div>
</div>
<!-- END - Container ================================================== -->
<!-- END - Content ================================================== -->
<?php zInc("/_controls/ui/templates/usersafety/foot.php"); ?>


    
