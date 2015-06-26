<?php require_once("../../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zInc("/gd.trxn.com/_controls/ui/usersafety/head.php"); ?>
<div class="container">
    <form class="usersafety-form">
    <h2 class="usersafety-form-heading">Please enter in new Password</h2>
    <!-- Password Input Box -->
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <!-- Confirm Password Input Box -->
    <label for="inputConfirmPassword" class="sr-only">Confirm Password</label>
    <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required>
    <!-- Login Button -->
    <button class="btn btn-lg btn-primary btn-block" type="submit">Change Password</button>
    <input type="hidden" id="ACTION_SERVICE_CONTROL_KEY" name="ACTION_SERVICE_CONTROL_KEY" value="TEST_ACTION"/>
    </form>
    <?php zReqOnce("/_controls/ui/messageline.php"); ?>
</div> <!-- /container -->
<?php zInc("/gd.trxn.com/_controls/ui/usersafety/foot.php"); ?>