<?php 
    include '../server/server.php';
    require_once ('../vendor/autoload.php');

    use \PhpOffice\PhpSpreadsheet\Spreadsheet;
    use \PhpOffice\PhpSpreadsheet\Reader\Xlsx;

    $error  = array();
    if (isset($_POST["import"])) {

        $allowedFileType = [
            'application/vnd.ms-excel',
            'text/xls',
            'text/xlsx',
            "application/octet-stream" ,
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        if (in_array($_FILES["file"]["type"], $allowedFileType)) {
            // change img name
            $newimg = date('dmYHis').str_replace(" ", "", $_FILES['file']['name']);
            $targetPath = '../uploads/'.basename($newimg);
            move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

            $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

            $spreadSheet = $Reader->load($targetPath);
            $excelSheet = $spreadSheet->getActiveSheet();
            $spreadSheetAry = $excelSheet->toArray();
            $sheetCount = count($spreadSheetAry);
            $row=1;
            for ($i = 0; $i <= $sheetCount-1; $i++) {

                if (!empty($spreadSheetAry[$i][0])) {
                    $id_admission = $conn->real_escape_string($spreadSheetAry[$i][0]);
                }
                if (!empty($spreadSheetAry[$i][1])) {
                    $nom = $conn->real_escape_string($spreadSheetAry[$i][1]);
                }
                if (!empty($spreadSheetAry[$i][2])) {
                    $prenom = $conn->real_escape_string($spreadSheetAry[$i][2]);
                }
                if (!empty($spreadSheetAry[$i][3])) {
                    $etab = $conn->real_escape_string($spreadSheetAry[$i][3]);
                }
                if (!empty($spreadSheetAry[$i][4])) {
                    $formation = $conn->real_escape_string($spreadSheetAry[$i][4]);
                }
                if (!empty($spreadSheetAry[$i][5])) {
                    $promo = $conn->real_escape_string($spreadSheetAry[$i][5]);
                }
                if (!empty($spreadSheetAry[$i][6])) {
                    $seance = $conn->real_escape_string($spreadSheetAry[$i][6]);
                }
                if (!empty($spreadSheetAry[$i][7])) {
                    $type = $conn->real_escape_string($spreadSheetAry[$i][7]);
                }
                if (!empty($spreadSheetAry[$i][8])) {
                    $debut = $conn->real_escape_string($spreadSheetAry[$i][8]);
                }
                if (!empty($spreadSheetAry[$i][9])) {
                    $fin = $conn->real_escape_string($spreadSheetAry[$i][9]);
                }
                if (!empty($spreadSheetAry[$i][10])) {
                    $duree = $conn->real_escape_string($spreadSheetAry[$i][10]);
                }
                if (!empty($spreadSheetAry[$i][11])) {
                    $date = date('Y-m-d', strtotime($conn->real_escape_string($spreadSheetAry[$i][11])));
                }
                if (!empty($spreadSheetAry[$i][12])) {
                    $heure_pointage = $conn->real_escape_string($spreadSheetAry[$i][12]);
                }
                if (!empty($spreadSheetAry[$i][13])) {
                    $categorie = $conn->real_escape_string($spreadSheetAry[$i][13]);
                }else{
                    $categorie = '';
                }
                if (!empty($spreadSheetAry[$i][14])) {
                    $enseig = $conn->real_escape_string($spreadSheetAry[$i][14]);
                }
                if (!empty($spreadSheetAry[$i][15])) {
                    $cat_fusionee = $conn->real_escape_string($spreadSheetAry[$i][15]);
                }

                if($row==1){
                    $row++;
                    continue;

                }else{
                    $insert = "INSERT INTO students (id_admission, nom, prenom, etab, formation, promo, seance, `type`, debut, fin, duree, `date`, heure_pointage, categorie, enseig, cat_fusionee) 
                                VALUES ('$id_admission','$nom','$prenom','$etab','$formation','$promo','$seance','$type','$debut','$fin','$duree','$date','$heure_pointage','$categorie','$enseig','$cat_fusionee')";	
                    $conn->query($insert);
                    $row++;
                }
                $_SESSION['message'] = 'Student has been saved!';
                header('location: ../pages/dashboard.php');
            }
        }else{
            $_SESSION['error'] = 'File not supported!';
            header('location: ../pages/dashboard.php');
        }
        $_SESSION['errors'] = $error;
        header('location: ../pages/dashboard.php');
    }
    header('location: ../pages/dashboard.php');
    $conn->close();
?>