<?php 
    include '../server/server.php';
    require_once ('../vendor/autoload.php');
if (isset($_POST["import"])) {

        $allowedFileType = [
            'application/vnd.ms-excel',
            'text/xls',
            'text/xlsx',
            "application/octet-stream" ,
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];
    
    if (in_array($_FILES["file"]["type"], $allowedFileType)) {
        $newimg = date('dmYHis').str_replace(" ", "", $_FILES['file']['name']);
        $targetPath = '../uploads/'.basename($newimg);
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        \PhpOffice\PhpSpreadsheet\Calculation\Functions::RETURNDATE_PHP_OBJECT;
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($targetPath); //Load the excel form
        
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow(); // total number of rows
        $highestColumn = $worksheet->getHighestColumn(); // total number of columns
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
        
        $lines = $highestRow - 2; 
        if ($lines <= 0) {
                Exit ('There is no data in the Excel table');
        }
        
        $sql = "INSERT INTO students (id_admission, nom, prenom, etab, formation, promo, seance, `type`, debut, fin, duree, `date`, heure_pointage, categorie, enseig, cat_fusionee) VALUES ";
        
        for ($row = 2; $row <= $highestRow; ++$row) {
                $id_admission = $conn->real_escape_string($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                $nom = $conn->real_escape_string($worksheet->getCellByColumnAndRow(2, $row)->getValue()); 
                $prenom = $conn->real_escape_string($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                $etab = $conn->real_escape_string($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                $formation = $conn->real_escape_string($worksheet->getCellByColumnAndRow(5, $row)->getValue());
                $promo = $conn->real_escape_string($worksheet->getCellByColumnAndRow(6, $row)->getValue()); 
                $seance = $conn->real_escape_string($worksheet->getCellByColumnAndRow(7, $row)->getValue());
                $type = $conn->real_escape_string($worksheet->getCellByColumnAndRow(8, $row)->getValue());
                $debut = date('m/d/Y H:i:s', ExcelDateToUnix($conn->real_escape_string($worksheet->getCellByColumnAndRow(9, $row)->getValue())));
                $fin = date('m/d/Y H:i:s', ExcelDateToUnix($conn->real_escape_string($worksheet->getCellByColumnAndRow(10, $row)->getValue()))); 
                $duree = $conn->real_escape_string($worksheet->getCellByColumnAndRow(11, $row)->getValue());
                $date = date('Y-m-d', ExcelDateToUnix($conn->real_escape_string($worksheet->getCellByColumnAndRow(12, $row)->getValue())));
                $heure_pointage =  date('h:i:s A', ExcelDateToUnix($conn->real_escape_string($worksheet->getCellByColumnAndRow(13, $row)->getValue())));
                $categorie = $conn->real_escape_string($worksheet->getCellByColumnAndRow(14, $row)->getValue()); 
                $enseig = $conn->real_escape_string($worksheet->getCellByColumnAndRow(15, $row)->getValue());
                $cat_fusionee = $conn->real_escape_string($worksheet->getCellByColumnAndRow(16, $row)->getValue());
        
            $sql .= "('$id_admission','$nom','$prenom','$etab','$formation','$promo','$seance','$type','$debut','$fin','$duree','$date','$heure_pointage','$categorie','$enseig','$cat_fusionee'),";
        }
        $sql = rtrim($sql, ","); //Remove the last one,
        try {
            $conn->query($sql);
            $_SESSION['message'] = 'Student has been saved!';
            header('location: ../pages/dashboard.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }else{
        $_SESSION['error'] = 'File not supported!';
        header('location: ../pages/dashboard.php');
    }
}
function ExcelDateToUnix($dateValue = 0) {         
    return ($dateValue - 25569) * 86400;     
}
?>