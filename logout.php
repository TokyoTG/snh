<?php
require_once('./functions/alert.php');
session_start();
storeTime($_SESSION['email']);
session_unset();
session_destroy();
 header("location:login.php");
