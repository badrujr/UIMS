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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Uims - Search University</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="admin/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="admin/assets/css/style.css">
  <link rel="stylesheet" href="admin/assets/css/components.css">
   <link rel="stylesheet" href="admin/assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
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
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <h4 style="font-family: Comic Sans MS;"><img src="admin/assets/img/tan.gif" style="height: 30px; width: 50px;" class="rounded-circle">University Infromation Management System (UIMS)</h4>
            <div class="page-description"> 
              <p style="font-size: 18px; color: maroon; font-family: Comic Sans MS;">This Search Engine Will Help You To Get More Information About The Particular University/Institute/College...</p>
               <div class="sidebar-user-details">
              <div class="user-name"><img src='admin/assets/img/finding-signatures.gif' style='height: 110px; width: 100px;' class="user-img-radious-style"></div>
            </div>
            </div>
            <div class="page-search">
              <form method="POST" action="">
                <div class="form-group floating-addon floating-addon-not-append">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-search"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Search" name="tafuta" autocomplete="off" required="">
                    <div class="input-group-append">
                      <input type="submit" name="search" class="btn btn-primary btn-lg" value="Search">
                    </div>
                  </div>
                </div>
              </form>
              <?php
            session_start();
            require_once('dbconnection.php');
            if (isset($_POST['search'])) {
            $searchq = mysql_escape_string(trim(strip_tags($_POST['tafuta'])));
            //$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
            $query = "SELECT * FROM university WHERE university_name LIKE '%$searchq%' OR website LIKE '%$searchq%'";
            $sql = mysql_query($query);
            $count = mysql_num_rows($sql);
            $x = 0;
            if ($count <= 0) {
              echo "
              <img src='admin/assets/img/404.gif' style='height: 150px; width: 140px;'>";
            }
              else{
                 while ($rows = mysql_fetch_array($sql)) {
                    $id = $rows['id'];
                    $uname = $rows['university_name'];
                    $org = $rows['org_name'];
                    $web = $rows['website'];
                    $campus = $rows['name'];
                    $faculty = $rows['fname'];
                    $dept = $rows['d_name'];
                    $pro = $rows['pro_name'];
                    $x++;
                    $hide = base64_encode($id);
                    echo "

                     <div class='card mb-0'>
                  <div class='card-body'>
                  <div class='card-header'>
                    <h4>Results Found for <b style = 'color: red;'><a href = 'UniversityDetails.php?xxx=$hide' style = 'text-decoration:none; color: red;'>$searchq, <b style = 'color:black;'> as $uname</b></a> </b></h4>
                  </div>  
                  </div>
                </div>
                  <br>";
        }
      } 
}
?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
        <div class="simple-footer">
              Copyright &copy; uims 2019 <a href="contactUs.php" style="text-decoration: none;">Contact us</a>
            </div>
    </section>
  </div>
    
  <!-- General JS Scripts -->
  <script src="admin/assets/js/app.min.js"></script>
   <!-- JS Libraies -->
  <script src="admin/assets/bundles/datatables/datatables.min.js"></script>
  <script src="admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="admin/assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="admin/assets/js/page/datatables.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="admin/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="admin/assets/js/custom.js"></script>
</body>
</html>