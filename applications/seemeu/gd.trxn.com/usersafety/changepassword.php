<?php require_once("../../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zReqOnce("/_controls/ACTION.php"); ?>
<?php
// $designer = new Designer("bootstrap");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">
<title>Change Password</title>
<!-- Bootstrap core CSS -->
<link href="/gd.trxn.com/mimes/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-return-message,
.usersafety-form {
  max-width: 435px;
  padding: 15px;
  margin: 0 auto;
}
.gdtrxn-message,
.usersafety-form .usersafety-form-heading,
.usersafety-form .checkbox {
  margin-bottom: 10px;
}
.usersafety-form .checkbox {
  font-weight: normal;
}
.usersafety-form .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.usersafety-form .form-control:focus {
  z-index: 2;
}
.usersafety-form input[type="password"] {
  margin-bottom: 10px;
}
</style>
</head>
<body>
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
<script src="/gd.trxn.com/mimes/jquery/1.11.1/jquery-1.11.1.js"></script>
<script src="/gd.trxn.com/mimes/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>