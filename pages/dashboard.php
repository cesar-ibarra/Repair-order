<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInUser'] ) {
    
    // send them to the login page
    header("Location: ../index.php");
}

// connect to database
include('../includes/connection.php');

// include functions file
include('../includes/functions.php');


// query & result
$queryPending = "SELECT * FROM repairorder WHERE status='Received'";
$resultPending = mysqli_query( $conn, $queryPending );
/* 
// query & result
$queryUsers = "SELECT * FROM users";
$resultUsers = mysqli_query( $conn, $queryUsers ); */

//query & result
$queryWaiting = "SELECT * FROM repairorder WHERE status = 'Waiting for Customer Approval'";
$resultWaiting = mysqli_query( $conn, $queryWaiting );

$queryReady = "SELECT * FROM repairorder WHERE status = 'Service Done'";
$resultReady = mysqli_query( $conn, $queryReady );

$queryDiagnostic = "SELECT * FROM repairorder WHERE status = 'Diagnostic'";
$resultDiagnostic = mysqli_query( $conn, $queryDiagnostic );

$totalPending = mysqli_num_rows($resultPending);
$totalReady = mysqli_num_rows($resultReady);
$totalWaiting = mysqli_num_rows($resultWaiting);
$totalDiagnostic = mysqli_num_rows($resultDiagnostic);
// $receivedSor = mysqli_num_rows($resultReceived);

// check for query string
if( isset( $_GET['alert'] ) ) {
    
    // new client added
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New Time Clock added! <a class='close' data-dismiss='alert'>&times;</a></div>";
        
    // client updated
    } elseif( $_GET['alert'] == 'updated' ) {
        $alertMessage = "<div class='alert alert-success'>Time Card updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
    
    // client deleted
    } elseif( $_GET['alert'] == 'deleted' ) {
        $alertMessage = "<div class='alert alert-success'>Time Clock deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
      
}

// close the mysql connection
mysqli_close($conn);

include('../includes/header.php');
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php  echo $totalPending ?></h3>

                <p>Pending</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="pending.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php  echo $totalDiagnostic ?></h3>
                <p>Diagnostic</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-pulse"></i>
              </div>
              <a href="diagnostic.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php  echo $totalWaiting ?></h3>
                <p>Waiting for Approval</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-stopwatch"></i>
              </div>
              <a href="waiting.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php  echo $totalReady ?></h3>
                <p>Ready to Pick Up</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-checkmark-outline"></i>
              </div>
              <a href="ready.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          
          <div class="col-lg-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
				<div class="clock">
		           <div id="Date"></div>
		              <ul>
		                <li id="hours"></li>
		                <li id="point">:</li>
		                <li id="min"></li>
		                <li id="point">:</li>
		                <li id="sec"></li>
		              </ul>
		           </div>
              </div>
              <div class="icon">
                <i class="ion ion-ios-alarm"></i>
              </div>
              <a href="" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          
        </div>
        <!-- /.row -->
        <!-- Main row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php

    include('../includes/footer.php');

?>