<?php 
    include '../server/server.php';
    include '../model/check_auth.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/header.php'; ?>
        <title>History Calculation · Report</title>
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
            #historyTable tfoot th #tfoo0,#historyTable tfoot th #tfoo6,#historyTable tfoot th #tfoo7{
                display:none;
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
                            <h1 class="m-0 text-dark">History Calculation</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">History Calculation</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">History Calculation</h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered" id="historyTable">
                                    <thead>
                                        <tr>
                                            <th>ID Admission</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Etablissement</th>
                                            <th>Formation</th>
                                            <th>Promotion</th>
                                            <th>A</th>
                                            <th>B</th>
                                            <th>C</th>
                                            <th>D</th>
                                            <th>Z</th>
                                            <th>VHR</th>
                                            <th>VHA</th>
                                            <th>%</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $id = $_GET['id'];
                                        $sql = "SELECT * FROM calculation WHERE history_id=$id";
                                        $select = $conn->query($sql); ?>  
                                            <?php  while($row = $select->fetch_assoc()):?>
                                                <tr>
                                                    <td><?= $row['id_admission'] ?></td>
                                                    <td><?= $row['nom'] ?></td>
                                                    <td><?= $row['prenom'] ?></td>
                                                    <td><?= $row['etab'] ?></td>
                                                    <td><?= $row['formation'] ?></td>
                                                    <td><?= $row['promo'] ?></td>
                                                    <td><?= $row['a'] ?></td>
                                                    <td><?= $row['b'] ?></td>
                                                    <td><?= $row['c'] ?></td>
                                                    <td><?= $row['d'] ?></td>
                                                    <td><?= $row['z'] ?></td>
                                                    <td><?= $row['vhr'] ?></td>
                                                    <td><?= $row['vha'] ?></td>
                                                    <td><?= $row['percent'] ?></td>
                                                    <td><?= $row['notes'] ?></td>
                                                </tr>
                                            <?php endwhile ?>
                                    </tbody>
                                    </tfoot>
                                </table>
                            </div>
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
    <script src="../assets/scripts/history.js"></script>
    </body>
</html>