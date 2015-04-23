<?php require_once("../../gd.trxn.com/_controls/classes/_syscore.php"); ?>
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
<title>Login</title>
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
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
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
.usersafety-form input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.usersafety-form input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
</head>
<body>
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
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
    <?php zReqOnce("/_controls/ui/messageline.php"); ?>
</div> <!-- /container -->
<script src="/gd.trxn.com/mimes/jquery/1.11.1/jquery-1.11.1.js"></script>
<script src="/gd.trxn.com/mimes/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>