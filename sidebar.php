<?php
error_reporting(0);
session_start();
require_once('dbconnection.php');
require_once('UserInfo.php');


$chuo_id = base64_decode($_GET['xxx']);
$sel  = "SELECT * FROM university,campus,faculty,department,programme,organization_type WHERE organization_type.org_type_id = university.org_type_id AND university.id = campus.university_id AND campus.campus_id = faculty.c_id AND faculty.id = department.faculty_id AND department.d_id = programme.d_id AND university.id ='$chuo_id'";
$run = mysql_query($sel);
$x = 0;
while ($fetch = mysql_fetch_array($run)) {
$id = $fetch['id'];
$uni_name = $fetch['university_name'];
$lo = $fetch['location'];
$phy = $fetch['phy_address'];
$org = $fetch['org_name'];
$web = $fetch['website'];
$cont = $fetch['contact'];
$cname = $fetch['name'];
$fname = $fetch['fname'];
$dname = $fetch['d_name'];
$pname = $fetch['pro_name'];
$created_at = $fetch['created_at'];
$x++;
$hide = base64_encode($uni_name);
}

//counting campus,faculty,department and programmes

$selcon  = "SELECT DISTINCT campus.name FROM university,campus,faculty,department,programme,organization_type WHERE organization_type.org_type_id = university.org_type_id AND university.id = campus.university_id AND campus.campus_id = faculty.c_id AND faculty.id = department.faculty_id AND department.d_id = programme.d_id AND university.id ='$chuo_id'";
$runcon = mysql_query($selcon);
$countcamp = mysql_num_rows($runcon);

$selfac  = "SELECT DISTINCT faculty.fname FROM university,campus,faculty,department,programme,organization_type WHERE organization_type.org_type_id = university.org_type_id AND university.id = campus.university_id AND campus.campus_id = faculty.c_id AND faculty.id = department.faculty_id AND department.d_id = programme.d_id AND university.id ='$chuo_id'";
$runfac = mysql_query($selfac);
$countfac = mysql_num_rows($runfac);


$seldept  = "SELECT DISTINCT department.d_name FROM university,campus,faculty,department,programme,organization_type WHERE organization_type.org_type_id = university.org_type_id AND university.id = campus.university_id AND campus.campus_id = faculty.c_id AND faculty.id = department.faculty_id AND department.d_id = programme.d_id AND university.id ='$chuo_id'";
$rundept = mysql_query($seldept);
$countdept = mysql_num_rows($rundept);

$selpro  = "SELECT DISTINCT programme.pro_name FROM university,campus,faculty,department,programme,organization_type WHERE organization_type.org_type_id = university.org_type_id AND university.id = campus.university_id AND campus.campus_id = faculty.c_id AND faculty.id = department.faculty_id AND department.d_id = programme.d_id AND university.id ='$chuo_id'";
$runpro = mysql_query($selpro);
$countpro = mysql_num_rows($runpro);
//end here

?>


 <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="admin/assets/img/book.png">
            </div>
          </div>
         <ul class="sidebar-menu">
            <li class="menu-header">Main Menu</li>
            <li>
              <a href="index.php" class="nav-link"><i data-feather="search"></i><span>Search</span></a>
            </li>
             <li class="menu-header">More Details</li>
          <li class="menu-header">Campuses</li>
            <li class="dropdown">
              <?php 
              echo "<a href='campus.php?xxx=$hide' class='nav-link'><i data-feather='copy'></i><span>campus ($countcamp)</span></a>" ;?>
            </li>
            <li class="menu-header">Faculties</li>
            <li class="dropdown">
               <?php 
               echo "<a href='faculty.php?xxx=$hide' class='nav-link'><i data-feather='copy'></i><span>Faculty ($countfac)</span></a>" ;?>
            </li>
            <li class="menu-header">Departments</li>
            <li class="dropdown">
               <?php 
               echo 
               "<a href='dept.php?xxx=$hide' class='nav-link'><i data-feather='copy'></i><span>Department ($countdept)</span></a>" ;?>
            </li>
            <li class="menu-header">Programmes</li>
            <li class="dropdown">
               <?php 
               echo "<a href='pro.php?xxx=$hide' class='nav-link'><i data-feather='copy'></i><span>Programme ($countpro)</span></a>" ;?>
            </li>
          </ul>
        </aside>
      </div>