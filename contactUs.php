<?php
error_reporting(0);
$country=file_get_contents('http://api.hostip.info/get_html.php?ip=');
$only_country=explode (" ", $country);

class UserInfo{
  private static function get_user_agent() {
    return  $_SERVER['HTTP_USER_AGENT'];
  }
  public static function get_ip() {
    $mainIp = '';
    if (getenv('HTTP_CLIENT_IP'))
      $mainIp = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
      $mainIp = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
      $mainIp = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
      $mainIp = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
      $mainIp = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
      $mainIp = getenv('REMOTE_ADDR');
    else
      $mainIp = 'UNKNOWN';
    return $mainIp;

  }
  public static function get_os() {
    $user_agent = self::get_user_agent();
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array(
      '/windows nt 10/i'      =>  'Windows 10',
      '/windows nt 6.3/i'     =>  'Windows 8.1',
      '/windows nt 6.2/i'     =>  'Windows 8',
      '/windows nt 6.1/i'     =>  'Windows 7',
      '/windows nt 6.0/i'     =>  'Windows Vista',
      '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
      '/windows nt 5.1/i'     =>  'Windows XP',
      '/windows xp/i'         =>  'Windows XP',
      '/windows nt 5.0/i'     =>  'Windows 2000',
      '/windows me/i'         =>  'Windows ME',
      '/win98/i'              =>  'Windows 98',
      '/win95/i'              =>  'Windows 95',
      '/win16/i'              =>  'Windows 3.11',
      '/macintosh|mac os x/i' =>  'Mac OS X',
      '/mac_powerpc/i'        =>  'Mac OS 9',
      '/linux/i'              =>  'Linux',
      '/ubuntu/i'             =>  'Ubuntu',
      '/iphone/i'             =>  'iPhone',
      '/ipod/i'               =>  'iPod',
      '/ipad/i'               =>  'iPad',
      '/android/i'            =>  'Android',
      '/blackberry/i'         =>  'BlackBerry',
      '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value) {
      if (preg_match($regex, $user_agent)) {
        $os_platform    =   $value;
      }
    }   
    return $os_platform;
  }

  public static function  get_browser() {

    $user_agent= self::get_user_agent();

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
      '/msie/i'       =>  'Internet Explorer',
      '/Trident/i'    =>  'Internet Explorer',
      '/firefox/i'    =>  'Firefox',
      '/safari/i'     =>  'Safari',
      '/chrome/i'     =>  'Chrome',
      '/edge/i'       =>  'Edge',
      '/opera/i'      =>  'Opera',
      '/netscape/i'   =>  'Netscape',
      '/maxthon/i'    =>  'Maxthon',
      '/konqueror/i'  =>  'Konqueror',
      '/ubrowser/i'   =>  'UC Browser',
      '/mobile/i'     =>  'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value) {

      if (preg_match($regex, $user_agent)) {
        $browser    =   $value;
      }

    }

    return $browser;

  }

  public static function  get_device(){

    $tablet_browser = 0;
    $mobile_browser = 0;

    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
      $tablet_browser++;
    }

    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
      $mobile_browser++;
    }

    if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
      $mobile_browser++;
    }

    $mobile_ua = strtolower(substr(self::get_user_agent(), 0, 4));
    $mobile_agents = array(
      'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
      'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
      'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
      'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
      'newt','noki','palm','pana','pant','phil','play','port','prox',
      'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
      'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
      'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
      'wapr','webc','winw','winw','xda ','xda-');

    if (in_array($mobile_ua,$mobile_agents)) {
      $mobile_browser++;
    }

    if (strpos(strtolower(self::get_user_agent()),'opera mini') > 0) {
      $mobile_browser++;
              //Check for tablets on opera mini alternative headers
      $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
      if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
        $tablet_browser++;
      }
    }

    if ($tablet_browser > 0) {
             // do something for tablet devices
      return 'Tablet';
    }
    else if ($mobile_browser > 0) {
             // do something for mobile devices
      return 'Mobile';
    }
    else {
             // do something for everything else
      return 'Computer';
    }   

  }


    public static function storeDeviceInfo(){
           $ipAddress= $this->get_ip();
           $os = $this->get_os();
           $device = $this->get_device();
           $browsers = $this->get_browser();

           return storeDeviceInfo();

           $info="INSERT INTO `visited` (`id`, `user_ip`, `os_platform`, `device`,`browser`) VALUES (NULL,'$ipAddress','$os','$device','$browsers'";
          $query=mysql_query($info);
          
    }

}

require_once('dbconnection.php');

if (isset($_POST['contact'])) {
  $name = mysql_escape_string(trim(strip_tags($_POST['name'])));
  $email = mysql_escape_string(trim(strip_tags($_POST['email'])));
  $msg = mysql_escape_string(trim(strip_tags($_POST['msg'])));

  $checkemail = "SELECT * FROM contactus WHERE email = '$email'";
  $run_check = mysql_query($checkemail);
  $num = mysql_num_rows($run_check);

  if ($num == 1) {
    $error_email = "<div class = 'alert alert-danger'> We are sorry $name, The email you provide for us has been used by another user</div>";
  }

  else{

  $sql = "INSERT INTO contactus (name,email,msg) VALUE ('$name','$email','$msg')";
  $run = mysql_query($sql);

  if ($run) {
    $sms = "<div class = 'alert alert-success'>Received! Thank You $name For Your message, Enjoy uims.</div>";
    header('Refresh:3; URL=index.php');
  }

  else{
    $error = "<div class = 'alert alert-danger'>Denied! Something is wrong.</div>";

  }

  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>uims - contacts us</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="admin/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="admin/assets/css/style.css">
  <link rel="stylesheet" href="admin/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="admin/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='admin/assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1">
            <div class="login-brand">
              University Information Management System (uims)
            </div>
            <div class="card card-primary">
              <div class="row m-0">
                <div class="col-12 col-md-12 col-lg-5 p-0">
                  <div class="card-header text-center">
                    <h4>Contact Us</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST">
                      <div class="form-group floating-addon">
                        <label>Name</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="far fa-user"></i>
                            </div>
                          </div>
                          <input id="name" type="text" class="form-control" name="name" autofocus placeholder="Name" autocomplete="off" required="">
                        </div>
                      </div>
                      <div class="form-group floating-addon">
                        <label>Email</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fas fa-envelope"></i>
                            </div>
                          </div>
                          <input id="email" type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" placeholder="Type your message" data-height="150" name="msg" required=""></textarea>
                      </div>
                      <?php echo $sms; echo $error; echo $error_email;?>
                      <div class="form-group text-right">
                        <button type="submit" class="btn btn-round btn-lg btn-primary" name="contact">
                          Send Message
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7 p-0">
                  <div id="map" class="contact-map"></div>
                </div>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; uims 2019 <a href="index.php" style="text-decoration: none;">Home</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="admin/assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyB1R3PZOtJ9yJA7twg_2scQ5tCNEv_bn0w&amp;sensor=true"></script>
  <script src="admin/assets/bundles/gmaps.js"></script>
  <!-- Page Specific JS File -->
  <script src="admin/assets/js/page/contact.js"></script>
  <!-- Template JS File -->
  <script src="admin/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="admin/assets/js/custom.js"></script>
</body>
</html>