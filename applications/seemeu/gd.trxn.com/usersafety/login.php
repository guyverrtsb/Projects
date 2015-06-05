<?php require_once("../../gd.trxn.com/_controls/classes/_syscore.php"); 
$PHP_TITLE = "Login";
?>
<?php zInc("/gd.trxn.com/_controls/ui/usersafety/head.php"); ?>
<div class="container">
    <form class="usersafety-form">
    <h2 class="usersafety-form-heading">Please sign in</h2>
    <!-- E-Mail Input Box -->
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <!-- Password Input Box -->
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <!-- Check Box -->
    <div class="checkbox">
        <label>
        <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <!-- Login Button -->
    <button class="btn btn-lg btn-primary btn-block" type="button" onclick="UserSafety_Login(this);">Sign in</button>
    </form>
    <?php zReqOnce("/_controls/ui/messageline.php"); ?>
</div> <!-- /container -->
<?php zInc("/gd.trxn.com/_controls/ui/usersafety/foot.php"); ?>