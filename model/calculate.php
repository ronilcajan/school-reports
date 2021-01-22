<?php
     $student = array();

     if(isset($_POST['search'])){

        $etab = $conn->real_escape_string($_POST['etab']);
        $type = $conn->real_escape_string($_POST['type']);
        $fromDate = $conn->real_escape_string($_POST['fromDate']);
        $toDate = $conn->real_escape_string($_POST['toDate']);
        $promo = $conn->real_escape_string($_POST['promo']);

        if($etab == 'all' && $type == 'all' && empty($promo)){
            $select = "SELECT id_admission,nom,prenom,etab,formation,promo,
                            SUM(CASE WHEN cat_fusionee='A' THEN duree ELSE 0 END) a, 
                            SUM(CASE WHEN cat_fusionee='B' THEN duree ELSE 0 END) b, 
                            SUM(CASE WHEN cat_fusionee='C' THEN duree ELSE 0 END) c, 
                            SUM(CASE WHEN cat_fusionee='D' THEN duree ELSE 0 END) d, 
                            SUM(CASE WHEN cat_fusionee='Z' THEN duree ELSE 0 END) z 
                            FROM students 
                            WHERE `date` BETWEEN '$fromDate' AND '$toDate' 
                            GROUP BY id_admission" ;

        }elseif($etab != 'all' && $type == 'all' && empty($promo)){
            $select = "SELECT id_admission,nom,prenom,etab,formation,promo,
                            SUM(CASE WHEN cat_fusionee='A' THEN duree ELSE 0 END) a, 
                            SUM(CASE WHEN cat_fusionee='B' THEN duree ELSE 0 END) b, 
                            SUM(CASE WHEN cat_fusionee='C' THEN duree ELSE 0 END) c, 
                            SUM(CASE WHEN cat_fusionee='D' THEN duree ELSE 0 END) d, 
                            SUM(CASE WHEN cat_fusionee='Z' THEN duree ELSE 0 END) z 
                            FROM students 
                            WHERE etab LIKE '%$etab%' AND `date` BETWEEN '$fromDate' AND '$toDate' 
                            GROUP BY id_admission" ;

        }elseif($etab == 'all' && $type != 'all' && empty($promo)){
            $select = "SELECT id_admission,nom,prenom,etab,formation,promo,
                            SUM(CASE WHEN cat_fusionee='A' THEN duree ELSE 0 END) a, 
                            SUM(CASE WHEN cat_fusionee='B' THEN duree ELSE 0 END) b, 
                            SUM(CASE WHEN cat_fusionee='C' THEN duree ELSE 0 END) c, 
                            SUM(CASE WHEN cat_fusionee='D' THEN duree ELSE 0 END) d, 
                            SUM(CASE WHEN cat_fusionee='Z' THEN duree ELSE 0 END) z 
                            FROM students 
                            WHERE type LIKE '%$type%' AND `date` BETWEEN '$fromDate' AND '$toDate' 
                            GROUP BY id_admission" ;
        
        }elseif($etab != 'all' && $type == 'all' && $promo){
            $select = "SELECT id_admission,nom,prenom,etab,formation,promo,
                            SUM(CASE WHEN cat_fusionee='A' THEN duree ELSE 0 END) a, 
                            SUM(CASE WHEN cat_fusionee='B' THEN duree ELSE 0 END) b, 
                            SUM(CASE WHEN cat_fusionee='C' THEN duree ELSE 0 END) c, 
                            SUM(CASE WHEN cat_fusionee='D' THEN duree ELSE 0 END) d, 
                            SUM(CASE WHEN cat_fusionee='Z' THEN duree ELSE 0 END) z 
                            FROM students 
                            WHERE etab LIKE '%$etab%' AND promo LIKE '%$promo%' AND `date` BETWEEN '$fromDate' AND '$toDate' 
                            GROUP BY id_admission" ;

        }elseif($etab == 'all' && $type != 'all' && empty($promo)){
            $select = "SELECT id_admission,nom,prenom,etab,formation,promo,
                            SUM(CASE WHEN cat_fusionee='A' THEN duree ELSE 0 END) a, 
                            SUM(CASE WHEN cat_fusionee='B' THEN duree ELSE 0 END) b, 
                            SUM(CASE WHEN cat_fusionee='C' THEN duree ELSE 0 END) c, 
                            SUM(CASE WHEN cat_fusionee='D' THEN duree ELSE 0 END) d, 
                            SUM(CASE WHEN cat_fusionee='Z' THEN duree ELSE 0 END) z 
                            FROM students 
                            WHERE type LIKE '%$type%' AND promo LIKE '%$promo%' AND `date` BETWEEN '$fromDate' AND '$toDate' 
                            GROUP BY id_admission" ;                   

        }else{
            $select = "SELECT id_admission,nom,prenom,etab,formation,promo,
                            SUM(CASE WHEN cat_fusionee='A' THEN duree ELSE 0 END) a, 
                            SUM(CASE WHEN cat_fusionee='B' THEN duree ELSE 0 END) b, 
                            SUM(CASE WHEN cat_fusionee='C' THEN duree ELSE 0 END) c, 
                            SUM(CASE WHEN cat_fusionee='D' THEN duree ELSE 0 END) d, 
                            SUM(CASE WHEN cat_fusionee='Z' THEN duree ELSE 0 END) z 
                            FROM students 
                            WHERE etab LIKE '%$etab%' AND promo LIKE '%$promo%' AND type LIKE '%$type%' AND `date` BETWEEN '$fromDate' AND '$toDate' 
                            GROUP BY id_admission" ;
        }
    
        $result 	= $conn->query($select);

        $vhr=0;
        $vha=0;
        $percent=0;

        foreach($result as $row){
            $vhr = $row['a'] + $row['b'] + $row['c'] + $row['d'] + $row['z'];
            $vha = $row['c'] +  $row['d'];
            $percent = ($vha/$vhr) * 100;
            $notes = getNotes($percent);

            array_push($student, 
                        array(
                            'id_admission' => $row['id_admission'],
                            'nom' => $row['nom'],
                            'prenom' => $row['prenom'],
                            'etab' => $row['etab'],
                            'formation' => $row['formation'],
                            'promo' => $row['promo'],
                            'a' => $row['a'],
                            'b' => $row['b'],
                            'c' => $row['c'],
                            'd' => $row['d'],
                            'z' => $row['z'],
                            'vhr' => $vhr,
                            'vha' => $vha,
                            'percent' => (int)$percent,
                            'notes' => $notes
                        )
                    );
        }
    }

        function getNotes($percent){
            include '../server/server.php';
            $select_notes = "SELECT * FROM notes" ;
            $notes 	= $conn->query($select_notes);
            $note = 0;

            foreach($notes as $row){
                if($row['percent_a'] <= $percent && $percent < $row['percent_b']){
                    $note = $row['notes'];
                }
            }

            return $note;
        }
