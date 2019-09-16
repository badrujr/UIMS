<?php
session_start();
require_once('dbconnection.php');
if (isset($_POST['login'])) {

  $_SESSION['email'] = mysql_escape_string(trim(strip_tags($_POST['email'])));
  $_SESSION['password'] = mysql_escape_string(trim(strip_tags(SHA1($_POST['password']))));
  $attempt = mysql_real_escape_string(trim(strip_tags($_POST['hidden'])));

  if ($attempt<4) {

  $sel = "SELECT * FROM users WHERE email = '".$_SESSION['email']."' AND password = '".$_SESSION['password']."' && activation = 'yes'";
  $run = mysql_query($sel);
  $num = mysql_num_rows($run);
  
  if ($num == 1) {

    $select = "SELECT * FROM users WHERE email = '".$_SESSION['email']."'";
    $sql = mysql_query($select);
    $data = mysql_fetch_array($sql);
    $pos = $data['pos'];
    $act = $data['activation'];

    if ($pos == 'Admin') {
      header("location:dashboard.php");
    }


    else if ($pos == 'Normal') {
      header("location:user/dashboard.php");
    }

  }
    else{
      $attempt++;
      $error2 = "<div class='alert alert-danger alert-has-icon'>
                         Wrong Email or Password and number of attempt is $attempt...
                         And please contact administrator because your account may not be activated...
                         </div>";
    }
  }

 if ($attempt == 4) {
  $error_attempt = "<div class='alert alert-danger alert-has-icon'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button> login limits exceeded...
                             </div>";
                             header('Refresh:4; URL=index.php');
}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>UIMS - Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>
<!--The script to avoid back button on after logout start here -->
  <script type="text/javascript">
    function preventBack() { window.history.forward();}
    setTimeout("preventBack()",0);
    window.onunload = function () { null };
  </script>
<!-- End here-->
<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Uims Login</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="" class="needs-validation" novalidate="">
                  <input type="hidden" name="hidden" value="<?php echo $attempt;?>">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus  autocomplete="off">
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="forgot-password.php" class="text-small" style="text-decoration: none; color: red;">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <?php echo $error2;?>
                  <?php echo $error_attempt;?>
                  <div class="form-group">
                    <input type="submit" name="login" class="btn btn-primary btn-lg btn-block" value="Login">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>
</html>