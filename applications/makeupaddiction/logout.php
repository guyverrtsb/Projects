<?php
include_once './config.php';
session_destroy();
setcookie("user_id",$_SESSION['user_id'], time() - (3600), "/");
    cheader("../index.php");



