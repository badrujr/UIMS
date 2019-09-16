<?php
error_reporting(0);
session_start();
require_once('dbconnection.php');
require_once('UserInfo.php');

$chuo_id = base64_decode($_GET['xxx']);
$sel  = "SELECT * FROM university,campus,faculty,department,programme,organization_type WHERE organization_type.org_type_id = university.org_type_id AND university.id = campus.university_id AND campus.campus_id = faculty.c_id AND faculty.id = department.faculty_id AND department.d_id = programme.d_id AND university.id ='$chuo_id'";
$run = mysql_query($sel);
$x = 0;

$selfeed  = "SELECT * FROM university,campus,faculty,department,programme,organization_type WHERE organization_type.org_type_id = university.org_type_id AND university.id = campus.university_id AND campus.campus_id = faculty.c_id AND faculty.id = department.faculty_id AND department.d_id = programme.d_id AND university.id ='$chuo_id'";
$runfeed = mysql_query($selfeed);
$xfeed = 0;

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>UIS - IndividualPreview</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="admin/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="admin/assets/css/style.css">
  <link rel="stylesheet" href="admin/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="admin/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='admin/assets/img/book.png' />
</head>
<!--The script to avoid back button on after logout start here -->
  <script type="text/javascript">
    function preventBack() { window.history.forward();}
    setTimeout("preventBack()",0);
    window.onunload = function () { null };
  </script>
<!-- End here-->
<body>
  <div class="loader">
    
  </div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg">
        
      </div>
        <nav class="navbar navbar-expand-lg main-navbar">
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle">
              <b style="color: green;">Ip Address:</b>   <?= UserInfo::get_ip();?>
          </li>
          <li class="dropdown dropdown-list-toggle">
            <b style="color: green;">Device:</b>   <?= UserInfo::get_device();?><br>
          </li>
           <li class="dropdown dropdown-list-toggle">
            <b style="color: green;">Os:</b>  <?= UserInfo::get_os();?><br>
          </li>
        <li class="dropdown dropdown-list-toggle" style="float: right;">
          <b style="color: green;">Browser:</b>   <?= UserInfo::get_browser();?><br>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="admin/assets/img/book.png">
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li>
              <a href="index.php" class="nav-link"><i data-feather="search"></i><span>Search</span></a>
            </li>
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
             <div class='main-content'>
        <section class='section'>
          <div class='section-body'>
            <div class='invoice'>
              <div class='invoice-print'>
                <div class='row'>
                  <div class='col-lg-12'>
                    <div class='invoice-title'>
                      <h2><?php echo $uni_name;?></h2>
                      <div class='invoice-number'>ID: <?php echo $id;?></div>
                    </div>
                    <hr>
                    <div class='row'>
                      <div class='col-md-6'>
                        <address>
                          <strong>More Information:</strong><br>
                          Website: <b><?php echo "<a href = '' style = 'color: red; text-decoration: none;'>$web</a>" ;?></b><br>
                          Physical Address: <?php echo $phy;?><br>
                        </address>
                      </div>
                      <div class='col-md-6 text-md-right'>
                        <address>
                          <strong>Organization Type:</strong><br>
                          <b style = 'color: green;'><?php echo $org;?></b><br>
                        </address>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-md-6'>
                        <address>
                          <strong>Contacts:</strong><br>
                          <?php echo $cont;?><br>
                        </address>
                      </div>
                      <div class='col-md-6 text-md-right'>
                        <address>
                          <strong>Entry Date:</strong><br>
                          <?php echo $created_at;?><br><br>
                        </address>
                      </div>
                    </div>
                  </div>
                </div>
                <div class='row mt-4'>
                  <div class='col-md-12'>
                    <div class='section-title'><b style = 'color: green;'><?php echo $uni_name; ?></b> Summary</div>
                    <p class='section-lead'>All Campuses, Faculties, Departments And Programmes..</p>
                    <div class='table-responsive'>
                      <table class='table table-striped table-hover table-md'>
                        <tr>
                          <th data-width='40'>#</th>
                          <th>Campus</th>
                          <th class='text-center'>Faculty</th>
                          <th class='text-center'>Department</th>
                          <th class='text-right'>Programmes</th>
                        </tr>
                      <?php
                        while ($fetchfeed = mysql_fetch_array($runfeed)) {
                        $id = $fetchfeed['id'];
                        $uni_name = $fetchfeed['university_name'];
                        $lo = $fetchfeed['location'];
                        $phy = $fetchfeed['phy_address'];
                        $org = $fetchfeed['org_name'];
                        $web = $fetchfeed['website'];
                        $cont = $fetchfeed['contact'];
                        $cname = $fetchfeed['name'];
                        $fname = $fetchfeed['fname'];
                        $dname = $fetchfeed['d_name'];
                        $pname = $fetchfeed['pro_name'];
                        $created_at = $fetchfeed['created_at'];
                        $xfeed++;
                        $hide = base64_encode($uni_name);

                    echo"
                         <tr>
                          <td>$xfeed</td>
                          <td>$cname</td>
                          <td class='text-center'>$fname</td>
                          <td class='text-center'>$dname</td>
                          <td class='text-right'>$pname</td>
                         </tr>
                      ";
}
                      ?>
                      </table>
                    </div>
                  </div>
                </div>
                     </div>
              <hr>
              <div class='text-md-right'>
                <div class='float-lg-left mb-lg-0 mb-3'>
                </div>
                <a href = 'collegeIndReport.php?xxx=<?php echo $hide;?>' class = 'btn btn-primary btn-icon icon-left' target = '_blank'><i class='fas fa-print'></i></a>
              </div>
            </div>
          </div>
        </section>
            
         
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label>
                    <span class="control-label p-r-20">Mini Sidebar</span>
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <div class="disk-server-setting m-b-20">
                    <p>Disk Space</p>
                    <div class="sidebar-progress">
                      <div class="progress" data-height="5">
                        <div class="progress-bar l-bg-green" role="progressbar" data-width="80%" aria-valuenow="80"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <span class="progress-description">
                        <small>26% remaining</small>
                      </span>
                    </div>
                  </div>
                  <div class="disk-server-setting">
                    <p>Server Load</p>
                    <div class="sidebar-progress">
                      <div class="progress" data-height="5">
                        <div class="progress-bar l-bg-orange" role="progressbar" data-width="58%" aria-valuenow="25"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <span class="progress-description">
                        <small>Highly Loaded</small>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2019 <div class="bullet"></div> Design By <a href="#">TERNET-DEV</a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="admin/assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="admin/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="admin/assets/js/custom.js"></script>
</body>
</html>