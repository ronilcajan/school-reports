<?php

include '../server/server.php';
require '../vendor/autoload.php';
require '../assets/fpdf/fpdf.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$data = unserialize($_POST['data']);
$data1 = $data;
$periode = $conn->real_escape_string($_POST['periode']);
$nature = $conn->real_escape_string($_POST['nature']);
$etab = $conn->real_escape_string($_POST['etab']);
$intervalle = $conn->real_escape_string($_POST['intervalle']);
$year = $conn->real_escape_string($_POST['year']);
$promo = $conn->real_escape_string($_POST['promo']);
!empty($promo) ? null : $promo = 'All';

class PDF extends FPDF{
    function Header(){
        global $periode;
        global $nature;
        global $etab;
        global $intervalle;
        global $year;
        global $promo;
        global $header;
        $title = 'UNIVERSITE INTERNATIONALE';
        
        $this->SetFont('Arial','B',12);
        $this->SetFillColor(34,43,53);
        $this->SetTextColor(236, 239, 244);
        $this->Cell(275,20,$title,'LTR',1,'C',true);   
        $this->SetFont('Arial','B',9);
        $this->Cell(275,10,"ANNEE UNIVERSITAIRE ".$year,'LR',1,'C',true);
        $this->Cell(220,-25,"NOTES D'ASSIDUITE ".$periode." ".$nature." ".$etab." Promo:".$promo,0,1,'C',false);
        $this->Cell(345,25,": From ".$intervalle,0,1,'C',false);
        $this->SetTextColor(34,43,53);
        $this->Cell(275,4,"Promotion : ".$promo,'LBR',1,'R',true);
        $this->SetTextColor(34,43,53);
        $this->Cell(200,-10,"Promotion : ".$promo,0,1,'R',false);
        $this->Image('../assets/images/logo.png',15,15,24);
        // Arial bold 
        $this->Ln(15);
        // Line break
        // Header
        $w = array(50, 30, 30, 30,30, 20, 20, 20,25, 20);
        $this->SetFillColor(34,43,53);
        $this->SetTextColor(236, 239, 244);
        $this->SetFont('Arial','',9);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln(7);

        parent::Header();
    }
        // Page footer
    function Footer(){
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        $this->SetTextColor(1, 1, 1);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

        // Better table
    function Table($header, $data)
    {
        // Column widths
        $w = array(50, 30, 30, 30,30, 20, 20, 20,25, 20);
        // Header
        // $this->SetFillColor(34,43,53);
        // $this->SetTextColor(236, 239, 244);
        // $this->SetFont('Arial','',9);
        // for($i=0;$i<count($header);$i++)
        //     $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        // $this->Ln(7);
        $this->SetTextColor(34,43,5);

        foreach($data as $row){
            $this->Cell($w[0],6,$row['id_admission'],1,false);
            $this->Cell($w[1],6,$row['nom'],1,false);
            $this->Cell($w[2],6,$row['prenom'],1,false);
            $this->Cell($w[3],6,$row['etab'],1,0,'C',false);
            $this->Cell($w[4],6,$row['formation'],'LRTB',0,'C',false);
            $this->Cell($w[5],6,$row['promo'],1,0,'C',false);
            $this->Cell($w[6],6,$row['vhr'],1,0,'C',false);
            $this->Cell($w[7],6,$row['vha'],1,0,'C',false);
            $this->Cell($w[8],6,$row['percent'],1,0,'C',false);
            $this->Cell($w[9],6,$row['notes'],1,0,'C',false);
            $this->Ln();
        }

        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
}
if(isset($_POST['addHistory'])){

    $header = array('ID_Admission','Nom','Prenom','Etablissement','Formation','Promotion','VHR','VHA',"% d'Absence",'Notes');
    $pdf = new PDF('L','mm','A4');
    $pdf->AddPage();
    $pdf->Table($header,$data);
    $pdf->AliasNbPages();
    $pdffilename = 'PDF-Report'.date('dmYHis').'.pdf';
    $pdf->Output('F', '../uploads/'.$pdffilename);

    $phpExcel = new Spreadsheet();
    $phpExcel->getProperties()->setCreator($_SESSION['username'])
             ->setTitle('Student Report');
    $data = unserialize($_POST['data']);
    $periode = $conn->real_escape_string($_POST['periode']);
    $nature = $conn->real_escape_string($_POST['nature']);
    $etab = $conn->real_escape_string($_POST['etab']);
    $intervalle = $conn->real_escape_string($_POST['intervalle']);
    
    $phpExcel->getActiveSheet()->setTitle("Student Reports");

    $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','ID_Admission')
            ->setCellValue('B1','Nom')
            ->setCellValue('C1','Prénom')
            ->setCellValue('D1','Etablissement')
            ->setCellValue('E1','Formation')
            ->setCellValue('F1','Promotion')
            ->setCellValue('G1','VHR')
            ->setCellValue('H1','VHA')
            ->setCellValue('I1',"% d'Absence")
            ->setCellValue('J1','Note');
    $col = 2;
    foreach ($data as $row) {
        $phpExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow( 1 , $col , $row['id_admission'])
                ->setCellValueByColumnAndRow( 2 , $col , $row['nom'])
                ->setCellValueByColumnAndRow( 3 , $col , $row['prenom'])
                ->setCellValueByColumnAndRow( 4 , $col , $row['etab'])
                ->setCellValueByColumnAndRow( 5 , $col , $row['formation'])
                ->setCellValueByColumnAndRow( 6 , $col , $row['promo'])
                ->setCellValueByColumnAndRow( 7 , $col , $row['vhr'])
                ->setCellValueByColumnAndRow( 8 , $col , $row['vha'])
                ->setCellValueByColumnAndRow( 9 , $col , $row['percent'])
                ->setCellValueByColumnAndRow( 10 , $col , $row['notes']);
    $col++;
    }
    $writer = new Xlsx($phpExcel);
    $excelFilname = 'Excel-Report-'.date('dmYHis').'.xlsx';
    $writer->save('../uploads/'.$excelFilname);
    
    $user = $_SESSION['username'];
    $insert 	= "INSERT INTO history (user, periode, nature, etab, promo, `year`, intervalle, pdf,excel) 
                VALUES ('$user','$periode', '$nature', '$etab', '$promo', '$year', '$intervalle', '$pdffilename', '$excelFilname')";	
    $insert_res 	= $conn->query($insert);

    if($insert_res){
        $last_id = $conn->insert_id;

        foreach ($data1 as $row) {
            $query 	= "INSERT INTO calculation (history_id, id_admission,nom,prenom, etab, formation, promo,a,b,c,d,z,vhr,vha,percent,notes) 
                     VALUES ($last_id,'".$row["id_admission"]."','".$row['nom']."','".$row['prenom']."','".$row['etab']."','".$row['formation']."','".$row['promo']."','".$row['a']."','".$row['b']."','".$row['c']."','".$row['d']."','".$row['z']."','".$row['vhr']."','".$row['vha']."','".$row['percent']."','".$row['notes']."')";	
            $conn->query($query);
        }

        $_SESSION['message'] = "Report has been saved!";
        header('location: ../calcu/calcu.php');
    }

	$conn->close();


}


