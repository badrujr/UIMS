<?php
error_reporting(0);
require_once('dbconnection.php');
if(isset($_REQUEST['reset'])){
    $to= mysql_escape_string($_REQUEST['email']);
    $from="zbadru18@gmail.com";
    $subject="Reset your password here";
    $message="click here to reset <a href='resert-here.php?email=$to'>Reset here</a>";
    $select="SELECT * FROM users WHERE email='$to'";
    $query=mysql_query($select);
    $row=mysql_num_rows($query);
    $sec = base64_encode($to);
    if($row==1){
    if($to && $from && $message && $subject){
        mail($to, $subject, $message, $from);
        echo"<script>
                    window.alert('Almost There, Visit Your Email Account...!');
                    window.location.href='reset-here.php?xxxx=$sec';
                    </script>";
    }else{
        $sms = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                                <strong>Warning!</strong> Please enter Your Email..
                                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                    <span aria-hidden='true'>×</span>
                                                </button>
                                            </div>";
}
    }else{
        $sms1 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                <strong>Warning!</strong> Please provide your registered email address, This email $to is not registered in our system....
                                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                    <span aria-hidden='true'>×</span>
                                                </button>
                                            </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>uims - Reset Password</title>
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
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Forgot Password</h4>
              </div>
              <div class="card-body">
                <p class="text-muted">We will send a link to reset your password</p>
                <form method="POST" action="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                  </div>
                     <?php echo $sms;?>
                            <?php echo $sms1;?>
                  <div class="form-group">
                    <input type="submit" name="reset" class="btn btn-primary btn-lg btn-block" tabindex="4" value="Forgot Password">
                  </div>
                     <div class="float-right">
                        <a href="index.php" class="text-small" style="text-decoration: none; color: red;">
                          Remember Your Password?
                        </a>
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