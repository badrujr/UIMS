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
	$fname = mysql_escape_string(trim(strip_tags($_POST['fac'])));

	$del = "DELETE FROM faculty WHERE id = '$fid'";

	$run = mysql_query($del);

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