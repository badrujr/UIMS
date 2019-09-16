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
	$oid = mysql_escape_string(trim(strip_tags($_POST['oid'])));
	$org = mysql_escape_string(trim(strip_tags($_POST['org'])));
	$created_at = date('Y/m/d H:i:s');

	$upt = "UPDATE organization_type SET name = '$org', created_at = '$created_at'  WHERE org_type_id = '$oid'";
	$run = mysql_query($upt);

	if ($run) {
		header("location:manage-org.php");
		die();
	}

	else{
		echo"An error occured";
		die();
	}
}

?>