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
	$uid = mysql_escape_string(trim(strip_tags($_POST['uid'])));
	$jina = mysql_escape_string(trim(strip_tags($_POST['uname'])));
	$lo = mysql_escape_string(trim(strip_tags($_POST['lo'])));
	$org = mysql_escape_string(trim(strip_tags($_POST['org'])));
	$web = mysql_escape_string(trim(strip_tags($_POST['web'])));
	$cont = mysql_escape_string(trim(strip_tags($_POST['con'])));
	$phy = mysql_escape_string(trim(strip_tags($_POST['phy'])));
	$uid = mysql_escape_string(trim(strip_tags($_POST['uid'])));

	$orgid = "SELECT * FROM organization_type WHERE org_name = '$org'";
    $run_orgid = mysql_query($orgid);
    $info = mysql_fetch_array($run_orgid);
    $oids = $info['org_type_id'];

	$upt = "UPDATE university SET university_name = '$jina', location = '$lo', org_type_id = '$oids', contact = '$cont', phy_address = '$phy' WHERE id = '$uid'";
	$run = mysql_query($upt);

	if ($run) {
		header("location:manage-uni.php");
		die();
	}

	else{
		echo"An error occured";
		die();
	}
}

?>