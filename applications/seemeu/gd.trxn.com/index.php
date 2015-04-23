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
<title>Change Password</title>
<!-- Bootstrap core CSS -->
<link href="/gd.trxn.com/mimes/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<style>
.container { border: 1px solid red; }
.container {
  width: auto;
  max-width: 360px;
  padding: 0 15px;
}
.container .text-muted {
  margin: 20px 0;
}

body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;s
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
</head>
<body>
<div class="container">
    <form class="form-signin">
    <h2 class="form-signin-heading">Please sign in</h2>
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
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</div> <!-- /container -->
<script src="/gd.trxn.com/mimes/jquery/1.11.1/jquery-1.11.1.js"></script>
<script src="/gd.trxn.com/mimes/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>