<?php require_once("gd.trxn.com/_controls/classes/_syscore.php"); 
zAppSysIntegration()->setDefaultPageTitle("Student - Login / Registraion")
?>
<?php zInc("/_controls/ui/templates/usersafety/head.php"); ?>
<!-- START - Content ================================================== -->
<!-- START - Container ================================================== -->
<div class="container">
<?php zInc("/gd.trxn.com/_controls/ui/components/uimessageline.php"); ?>
    <div id="loginbox" class="row">
        <div class="col-lg-6">
        <form class="usersafety-form" action="_controls/CONTROLLER.php" method="POST">
        <h2 class="usersafety-form-heading">Please sign in</h2>
        <!-- E-Mail Input Box -->
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <!-- Password Input Box -->
        <label for="inputLoginPassword" class="sr-only">Password</label>
        <input type="password" id="inputLoginPassword" name="password" class="form-control" placeholder="Password" required>
        <!-- Usertype hidden Box -->
        <input type="hidden" id="inputServiceControlKey" name="SERVICE_CONTROL_KEY" class="form-control" value="USERSAFETY-LOGIN_BY_EMAIL_STUDENT" required>
        <!-- Check Box -->
        <div class="checkbox">
            <label>
            <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <!-- Login Button -->
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="UserSafety_Login(this);">Sign in</button>
        </form>
        </div>
        <div class="col-lg-6">
        <form class="usersafety-form" action="_controls/CONTROLLER.php" method="POST">
        <h2 class="usersafety-form-heading">Please sign up</h2>
        <!-- E-Mail Input Box -->
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <!-- Password Input Box -->
        <label for="inputRegisterPassword" class="sr-only">Password</label>
        <input type="password" id="inputRegisterPassword" name="password" class="form-control" placeholder="Password" required>
        <!-- Password Confirm Input Box -->
        <label for="inputRegisterPasswordConfirm" class="sr-only">Confirm Password</label>
        <input type="password" id="inputRegisterPasswordConfirm" name="passwordconfirm" class="form-control" placeholder="Confirm Password" required>
        <!-- Usertype hidden Box -->
        <input type="hidden" id="inputServiceControlKey" name="SERVICE_CONTROL_KEY" class="form-control" value="USERSAFETY-REGISTER_BY_EMAIL_STUDENT" required>
        <!-- Login Button -->
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="UserSafety_Login(this);">Register</button>
        </form>
        </div>
    </div>
</div>
<!-- END - Container ================================================== -->
<!-- END - Content ================================================== -->
<?php zInc("/_controls/ui/templates/usersafety/foot.php"); ?>


    
