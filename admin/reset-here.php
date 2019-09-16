<?php
error_reporting(0);
require_once('dbconnection.php');
$a=mysql_real_escape_string(base64_decode($_GET['xxxx']));
$select="SELECT * FROM users WHERE email='$a'";
 $query = mysql_query($select);
$fetch = mysql_fetch_array($query);
$email=$fetch['email'];
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

<?php
require_once('dbconnection.php');
if(isset($_POST['save']))
{
  $email=mysql_real_escape_string(trim(strip_tags($_POST['email'])));
  $password=mysql_real_escape_string(trim(strip_tags(SHA1($_POST['password']))));
  $retype=mysql_real_escape_string(trim(strip_tags(SHA1($_POST['retry']))));
  
  
  if($retype == $password && $retype && $password){
  $query="UPDATE users set password='$password' where email='$email'";
  $run=mysql_query($query);
  if($run)
  {
    $sms = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Successfully!</strong> Your Password has been changed ..
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>×</span>
                </button>
              </div>";
              header('Refresh:3; URL=index.php');
  }
  else
  { 
$error1 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Access Denied!</strong> Error occured ..
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>×</span>
                </button>
              </div>";
              
  }
}else{
  $error = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Warning!</strong> Your passwords does not match..
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>×</span>
                </button>
              </div>";
              }
}
?>
<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Reset Your Password</h4>
              </div>
              <div class="card-body">
                <p class="text-muted">Now Your able to reset your password</p>
                <form method="POST" action="">
                  <input type="hidden" value="<?php echo $email; ?>" name="email"><br>
                  <div class="form-group">
                    <label for="email">Password</label>
                    <input id="email" type="password" class="form-control" name="password" tabindex="1" required autofocus>
                  </div>
                  <div class="form-group">
                    <label for="email">Confirm Password</label>
                    <input id="email" type="password" class="form-control" name="retry" tabindex="1" required autofocus>
                  </div>
                    <?php echo $sms;?>
                                <?php echo $error1;?>
                                <?php echo $error;?>
                  <div class="form-group">
                    <input type="submit" name="save" class="btn btn-primary btn-lg btn-block" tabindex="4" value="Reset Your Password">
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