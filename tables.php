<?php

	session_start();

	require_once "pdo.php";

	$patients = $pdo->query("SELECT * FROM patients");

	if ( isset($_POST['clear']) )
	{
		$patients = $pdo->prepare("
			SELECT * FROM patients
		");
		$patients->execute();
	}

	elseif (isset($_POST['fid']) || isset($_POST['ffn']) || isset($_POST['fln']) || isset($_POST['fstat']) ||
			isset($_POST['sorb']) || isset($_POST['sor']))
	{
		$fid = htmlentities($_POST['fid']);
		$ffn = htmlentities($_POST['ffn']);
		$fln = htmlentities($_POST['fln']);
		$fstat = htmlentities($_POST['fstat']);
		$sorb = htmlentities($_POST['sorb']);
		$sor = htmlentities($_POST['sor']);

		if (strlen($_POST['fid']) > 0 || strlen($_POST['ffn']) > 0 || strlen($_POST['fln']) > 0 || strlen($_POST['fstat']) > 0)
		{
			echo $fid;

			$patients = $pdo->prepare("
				SELECT * FROM patients
				WHERE  UserIdP = :fid or FName = :ffn or LName = :fln or status = :fstat
				ORDER BY :sorb :sor
			");


			$patients->execute([
				':fid' => $fid,
				':ffn' => $ffn,
				':fln' => $fln,
				':fstat' => $fstat,
				':sorb' => $sorb,
				':sor' => $sor,
			]);
		}

		else
		{
			$patients = $pdo->prepare("
				SELECT * FROM patients
				ORDER BY :sorb :sor
			");

			$patients->execute([
				':sorb' => $sorb,
				':sor' => $sor,
			]);
		}
	}


	while ( $row = $patients->fetch(PDO::FETCH_OBJ) )
	{
		$pats[] = $row;
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Dashboard</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>STATISTICS</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="add_patient.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">

                    <span>Add patient</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="tables.php" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-chevron-right"></i>
                    <span>Patients Details</span>
                </a>
            </li>

			<li class="nav-item">
                <a class="nav-link collapsed" href="modify_details.php" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-chevron-right"></i>
                    <span>Modify Details of Patient</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading
            <div class="sidebar-heading">
                Addons
            </div>-->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="discharge.php" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">

                    <span>Discharge</span>
                </a>

            </li>

            <!-- Nav Item - Charts
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>-->

            <!-- Nav Item - Tables
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-table"></i>
                    <span>Tables</span></a>
            </li>-->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">



            <!-- Sidebar Message -->
            <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="">
                <a class="btn btn-success btn-sm" href="logout.php">logout</a>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->

                            </a>
                            <!-- Dropdown - Alerts -->

                        </li>

                        <!-- Nav Item - Messages -->

                        <div class="topbar-divider d-none d-sm-block"></div>



                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->


					<!--Filter section-->
					<div class="card shadow mb-4">
                        <div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Filter</h6>
                        </div>
                        <div class="card-body">
							<form method="post">
								<style>
									table {
										border-collapse: collapse;
										width: 100%;
									}

									th {
										padding: 8px;
										text-align: center;
									}

									td {
										text-align: center;
									}
								</style>
								<table>
									<tr>
										<th>Patient ID</th>
										<th>Patient's First Name</th>
										<th>Patient's Last Name</th>
										<th>Status</th>
									</tr>
									<tr>
										<td><input class="form-textbox" type="text" id="fid" name="fid" placeholder="Enter ID"></td>
										<td><input class="form-textbox" type="text" id="ffn" name="ffn" placeholder="Enter First Name"></td>
										<td><input class="form-textbox" type="text" id="fln" name="fln" placeholder="Enter Last Name"></td>
										<td>
											<select class="form-dropdown" id="fstat" name="fstat">
												<option value=""> Please Select </option>
												<option value="active"> Active </option>
												<option value="recovered"> Recovered </option>
												<option value="deceased"> Deceased </option>
											</select>
										</td>
									</tr>
									<tr>
										<th></th>
										<th>Sort By</th>
										<th>Sort</th>
										<th></th>
									</tr>
									<tr>
										<td></td>
										<td>
											<select class="form-dropdown" id="sorb" name="sorb">
												<option value="UserIdP"> ID </option>
												<option value="FName"> First Name </option>
												<option value="LName"> Last Name </option>
											</select>
										</td>
										<td>
											<select class="form-dropdown" id="sor" name="sor">
												<option value="ASC"> Ascending </option>
												<option value="DESC"> Descending </option>
											</select>
										</td>
										<td></td>
									</tr>
								</table>
								<br/><br/>
								<style>
									.center {
										text-align: center;
									}
								</style>
								<div class="center">
									<input type="submit" value="Filter">
									<input type="submit" name="clear" value="Clear">
								</div>
							</form>

                        </div>
					</div>

					<?php if (empty($pats)) : ?>
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									No Rows Found
								</div>
							</div>
						</div>
					<?php else : ?>
                    <!-- Content Row -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Adhar No</th>
                                            <th>Address </th>
                                            <th>Age</th>
                                            <th>Symptoms</th>
                                            <th>Health Insurance</th>
                                            <th>Covid Report</th>
                                        </tr>
                                    </thead>
									<tbody>
										<?php foreach($pats as $pat) : ?>
											<tr>
												<td>
												<?php
													echo $pat->FName;
													echo " ";
													echo $pat->LName;
												?>
												</td>
												<td><?php echo $pat->Aadhar?></td>
												<td>
												<?php
													echo $pat->Address1;
													echo "<br>";
													echo $pat->Address2;
													echo "<br>";
													echo $pat->City;
													echo "<br>";
													echo $pat->State;
													echo "<br>";
													echo $pat->ZipCode;
												?>
												</td>
												<td><?php echo $pat->age?></td>
												<td><?php echo $pat->Symptoms?></td>
												<td><?php echo $pat->Insuarance?></td>
												<td>
												<?php
													echo $pat->Attachment1;
													echo "<br>";
													echo $pat->Attachment2;
												?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
                                </table>
                            </div>
                        </div>
                    </div>


			<?php endif; ?>

                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
