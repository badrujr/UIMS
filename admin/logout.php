<?php
require_once('dbconnection.php');
session_start();
session_destroy();
session_unset();
header("location:../index.php");
die();
?>