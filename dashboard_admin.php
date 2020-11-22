<?php

session_start();

require_once "pdo.php";

if ( !isset($_SESSION['userid']) || strlen($_SESSION['userid']) < 1  ) {
    die('Name parameter missing');
}

if(isset($_POST['addstaff'])){
  try{
    $stmtc=$pdo->prepare('INSERT INTO hosplog(UserId,Pass) VALUES (:ui,:pass)');
    $stmtc->execute(array(
      ':ui'=>$_POST['field2'],
      ':pass'=>$_POST['field3']
    ));

    $stmt=$pdo->prepare('INSERT INTO staffdet(userid,name,address,adhar,education,age,doj,gender,desg) VALUES (:uid,:name,:addr,:adhar,:edu,:age,:doj,:gend,:des)');
    $stmt->execute(array(
      ':uid'=>$_POST['field2'],
      ':name'=>$_POST['field1'],
      ':addr'=>$_POST['field4'],
      ':adhar'=>$_POST['field5'],
      ':edu'=>$_POST['field6'],
      ':age'=>(int)$_POST['field7'],
      ':doj'=>$_POST['begin'],
      ':gend'=>$_POST['field8'],
      ':des'=>$_POST['field9']
    ));
    $_SESSION['success']="Staff added";
  	header('Location: dashboard_admin.php');
  	return;
  }
  catch(Exception $e){
    $_SESSION['success']="staff not added";
    header('Location: dashboard_admin.php');
    return;
  }
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
                <a class="nav-link" href="#">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Add Hospital Staff</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="delete.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">

                    <span>Delete Hospital Staff</span>
                </a>


            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="patdet.php" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-chevron-right"></i>
                    <span>patients details</span>
                </a>
                            </li>
              <li class="nav-item">
                <a class="nav-link collapsed" href="staff.php" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-chevron-right"></i>
                    <span>staff details</span>
                </a>
                            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->





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

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlentities($_SESSION['userid']);?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>

                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                  <h4 align="center" style="color:red; background:white;">
                    <?php
                      if(isset($_SESSION['success'])){
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                      }
                      ?>
                    </h4>
                    <!-- Content Row -->
                          <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                  <style type="text/css">
          .form-style-5 {
            max-width: 900px;
            padding: 20px 20px;
            background: #ecebfa;
            margin: 10px auto;
            padding: 30px;
            background: #ecebfa;
            border-radius: 8px;
            font-family: "Segoe UI";
          }

          .form-style-5 fieldset {
            border: none;
          }

          .form-style-5 legend {
            font-size: 1.4em;
            margin-bottom: 10px;
          }

          .form-style-5 label {
            display: block;
            margin-bottom: 8px;
          }

          .form-style-5 input[type="text"],
          .form-style-5 input[type="date"],
          .form-style-5 input[type="datetime"],
          .form-style-5 input[type="email"],
          .form-style-5 input[type="number"],
          .form-style-5 input[type="search"],
          .form-style-5 input[type="time"],
          .form-style-5 input[type="url"],
          .form-style-5 textarea,
          .form-style-5 select {
            font-family: "Segoe UI";
            background: #e0ccff;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            margin: 0;
            outline: 0;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            background-color: #ecebfa;
            color: #8a97a0;
            -webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.03) inset;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.03) inset;
            margin-bottom: 30px;
          }

          .form-style-5 input[type="text"]:focus,
          .form-style-5 input[type="date"]:focus,
          .form-style-5 input[type="datetime"]:focus,
          .form-style-5 input[type="email"]:focus,
          .form-style-5 input[type="number"]:focus,
          .form-style-5 input[type="search"]:focus,
          .form-style-5 input[type="time"]:focus,
          .form-style-5 input[type="url"]:focus,
          .form-style-5 textarea:focus,
          .form-style-5 select:focus {
            background: #d2d9dd;
          }

          .form-style-5 select {
            -webkit-appearance: menulist-button;
            height: 35px;
          }

          .form-style-5 .number {
            background: #5145cd;
            color: #fff;
            height: 30px;
            width: 30px;
            display: inline-block;
            font-size: 0.8em;
            margin-right: 4px;
            line-height: 30px;
            text-align: center;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.2);
            border-radius: 15px 15px 15px 0px;
          }

          .form-style-5 input[type="submit"],
          .form-style-5 input[type="button"] {
            position: relative;
            display: block;
            padding: 19px 39px 18px 39px;
            color: #FFF;
            margin: 0 auto;
            background: #5145cd;
            font-size: 18px;
            text-align: center;
            font-style: normal;
            width: 100%;
            border: 1px solid #5145cd;
            border-width: 1px 1px 3px;
            margin-bottom: 10px;
          }

          .form-style-5 input[type="submit"]:hover,
          .form-style-5 input[type="button"]:hover {
            background: #d6d6f5;
            color: black;
          }
        </style>
       <header class="text-xl font-semibold" style="Text-align:center; font-size:40px; ">Add Staff member</header>
        <div class="form-style-5" id="submit">

          <form method="post">
            <fieldset>
              <legend><span class="number">1</span> Staff Details</legend>

              <div class="dropdown">

                <input type="text" name="field1" placeholder=" Name *" required>
<input type="text" name="field2" placeholder="UserID *" required>
                <input type="text" name="field3" placeholder="Password *" required>
<input type="text" name="field4" placeholder="Address*">

                </select>

              </div>



              <legend><span class="number">2</span> Other</legend>
<input type="text" name="field5" placeholder="Adhar No*">
<input type="text" name="field6" placeholder="Education*">
<input type="text" name="field7" placeholder="Age*">
<span>JOINING DATE</span> <input type="date" name="begin"
        placeholder="dd-mm-yyyy" value=""
        min="1997-01-01" max="2030-12-31">
<select id="domain" name="field8">
                <optgroup label="Gender">
                  <option value="1">male</option>
                  <option value="2">female</option>
                  <option value="3">Other</option>

                </optgroup>
              </select>

              <select id="domain" name="field9" >
                <optgroup label="Designation">
                  <option value="1">Doctor</option>
                  <option value="2">Nurse</option>
                  <option value="3">ward boy</option>

                </optgroup>
              </select>

            <input type="submit" value="Submit" name="addstaff"/>

          </form>
                            </div>
                        </div>
                    </div>

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

    <!-- Logout Modal-->

    <script>
    window.watsonAssistantChatOptions = {
        integrationID: "0005b041-1467-4d43-93f2-3b3b9371f390", // The ID of this integration.
        region: "eu-gb", // The region your integration is hosted in.
        serviceInstanceID: "dcee2fc2-7a8e-4f2b-b059-13b16d407752", // The ID of your service instance.
        onLoad: function(instance) { instance.render(); }
      };
    setTimeout(function(){
      const t=document.createElement('script');
      t.src="https://web-chat.global.assistant.watson.appdomain.cloud/loadWatsonAssistantChat.js";
      document.head.appendChild(t);
    });
  </script>
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
