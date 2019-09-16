<?php
error_reporting(0);
session_start();
require_once('dbconnection.php');
require('fpdf18/fpdf.php');
if(!isset($_SESSION['email']))
{
header("location:index.php");
die();
}

$select = "SELECT * FROM users ORDER BY name ASC";
$run = mysql_query($select);
$count = mysql_num_rows($run);

$sel = "SELECT * FROM users WHERE pos='Normal'";
$runadm = mysql_query($sel);
$countadm = mysql_num_rows($runadm);

$selx = "SELECT * FROM users WHERE pos='Admin'";
$runapp = mysql_query($selx);
$countapp = mysql_num_rows($runapp);

$pdf = new FPDF('p','mm','A4');
$pdf->AddPage();
//set font to arial,bold,14pt
//cell
$pdf->Image('images/index.jpeg',5,5,20,20);
$pdf->Ln();

$pdf->SetFont('Times','B',11);
$pdf->Cell(0,10,'ARUSHA TECHNICAL COLLEGE',0,0,'C');
$pdf->Cell(59  ,5,'',0,1);

$pdf->Cell(0,10,'NAIROBI ROAD,P.O.BOX 296,ARUSHA-TANZANIA',0,0,'C');
$pdf->Cell(59  ,5,'',0,1);

$pdf->Cell(0,10,'Telephone: +255 272503040,Fax: +255 272548337',0,0,'C');
$pdf->Cell(59  ,5,'',0,1);

$pdf->Cell(0,10,'Website: www.atc.ac.tz',0,0,'C');
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();
$pdf->SetFont('Times','i',9);
$pdf->Cell(0,10,'College Assets Management System',0,0,'C');
$pdf->Cell(59  ,5,'',0,1);

$pdf->Cell(0,10,'All System users Reports',0,0,'C');
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();

//$pdf->Image("../$picha",5,5,20,20);
//$pdf->Ln();

//The codes for pdf in single user

        $pdf->SetFont('Times','',10);
        $pdf->Cell(10,10,'S/No',1,0,'C');
		$pdf->Cell(45,10,'Fullname',1,0,'C');
		$pdf->Cell(45,10,'Email',1,0,'C');
		$pdf->Cell(45,10,'Title',1,0,'C');
		$pdf->Cell(45,10,'Status',1,0,'C');
		$pdf->Ln();
		$x = 0;
		while($rows = mysql_fetch_array($run))
        {
			$jina = $rows['fname'];
			$email = $rows['email'];
			$tit = $rows['title'];
			$sta = $rows['status'];
            $x++;
            $pdf->Cell(10,10,"{$x}",1,0,'C');
			$pdf->Cell(45,10,"{$jina}",1,0,'C');
			$pdf->Cell(45,10,"{$email}",1,0,'C');
			$pdf->Cell(45,10,"{$tit}",1,0,'C');
			$pdf->Cell(45,10,"{$sta}",1,0,'C');
			$pdf->Ln();

        }

        $pdf->Ln();
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(59,5,"Report Description Below:",0,1);
        $pdf->Ln();
        $pdf->SetFont('Times','i',8);
        $pdf->Cell(59,5,"Normal users: $countadm",0,1);
        $pdf->Cell(59,5,"Administrator: $countapp",0,1);


        $pdf->Ln();
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(59,5,"Total is: $count",0,1);
        $pdf->Ln();

		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();

$pdf->SetFont('Times','',10);
$pdf->Cell(130  ,5,'........................................',0,0);
$pdf->Cell(59  ,5,'',0,1);

$admin = "SELECT * FROM users WHERE title='Admin'";
$run_admin = mysql_query($admin);
$fetch = mysql_fetch_array($run_admin);
$admin_name = $fetch['fname'];
$cheo = $fetch['title'];

$pdf->Cell(130  ,5,"{$admin_name}",0,0);
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();

$pdf->Cell(130  ,5,"{$cheo}",0,0);
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();

$pdf->Cell(130  ,5,'Arusha Technical College (ATC)',0,0);
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();

$pdf->SetFont('Times','i',7);
$pdf->Cell(130  ,5,'College Assets Management System',0,0);
$pdf->Cell(59  ,5,'',0,1);
$pdf->Ln();

$pdf->SetY(-35);
$pdf->SetFont('Times','i',6);
$pdf->SetX($pdf->Margin);
$pdf->Cell(0,10,'Compiler',0,0,'R');

$pdf->Output(); 
?>
