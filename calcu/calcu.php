<?php 
    include '../server/server.php';
    include '../model/check_auth.php';
    include '../model/calculate.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/header.php'; ?>
        <title>Calculation · REPORT</title>
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
                            <h1 class="m-0 text-dark">Calculation</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Calculation</li>
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
                            <h3 class="card-title">Calculation</h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="w-75" align="left">
                                    <form class="d-flex flex-row" action="" method="post">
                                        <label class="w-25 mt-1 text-center">Select By:</label>
                                        <div class="w-25 mr-2">
                                            <!-- <input type="radio" id="all" name="etab" value="all">
                                            <label for="all">All</label><br> -->
                                            <?php 
                                                $sql = "SELECT DISTINCT etab FROM students";
                                                $result = $conn->query($sql);
                                                foreach($result as $row){
                                                    echo "<input type='radio' name='etab' id='etab".$row['etab']."' value='".$row['etab']."'> <label for='etab".$row['etab']."'>".$row['etab']."</label><br>";
                                                }
                                            ?> 
                                        </div>
                                        <div class="w-25 mr-2">
                                            <!-- <input type="radio" id="alltype" name="type" value="all">
                                            <label for="alltype">All</label><br> -->
                                            <?php 
                                                 $sql = "SELECT DISTINCT `type` FROM students";
                                                $result = $conn->query($sql);
                                                foreach($result as $row){
                                                    echo "<input type='radio' name='type' id='type".$row['type']."' value='".$row['type']."'> <label for='type".$row['type']."'>".$row['type']."</label><br>";
                                                }
                                            ?> 
                                        </div>
                                        <div class="w-25 mr-2">
                                            <input type="radio" id="promo1" name="promo" value="1">
                                            <label for="promo1">Promo: 1</label><br>
                                            <input type="radio" id="promo2" name="promo" value="2">
                                            <label for="promo2">Promo: 2</label><br>
                                            <input type="radio" id="promo3" name="promo" value="3">
                                            <label for="promo3">Promo: 3</label><br>
                                            <input type="radio" id="promo4" name="promo" value="4">
                                            <label for="promo4">Promo: 4</label><br>
                                            
                                        </div>
                                        <!-- <select class="custom-select w-25 mr-2" name="etab" required>
                                            <option disabled selected value="">Select an Etab</option>
                                            <option value="all">All</option>
                                            
                                        </select> -->
                                        <!-- <select class="custom-select w-25 mr-2" name="type" required>
                                            <option disabled selected value="">Select a Type</option>
                                            <option value="all">All</option>
               
                                        </select> -->
                                        <!-- <input type='number' class="form-control w-25 mr-2" name="promo" placeholder="Enter promo number"> -->
                                        <input type='text' class="form-control w-25 mr-2" id="fromDate" name="fromDate" placeholder="from Date" required>
                                        <input type='text' class="form-control w-25 mr-2" id="toDate" name="toDate" placeholder="to Date" required>
                                        <div class="mt-1 w-25">
                                            <button type="submit" class="btn btn-success btn-sm" name="search">Calculate</button>
                                            <button class="btn btn-sm btn-primary" align="left" data-toggle='modal' data-target="#addHistory">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php if(isset($_POST['search'])): ?>
                            <div class="">
                                <label>Your Select:</label>
                                <div class="d-flex">
                                    <p class="mr-2">Etab: <?= !empty($_POST['etab']) ? $_POST['etab'] : null ?></p>
                                    <p class="mr-2">Type: <?= !empty($_POST['type']) ? $_POST['type'] : null ?></p>
                                    <p class="mr-2">Promo: <?= !empty($_POST['promo']) ? $_POST['promo'] : null ?></p>
                                    <p class="mr-2">From: <?= !empty($_POST['fromDate']) ? $_POST['fromDate'] : null ?></p>
                                    <p class="mr-2">Date: <?= !empty($_POST['toDate']) ? $_POST['toDate'] : null ?></p>
                                </div>
                            </div>
                            <?php endif ?>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered" id="calc_Table">
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
                                        <?php if(!empty($student)): ?>
                                            <?php foreach($student as $row):?>
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
                                            <?php endforeach ?>
                                        <?php else: ?>
                                            <tr>
                                                <td class="text-center" colspan="15">No data to be shown...</td>
                                            </tr>
                                        <?php endif ?>
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
        <div class="modal fade" id="addHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Save Calculation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="student_form" action="../model/addhistory.php">
                <div class="modal-body">
                    <p>Please enter the info you want to save the report</p>
                        <div class="form-group">
                            <label for="inputText">Periode</label>
                            <input type="text" class="form-control" name="periode" placeholder="Enter periode" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputText">Nature</label>
                                <input type="text" class="form-control" name="nature" placeholder="Enter a nature" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputText">Etab</label>
                                <input type="text" class="form-control" name="etab" placeholder="Enter a etab" required value="<?= !empty($_POST['etab']) ? $_POST['etab'] : null ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputText">Promotion</label>
                                <input type="text" class="form-control" name="promo" placeholder="Enter a etab" required value="<?= !empty($_POST['promo']) ? $_POST['promo'] : null ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputText">Year</label>
                                <input type="text" class="form-control" name="year" placeholder="Enter a etab" required value="2020/2021">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputText">Intervalle</label>
                                <input type="text" class="form-control" name="intervalle" placeholder="Enter an Intervalle" required 
                                value="<?= !empty($_POST['fromDate']) ? $_POST['fromDate'].' - '.$_POST['toDate'] : null ?>">
                            </div>
                        </div>
                    <div class="modal-footer">
                        <input type="hidden" value="<?= htmlentities(serialize($student)); ?>" name="data">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" name="addHistory">Submit</button>
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