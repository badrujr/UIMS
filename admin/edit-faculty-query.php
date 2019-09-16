<?php
session_start();
require_once('dbconnection.php');
if (!isset($_SESSION['email'])) {
  header("location:index.php");
  die();
}

else{

   $select = "SELECT * FROM users WHERE email = '".$_SESSION['email']."'";
    $sql = mysql_query($select);
    $data = mysql_fetch_array($sql);
    $pos = $data['pos'];
    $name = $data['name'];
}

if (isset($_POST['save'])) {
	$fid = mysql_escape_string(trim(strip_tags($_POST['fid'])));
	$fname = mysql_escape_string(trim(strip_tags($_POST['fname'])));
	$uname = mysql_escape_string(trim(strip_tags($_POST['uname'])));
	$cname = mysql_escape_string(trim(strip_tags($_POST['cname'])));
	$created_at = date('Y/m/d H:i:s');

	$orgid = "SELECT * FROM campus WHERE name = '$cname'";
    $run_orgid = mysql_query($orgid);
    $info = mysql_fetch_array($run_orgid);
    $cid = $info['campus_id'];

	$upt = "UPDATE faculty SET fname = '$fname', c_id = '$cid', created_at = '$created_at' WHERE id = '$fid'";
	$run = mysql_query($upt);

	if ($run) {
		header("location:manage-faculty.php");
		die();
	}

	else{
		echo"An error occured";
		die();
	}
}

?>