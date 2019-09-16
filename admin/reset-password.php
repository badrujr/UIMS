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


if(isset($_POST['save']))
{

$opass = mysql_real_escape_string(trim(strip_tags(SHA1($_POST['opass']))));

$npass = mysql_real_escape_string(trim(strip_tags(SHA1($_POST['npass']))));

$cpass = mysql_real_escape_string(trim(strip_tags(SHA1($_POST['cpass']))));

$email = $_SESSION['email'];

$oqr = mysql_query("select password from users where email ='{$email}'") or die("somwthing is wrong...");

$odata = mysql_fetch_row($oqr);

if($odata[0]==$opass)
{
if($npass == $cpass)
{
$q = mysql_query("UPDATE users SET password='{$npass}' WHERE email='{$email}'") or die("Can not Change...");
if($q)
{
echo"<script>
          window.alert('Password Has been Changed successfully!');
          window.location.href='dashboard.php';
            </script>";
}

}
else
{
echo"<script>alert('New password and confirm password not match...')</script>";
}

}
else
{
echo "<script>alert('old password not match...')</script>";
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
                <h4>Reset Password</h4>
              </div>
              <div class="card-body">
                <?php echo"$sms";?>
                          <?php echo"$error";?>
                <p class="text-muted">Enter Your New Password</p>
                <form method="POST">
                  <div class="form-group">
                    <label for="email">Old Password</label>
                    <input id="email" type="password" class="form-control" name="opass" tabindex="1" required autofocus>
                  </div>
                  <div class="form-group">
                    <label for="password">New Password</label>
                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                      name="npass" tabindex="2" required>
                    <div id="pwindicator" class="pwindicator">
                      <div class="bar"></div>
                      <div class="label"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="cpass"
                      tabindex="2" required>
                  </div>
                  <div class="form-group">
                    <input class="btn btn-primary btn-lg btn-block" tabindex="4" type="submit" value="Reset Password" name="save">
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


<!-- Mirrored from radixtouch.in/templates/admin/aegis/auth-reset-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Aug 2019 07:32:12 GMT -->
</html>