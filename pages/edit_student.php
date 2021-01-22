<?php 
    include '../server/server.php';
    include '../model/check_auth.php';
    $id = $_GET['id'];
    $student = "SELECT * FROM students WHERE id='$id'";
    $res = $conn->query($student);
    $student = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/header.php'; ?>
        <title>Edit Student · Report</title>
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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Student</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                                <li class="breadcrumb-item active">Student</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Student</h3>
                        </div><!-- /.card-header -->
                        <form method="POST" id="student_form" action="../model/update_student.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputText">ID Admission</label>
                                <input type="text" class="form-control id_admission" name="id_admission" placeholder="Enter id addmission" readonly value="<?= $student['id_admission'] ?>">
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="inputText">Nom</label>
                                    <input type="text" class="form-control nom" name="nom" placeholder="Enter a nom" required value="<?= $student['nom'] ?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputText">Prenom</label>
                                    <input type="text" class="form-control prenom" name="prenom" placeholder="Enter a prenom" required value="<?= $student['prenom'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <label for="inputText">Etab</label>
                                    <input type="text" class="form-control etab" name="etab" placeholder="Enter an etab" required value="<?= $student['etab'] ?>">
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="inputText">Formation</label>
                                    <input type="text" class="form-control formation" name="formation" placeholder="Enter a formation" required value="<?= $student['formation'] ?>">
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="inputText">Promo</label>
                                    <input type="text" class="form-control promo" name="promo" placeholder="Enter a promo" required value="<?= $student['promo'] ?>">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Seance</label>
                                    <input type="text" class="form-control seance" name="seance" placeholder="Enter a seance" required value="<?= $student['seance'] ?>">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Type</label>
                                    <input type="text" class="form-control type" name="type" placeholder="Enter a type" required value="<?= $student['type'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Debut</label>
                                    <input type="text" class="form-control debut" name="debut" placeholder="Enter a debut" required value="<?= $student['debut'] ?>">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Fin</label>
                                    <input type="text" class="form-control fin" name="fin" placeholder="Enter a fin" required value="<?= $student['fin'] ?>">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Duree</label>
                                    <input type="text" class="form-control duree" name="duree" placeholder="Enter a duree" required value="<?= $student['duree'] ?>">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Date</label>
                                    <input type="text" class="form-control date" name="date" placeholder="Enter a date" required value="<?= $student['date'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Heure Pointage</label>
                                    <input type="text" class="form-control heure_pointage" name="heure_pointage" placeholder="Enter a heure pointage" required value="<?= $student['heure_pointage'] ?>">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="inputText">category</label>
                                    <input type="text" class="form-control categorie" name="categorie" placeholder="Enter a categorie" required value="<?= $student['categorie'] ?>">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Enseig</label>
                                    <input type="text" class="form-control enseig" name="enseig" placeholder="Enter an enseig" required value="<?= $student['enseig'] ?>">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Cat fusionee</label>
                                    <input type="text" class="form-control cat_fusionee" name="cat_fusionee" placeholder="Enter an Cat fusionee" required value="<?= $student['cat_fusionee'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                        </form>
                        </div>         
                    </div>
                    <!-- /.row -->
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- Main Footer -->
        <?php include '../templates/footer.php'; ?>
    </div>
    <!-- ./wrapper -->
    <?php include '../templates/footer-links.php'; ?>
    </body>
</html>