<?php 
    include '../server/server.php';
    include '../model/check_auth.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/header.php'; ?>
        <title>Dashboard · Reports</title>
        <style>
        .error li{
            list-style: none;
            width: 100%;
            text-align: left;
        }
        ul.error{
            padding-left: 0;
            margin-bottom: 0;
        }
    </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" >
        <div class="wrapper">
        <!-- Navbar -->
            <!-- Main Topbar Container -->
            <?php include '../templates/topnavbar.php'; ?>
            <!-- Main Sidebar Container -->
            <?php include '../templates/sidenavbar.php'; ?>
            <!-- /sidebar -->
        <!-- /navbar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['message']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['message']); ?>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['error']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['error']); ?>
                <?php if(!empty($_SESSION['errors'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php foreach($_SESSION['errors'] as $error): ?>
                            <ul class="error">
                                <li><?= 'This ID: '.$error.' is duplicate!' ?></li>
                            </ul>
                        <?php endforeach ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['errors']); ?>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <?php if($_SESSION['user_type'] == 'Admin') { ?>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><a href="javascript:void(0)">Total Students</a></span>
                                    <span class="info-box-number">
                                    <?php 
                                    $sql = "SELECT * FROM students GROUP BY id_admission";
                                    $result = $conn->query($sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                    </span>
                                </div>
                            <!-- /.info-box-content -->
                            </div>
                        <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-globe"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><a class="text-danger" href="javascript:void(0)">Total History</a></span>
                                    <span class="info-box-number">
                                    <?php 
                                    $sql = "SELECT * FROM history";
                                    $result = $conn->query($sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-tie text-light"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><a class="text-warning" href="javascript:void(0)">Total Admin User</a></span>
                                    <span class="info-box-number">
                                    <?php 
                                    $sql = "SELECT * FROM user WHERE user_type='Admin'";
                                    $result = $conn->query($sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                    </span>
                                </div>
                                  <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><a class="text-success" href="javascript:void(0)">Total Staff User</a></span>
                                    <span class="info-box-number">
                                    <?php 
                                    $sql = "SELECT * FROM user WHERE user_type='Staff';";
                                    $result = $conn->query($sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                    </span>
                                </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                      <!-- /.col -->
                    </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Students</h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <button class="btn btn-sm btn-primary" data-toggle='modal' data-target="#addStudent"><i class="fas fa-plus"></i> Student</button>
                                <?php if($_SESSION['user_type'] == 'Admin') { ?>
                                    <div class="w-100 col-md-8" align="right">
                                        <form action="../model/import_excel.php" method="post" name="frmExcelImport" enctype="multipart/form-data">
                                            <input type="file" name="file" id="file" accept=".xls,.xlsx,.csv" required>
                                            <button type="submit" name="import" class="btn btn-success btn-sm"><i class="fas fa-file-excel mr-1"></i>Import Excel</button>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered" id="studentTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Etab</th>
                                            <th>Formation</th>
                                            <th>Promo</th>
                                            <th>Seance</th>
                                            <th>Type</th>
                                            <th>Debut</th>
                                            <th>Fin</th>
                                            <th>Duree</th>
                                            <th>Date</th>
                                            <th>Heure Pointage</th>
                                            <th>Categorie</th>
                                            <th>Enseig</th>
                                            <th>Cat Fusionee</th>
                                            <?php if($_SESSION['user_type'] == 'Admin') { ?>
                                            <th>Action</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = "SELECT * FROM students";
                                        $select = $conn->query($sql);
                                        while($row = $select->fetch_assoc()){    
                                            echo '<tr><td>'.$row['id_admission'].'</td>';
                                            echo '<td>'.$row['nom'].'</td>';
                                            echo '<td>'.$row['prenom'].'</td>';
                                            echo '<td>'.$row['etab'].'</td>';
                                            echo '<td>'.$row['formation'].'</td>';
                                            echo '<td>'.$row['promo'].'</td>';
                                            echo '<td>'.$row['seance'].'</td>';
                                            echo '<td>'.$row['type'].'</td>';
                                            echo '<td>'.$row['debut'].'</td>';
                                            echo '<td>'.$row['fin'].'</td>';
                                            echo '<td>'.$row['duree'].'</td>';
                                            echo '<td>'.$row['date'].'</td>';
                                            echo '<td>'.$row['heure_pointage'].'</td>';
                                            echo '<td>'.$row['categorie'].'</td>';
                                            echo '<td>'.$row['enseig'].'</td>';
                                            echo '<td>'.$row['cat_fusionee'].'</td>';
                                            if($_SESSION['user_type'] == 'Admin') { 
                                                echo '<td>
                                                <a href="edit_student.php?id='.$row['id'].'" class="btn btn-link edit_jobs text-success" id="'.$row['id'].'"><i class="fa fa-pencil-alt"></i></a> 
                                                <a href="../model/remove_student.php?id='.$row['id'].'" class="btn btn-link remove_jobs text-danger"><i class="fa fa-trash"></i></a>
                                                </td>';
                                            }
                                            echo '</tr>';
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>         
                    </div>
                    <!-- /.row -->
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="student_form" action="../model/add_student.php">
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="inputText">ID Admission</label>
                            <input type="text" class="form-control id_admission" name="id_admission" placeholder="Enter id addmission" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="inputText">Nom</label>
                                <input type="text" class="form-control nom" name="nom" placeholder="Enter a nom" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="inputText">Prenom</label>
                                <input type="text" class="form-control prenom" name="prenom" placeholder="Enter a prenom" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="inputText">Etab</label>
                                <input type="text" class="form-control etab" name="etab" placeholder="Enter an etab" required>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="inputText">Formation</label>
                                <input type="text" class="form-control formation" name="formation" placeholder="Enter a formation" required>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="inputText">Promo</label>
                                <input type="text" class="form-control promo" name="promo" placeholder="Enter a promo" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputText">Seance</label>
                                <input type="text" class="form-control seance" name="seance" placeholder="Enter a seance" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputText">Type</label>
                                <input type="text" class="form-control type" name="type" placeholder="Enter a type" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="inputText">Debut</label>
                                <input type="text" class="form-control debut" name="debut" placeholder="Enter a debut" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputText">Fin</label>
                                <input type="text" class="form-control fin" name="fin" placeholder="Enter a fin" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputText">Duree</label>
                                <input type="text" class="form-control duree" name="duree" placeholder="Enter a duree" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputText">Date</label>
                                <input type="text" class="form-control date" name="date" placeholder="Enter a date(mm/dd/yyyy)" required autcomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="inputText">Heure Pointage</label>
                                <input type="text" class="form-control heure_pointage" name="heure_pointage" placeholder="Enter a heure pointage" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputText">category</label>
                                <input type="text" class="form-control categorie" name="categorie" placeholder="Enter a categorie" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputText">Enseig</label>
                                <input type="text" class="form-control enseig" name="enseig" placeholder="Enter an enseig" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputText">Cat fusionee</label>
                                <input type="text" class="form-control cat_fusionee" name="cat_fusionee" placeholder="Enter an Cat fusionee" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- Main Footer -->
        <?php include '../templates/footer.php'; ?>
    </div>
    <!-- ./wrapper -->
    <?php include '../templates/footer-links.php'; ?>
    
    </body>
</html>