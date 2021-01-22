<?php 
    include '../server/server.php';
    include '../model/check_auth.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/header.php'; ?>
        <title>History · Report</title>
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
                            <h1 class="m-0 text-dark">History</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">History</li>
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
                            <h3 class="card-title">History</h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="w-75 d-flex flex-row" align="left">
                                        <label class="w-25 mt-1">Search By:</label>
                                        <input type='text' class="form-control w-25 mr-2" id="periode" placeholder="Enter periode">
                                        <input type='text' class="form-control w-25 mr-2" id="nature" placeholder="Enter nature">
                                        <input type='text' class="form-control w-25 mr-2" id="etab" placeholder="Enter etab">
                                        <input type='text' class="form-control w-25 mr-2" id="promo" placeholder="Enter promo">
                                        <input type='text' class="form-control w-25 mr-2" id="year" placeholder="Enter year">
                                        <input type='text' class="form-control w-25 mr-2" id="intervalle" placeholder="Enter intervalle">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered" id="historyTable">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Periode</th>
                                            <th>Nature</th>
                                            <th>Etab</th>
                                            <th>Promo</th>
                                            <th>Year</th>
                                            <th>Intervalle</th>
                                            <th>Action</th>
                                            <th>Print</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = "SELECT * FROM history";
                                        $select = $conn->query($sql);
                                        while($row = $select->fetch_assoc()){    
                                            echo '<tr><td>'.$row['user'].'</td>';
                                            echo '<td>'.$row['periode'].'</td>';
                                            echo '<td>'.$row['nature'].'</td>';
                                            echo '<td>'.$row['etab'].'</td>';
                                            echo '<td class="text-center">'.$row['promo'].'</td>';
                                            echo '<td>'.$row['year'].'</td>';
                                            echo '<td>'.$row['intervalle'].'</td>';
                                            echo '<td><a href="select_history.php?id='.$row['id'].'" class="btn btn-link edit_jobs text-primary">View</a> </td>';
                                            echo '<td><a href="../uploads/'.$row['pdf'].'" target="_blank" class="btn btn-link edit_jobs text-success">PDF</a> or <a href="../uploads/'.$row['excel'].'" target="_blank" class="btn btn-link remove_jobs text-danger">Excel</a> Download</td></tr>';
                                        }
                                    ?>
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