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

$user_id = base64_decode($_GET['xxx']);
$view = "SELECT * FROM contactus WHERE id = '$user_id'";
$run_view = mysql_query($view);
$fetch_view = mysql_fetch_array($run_view);
$user_name = $fetch_view['name'];
$msg = $fetch_view['msg'];
$user_email = $fetch_view['email'];
$created_at = $fetch_view['created_at'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>uims - Read Msg</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>


<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                  collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
              <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
              <span class="badge headerBadge1">
                6 </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
                      text-white"> <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">John
                      Deo</span>
                    <span class="time messege-text">Please check your mail !!</span>
                    <span class="time">2 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                      Smith</span> <span class="time messege-text">Request for leave
                      application</span>
                    <span class="time">5 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-5.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jacob
                      Ryan</span> <span class="time messege-text">Your payment invoice is
                      generated.</span> <span class="time">12 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-4.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Lina
                      Smith</span> <span class="time messege-text">hii John, I have upload
                      doc
                      related to task.</span> <span class="time">30
                      Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-3.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jalpa
                      Joshi</span> <span class="time messege-text">Please do as specify.
                      Let me
                      know if you have any query.</span> <span class="time">1
                      Days Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                      Smith</span> <span class="time messege-text">Client Requirements</span>
                    <span class="time">2 Days Ago</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link notification-toggle nav-link-lg"><i data-feather="bell"></i>
              <span class="badge headerBadge2">
                3 </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread"> <span
                    class="dropdown-item-icon bg-primary text-white"> <i class="fas
                        fa-code"></i>
                  </span> <span class="dropdown-item-desc"> Template update is
                    available now! <span class="time">2 Min
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="far
                        fa-user"></i>
                  </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                      Sugiharto</b> are now friends <span class="time">10 Hours
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-success text-white"> <i
                      class="fas
                        fa-check"></i>
                  </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
                    moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                      Hours
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-danger text-white"> <i
                      class="fas fa-exclamation-triangle"></i>
                  </span> <span class="dropdown-item-desc"> Low disk space. Let's
                    clean it! <span class="time">17 Hours Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="fas
                        fa-bell"></i>
                  </span> <span class="dropdown-item-desc"> Welcome to uims
                    template! <span class="time">Yesterday</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/index.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hey <?php echo $name;?></div>
              <a href="profile.php" class="dropdown-item has-icon"> <i class="far
                    fa-user"></i> Profile
              </a> <a href="who.php" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Activities
              </a> <a href="reset-password.php" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="dashboard.php"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">UIS</span>
            </a>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="assets/img/index.png">
            </div>
            <div class="sidebar-user-details">
              <div class="user-name"><?php echo $name;?></div>
              <div class="user-role"><?php echo $pos;?></div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li>
              <a href="dashboard.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="command"></i><span>Apps</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="calendar.php">Calendar</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="mail"></i><span>Email</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="inbox.php">Inbox</a></li>
                <li><a class="nav-link" href="compose.php">Compose</a></li>
                <li><a class="nav-link" href="read.php">Read</a></li>
                <li><a class="nav-link" href="chat.php">Chat</a></li>
              </ul>
            </li>
              <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="user"></i><span>Users</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="add-user.php">Add user</a></li>
                <li><a class="nav-link" href="upload-user.php">Upload user</a></li>
                <li><a class="nav-link" href="manage-user.php">Manage user</a></li>
              </ul>
            </li>
               <li class="menu-header">Organization Type</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="copy"></i><span>Organization</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="add-org.php">Add Organization</a></li>
                <li><a class="nav-link" href="upload-org.php">Upload Organization</a></li>
                <li><a class="nav-link" href="manage-org.php">Manage Organization</a></li>
              </ul>
            </li>
            <li class="menu-header">Universities</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="copy"></i><span>University</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="add-uni.php">Add university</a></li>
                <li><a class="nav-link" href="upload-uni.php">Upload university</a></li>
                <li><a class="nav-link" href="manage-uni.php">Manage university</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="home"></i><span>Campus</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="add-cam.php">Add campus</a></li>
                <li><a class="nav-link" href="upload-cam.php">Upload campus</a></li>
                <li><a class="nav-link" href="manage-cam.php">Manage campus</a></li>
              </ul>
            </li>
            <li class="menu-header">Departments & Faculty</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="grid"></i><span>Faculty</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="add-faculty.php">Add faculty</a></li>
                <li><a class="nav-link" href="upload-faculty.php">Upload faculty</a></li>
                <li><a class="nav-link" href="manage-faculty.php">Manage faculty</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="layout"></i><span>Department</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="add-dept.php">Add department</a></li>
                <li><a class="nav-link" href="upload-dept.php">Upload department</a></li>
                <li><a class="nav-link" href="manage-dept.php">Manage department</a></li>
              </ul>
            </li>
            <li class="menu-header">Programmes</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="image"></i><span>Programme</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="add-pro.php">Add Programme</a></li>
                <li><a href="upload-pro.php">Upload Programme</a></li>
                <li><a href="manage-pro.php">Manage Programme</a></li>
              </ul>
            </li>
              <li class="menu-header">Requirement To Join</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="image"></i><span>Requirements</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="add-req.php">Add Requirement</a></li>
                <li><a href="upload-req.php">Upload Requirement</a></li>
                <li><a href="manage-req.php">Manage Requirement</a></li>
                <li><a href="add-general-req.php">General Requirement</a></li>
                <li><a href="manage-all-req.php">Manage all Requirement</a></li>
              </ul>
            </li>
            <li class="menu-header">Reports & Others</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="file"></i><span>University Reports</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="individual-report.php">Individual Report</a></li>
                <li><a href="general-report.php">General Report</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="anchor"></i><span>Other
                  Pages</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="OnlineVisiters.php">Online Visitors</a></li>
                <li><a class="nav-link" href="comments.php">Comments</a></li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="card">
                  <div class="body">
                    <div id="mail-nav">
                      <button type="button" class="btn btn-danger waves-effect btn-compose m-b-15">COMPOSE</button>
                      <ul class="" id="mail-folders">
                        <li>
                          <a href="inbox.php" title="Inbox">Inbox (10)
                          </a>
                        </li>
                        <li>
                          <a href="javascript:;" title="Sent">Sent</a>
                        </li>
                        <li>
                          <a href="javascript:;" title="Draft">Draft</a>
                        </li>
                        <li>
                          <a href="javascript:;" title="Bin">Bin</a>
                        </li>
                        <li>
                          <a href="javascript:;" title="Important">Important</a>
                        </li>
                        <li>
                          <a href="javascript:;" title="Starred">Starred</a>
                        </li>
                      </ul>
                    
                      <h5 class="b-b p-10 text-strong">Online</h5>
                      <ul class="online-user" id="online-offline">
                        <li><a href="javascript:;"> <img alt="image" src="assets/img/users/user-2.png"
                              class="rounded-circle" width="35" data-toggle="tooltip" title="Sachin Pandit">
                            Sachin Pandit
                          </a></li>
                        <li><a href="javascript:;"> <img alt="image" src="assets/img/users/user-1.png"
                              class="rounded-circle" width="35" data-toggle="tooltip" title="Sarah Smith">
                            Sarah Smith
                          </a></li>
                        <li><a href="javascript:;"> <img alt="image" src="assets/img/users/user-3.png"
                              class="rounded-circle" width="35" data-toggle="tooltip" title="Airi Satou">
                            Airi Satou
                          </a></li>
                        <li><a href="javascript:;"> <img alt="image" src="assets/img/users/user-4.png"
                              class="rounded-circle" width="35" data-toggle="tooltip" title="Angelica Ramos	">
                            Angelica Ramos
                          </a></li>
                        <li><a href="javascript:;"> <img alt="image" src="assets/img/users/user-5.png"
                              class="rounded-circle" width="35" data-toggle="tooltip" title="Cara Stevens">
                            Cara Stevens
                          </a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="card">
                  <div class="boxs mail_listing">
                    <div class="inbox-body no-pad">
                      <section class="mail-list">
                        <div class="mail-sender">
                          <div class="mail-heading">
                            <h4 class="vew-mail-header">
                              <b>Hi Dear, How are you?</b>
                            </h4>
                          </div>
                          <hr>
                          <div class="media">
                            <a href="#" class="table-img m-r-15">
                              <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle" width="35"
                                data-toggle="tooltip" title="Sachin Pandit">
                            </a>
                            <div class="media-body">
                              <span class="date pull-right"><?php echo $created_at;?></span>
                              <h5 class="text-primary"><?php echo $user_name;?></h5>
                              <small class="text-muted">From: <?php echo $user_email;?></small>
                            </div>
                          </div>
                        </div>
                        <div class="view-mail p-t-20">
                          <p><?php echo $msg;?></p>
                        </div>
                        <div class="replyBox m-t-20">
                          <p class="p-b-20">click here to
                            <a href="#">Reply</a> or
                            <a href="#">Forward</a>
                          </p>
                        </div>
                      </section>
                    </div>
                  </div>
                </div>
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
          Copyright &copy; 2019 <div class="bullet"></div> Design By <a href="#">Redstar</a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/ckeditor/ckeditor.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/ckeditor.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


<!-- Mirrored from radixtouch.in/templates/admin/aegis/email-read.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Aug 2019 04:18:41 GMT -->
</html>