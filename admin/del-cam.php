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
	$cname = mysql_escape_string(trim(strip_tags($_POST['cam'])));

	$del = "DELETE FROM campus WHERE campus_id = '$cid'";

	$run = mysql_query($del);

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