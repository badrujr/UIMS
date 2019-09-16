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
	$cid = mysql_escape_string(trim(strip_tags($_POST['cid'])));
	$cname = mysql_escape_string(trim(strip_tags($_POST['cname'])));
	$org = mysql_escape_string(trim(strip_tags($_POST['org'])));
	$lo = mysql_escape_string(trim(strip_tags($_POST['lo'])));
	 $created_at = date('Y/m/d H:i:s');

	$orgid = "SELECT * FROM university WHERE university_name = '$org'";
    $run_orgid = mysql_query($orgid);
    $info = mysql_fetch_array($run_orgid);
    $uids = $info['id'];

	$upt = "UPDATE campus SET name = '$cname', university_id = '$uids', created_at = '$created_at' WHERE campus_id = '$cid'";
	$run = mysql_query($upt);

	if ($run) {
		header("location:manage-cam.php");
		die();
	}

	else{
		echo"An error occured";
		die();
	}
}

?>