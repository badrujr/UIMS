<?php
session_start();
require_once('dbconnection.php');
require('fpdf18/fpdf.php');

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

$chuo = base64_decode($_GET['xxx']);
$select = "SELECT * FROM university,campus,faculty,department,programme,organization_type WHERE organization_type.org_type_id = university.org_type_id AND university.id = campus.university_id AND campus.campus_id = faculty.c_id AND faculty.id = department.faculty_id AND department.d_id = programme.d_id AND university.university_name ='$chuo'";
$run = mysql_query($select);
$fetch = mysql_fetch_array($run);
$uni_name = $fetch['university_name'];
$id = $fetch['id'];
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
$tdate = $data['tdate'];
//$demox = date('D, M j,Y');
 $action="Generate pdf for $uni_name";
    $dt=date("y-m-d h:i:s");

           if($fname !== "")
    {
          $inv="  INSERT INTO `visited` (`id`, `fname`, `title`, `action`,`date_time`) VALUES (NULL, '$fname', '$tit','$action','$dt')";
         $iser=mysql_query($inv);
         if($iser){
          
         }
         else{
             $iser=mysql_query($inv);
         }

    }
        else{
            echo"mmmh";
        }

$pdf = new FPDF('p','mm','A4');


$file = "$fname.pdf";

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}

$pdf->AddPage();
//set font to arial,bold,14pt
//cell
$pdf->SetDisplayMode(real, 'default');
$pdf->Image('assets/img/ternet.png',82,28,32,22);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Tanzania Education And Research Network (TERNET)',0,0,'C');
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','',8);
$pdf->Cell(130,5,'Tel:+255 222 77 5378',0,0,'L');
$pdf->Cell(59  ,5,'Kijitonyama (Sayansi) - COSTECH Building',0,1,'R');

$pdf->Cell(130,5,'Fax No:027 254 8337',0,0,'L');
$pdf->Cell(59  ,5,'Bagamoyo Road',0,1,'R');

$pdf->Cell(130,5,'P.O.BOX 95062',0,0,'L');
$pdf->Cell(59  ,5,'Email: helpdesk@ternet.or.tz',0,1,'R');

$pdf->Cell(130,5,"Dar es salaam, Tanzania.",0,0,'L');
$pdf->Cell(59  ,5,'Website: http://www.ternet.ac.tz',0,1,'R');
$pdf->Ln();
$pdf->SetFont('Times','',9);
$pdf->Cell(0,10,'University Information Management System (uims)',0,0,'C');
$pdf->Cell(59  ,5,'',0,1);

$pdf->Cell(0,10,"PDF Document for $uni_name",0,0,'C');
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();

//The codes for pdf in single user

        $pdf->SetFont('Times','',10);
        $pdf->Cell(10,10,'S/No',1,0,'C');
        $pdf->Cell(45,10,'Campuses',1,0,'C');
        $pdf->Cell(45,10,'Faculty',1,0,'C');
        $pdf->Cell(45,10,'Department',1,0,'C');
        $pdf->Cell(45,10,'Programmes',1,0,'C');
        $pdf->Ln();
        $x = 0;
        while($rows = mysql_fetch_array($run))
        {
            $uni_name = $rows['university_name'];
            $id = $rows['id'];
            $lo = $rows['location'];
            $phy = $rows['phy_address'];
            $org = $rows['org_name'];
            $web = $rows['website'];
            $cont = $rows['contact'];
            $cname = $rows['name'];
            $fname = $rows['fname'];
            $dname = $rows['d_name'];
            $pname = $rows['pro_name'];
            $created_at = $rows['created_at'];
            $x++;
            $pdf->Cell(10,10,"{$x}",1,0,'C');
            $pdf->Cell(45,10,"{$uni_name}",1,0,'C');
            $pdf->Cell(45,10,"{$cname}",1,0,'C');
            $pdf->Cell(45,10,"{$fname}",1,0,'C');
            $pdf->Cell(45,10,"{$dname}",1,0,'C');
            $pdf->Cell(45,10,"{$pro}",1,0,'C');
            $pdf->Ln();

        }

        $pdf->Ln();
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(59,5,"Report Description Below:",0,1);
        $pdf->Ln();
        $pdf->SetFont('Times','i',8);
        $pdf->Cell(59,5,"Total Campuses: $countadm",0,1);
        $pdf->Cell(59,5,"Total Department: $countapp",0,1);
        $pdf->Cell(59,5,"Total Faculties: $countapp",0,1);


        $pdf->Ln();
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(59,5,"Total is: $count",0,1);
        $pdf->Ln();

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();


$pdf->Cell(130  ,5,'Kind regards, ',0,0);
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();

$pdf->Cell(130  ,5,'......................................',0,0);
$pdf->Cell(59  ,5,'',0,1);

$ipt = "SELECT * FROM users WHERE pos='Admin'";
$run_app = mysql_query($ipt);
$fetch = mysql_fetch_array($run_app);
$app_name = $fetch['name'];
$cheo = $fetch['pos'];

$pdf->Cell(130  ,5,"{$app_name}",0,0);
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();

$pdf->Cell(130  ,5,"{$cheo}",0,0);
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();

$pdf->SetFont('Times','i',7);
$pdf->Cell(130  ,5,'University Information System',0,0);
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();

$pdf->SetY(-35);
$pdf->SetFont('Times','i',6);
$pdf->SetX($pdf->Margin);
$pdf->Cell(0,10,'Developed By Ternet-Development',0,0,'R');

$pdf->Output("{$fnamex}uis",'I'); 
 
?>
