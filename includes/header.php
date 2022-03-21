<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CA | REPAIR | MANAGER</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <link rel="stylesheet" href="../css/style.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="../img/screen.png" alt="Computer Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><strong>REPAIR</strong>MANAGER</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../img/avatar_2x.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block"><?php echo "{$_SESSION['loggedInUserFullName']}"; ?></a>
        </div>
      </div>
              
               <?php
                if( $_SESSION['loggedInUser'] ) { // if user is logged in
                
                    ?>
<!--                        PARTS-->

                       <!-- Sidebar Menu -->
                              <nav class="mt-2">
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                  <!-- Add icons to the links using the .nav-icon class
                                       with font-awesome or any other icon font library -->
                                  <li class="nav-item has-treeview menu-open">
                                    <a href="../pages/dashboard.php" class="nav-link active">
                                      <i class="nav-icon fa fa-tachometer-alt"></i>
                                      <p>
                                        Dashboard
                                      </p>
                                    </a>
                                  </li>
                                  <li class="nav-item has-treeview">
                                    <a href="../pages/repairorders.php" class="nav-link">
                                      <i class="nav-icon fa fa-clipboard-list"></i>
                                      <p>
                                        Repair Orders
                                      </p>
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="../pages/pending.php" class="nav-link">
                                      <i class="nav-icon fa fa-tools"></i>
                                      <p>
                                        Pending Service
                                      </p>
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="../pages/ready.php" class="nav-link">
                                      <i class="nav-icon fa fa-check-circle"></i>
                                      <p>
                                        Ready to Pick up
                                      </p>
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="../pages/logout.php" class="nav-link">
                                      <i class="nav-icon fa fa-sign-out-alt"></i>
                                      <p>
                                        Log Out
                                      </p>
                                    </a>
                                  </li>

                                </ul>
                              </nav>
                              <!-- /.sidebar-menu -->
                            </div>
                            <!-- /.sidebar -->
                   
                    
                    <?php

                } else {
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../index.php"><i class="nav-icon fa fa-sign-out"></i>Log in</a></li>
                </ul>
                <?php
                }
                ?>
    
  </aside>
