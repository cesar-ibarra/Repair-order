<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInUser'] ) {
    
    // send them to the login page
    header("Location: ../index.php");
}

// get ID sent by GET collection
$roID = $_GET['idro'];
// connect to database
include('../includes/connection.php');

// include functions file
include('../includes/functions.php');

// query the database with client ID
$query = "SELECT * FROM repairorder WHERE id_ro='$roID'";
$result = mysqli_query( $conn, $query );
// if result is returned
if( mysqli_num_rows($result) > 0 ) {
    
    // we have data!
    // set some variables
    while( $row = mysqli_fetch_assoc($result) ) {
        $roNumber = $row['ro_number'];
        $dateIn = $row['date_in'];
        $customerName = $row['customer_name'];
        $phoneNumber = $row['phone_number'];
        $email = $row['email'];
        $device = $row['device_type'];
        $brand = $row['brand'];
        $issue = $row['customer_issue'];
        $missingParts = $row['missing_parts'];
        $representative = $row['sales_representative'];
        $diagnostic = $row['tech_diagnostic'];
        $service = $row['service_done'];
        $parts = $row['replaced_parts'];
        $technician = $row['technician'];
        $labor = $row['labor_charge'];
        $status = $row['status'];
        $dateout = $row['date_out'];
        
        
    }
} else { // no results returned
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='repairorders.php'>Head back</a>.</div>";
}


	//if update button was submitted
		if( isset($_POST['update']) ) {
    
		// set variables
		$diagnostic = validateFormData( $_POST["diagnostic"] );
		$service   = validateFormData( $_POST["service"] );
		$parts     = validateFormData( $_POST["parts"] );
		$technician = validateFormData( $_POST["technician"] );
		$labor = validateFormData( $_POST["labor"] );
		$dateout = validateFormData( $_POST["dateout"] );
		
		 if (!empty($labor) && empty($dateout)) {
			$status = "Service Done";
		} else if (!empty($dateout)) {
			$status = "Picked Up";
		} else {
			$status = validateFormData( $_POST["status"] );
		}
		
		
		// new database query & result
		$query = "UPDATE repairorder
            SET tech_diagnostic='$diagnostic',
            service_done='$service',
            replaced_parts='$parts',
            technician='$technician',
            labor_charge='$labor',
            status='$status',
            date_out='$dateout'
            WHERE id_ro='$roID'";
            
            //send message
             if (!empty($labor) && empty($dateout)) {
            
                require_once('phpmailer/PHPMailerAutoload.php');

                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = '465';
                $mail->isHTML(true);
                $mail->Username = 'caelectronics19@gmail.com';
                $mail->Password = 'templobinario';
                $mail->SetFrom('info@caelectronics.com	');
                $mail->Subject = "Computer Service";
                $mail->Body = '<center><img src="https://carepairorder.cesar-ibarra.com/img/screwdriver.png" alt="Repair Logo" height="80px"><h1><br><font color="#0B2369">Repair Shop</font></h1><hr />
    <h2>Great News! Your Service for <b><font color="red">RO#'.$roNumber.'</b></font> is ready to pick up.</h2><br>
    <font color="#6f6f6f"><h2>You will be receiving a phone call shortly for more details.</h2></font></center>';
                $mail->AddAddress($email);

                $mail->Send();
             }// end send message
    
    $result = mysqli_query( $conn, $query );
    
	    if( $result ) {
	        
	        // redirect to client page with query string
	        header("Location: repairorders.php?alert=updatesuccess");
	    } else {
	        echo "Error updating record: " . mysqli_error($conn); 
	    }
			

 	}

// close the mysql connection
mysqli_close($conn);

include('../includes/header.php');
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Repair Order # <?php echo $roNumber; ?></h1>
                     
            <?php echo $alertMessage; ?>
          </div>
			      <div class="col-sm-6 text-right">
          	    <a href="repairorders.php" class="btn btn-sm btn-primary"><span class="fa fa-arrow-circle-left"></span> Back</a>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            
    <div class="card-body">

             <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="POST" class="row">
                <div class="form-group col-sm-6">
                    <p for="customername">Customer Name: <?php echo $customerName; ?></p>
                    <p for="phonenumber">Phone Number: <?php echo $phoneNumber; ?></p>
                    <p for="email">Email: <?php echo $email; ?></p>
                    <p for="datein">Date In: <?php echo $dateIn; ?></p>
                    <p for="device">Device: <?php echo $device; ?></p>
                    <p for="brand">Brand: <?php echo $brand; ?></p>
                </div>
                <div class="form-group col-sm-6">
                    <p for="issue">Customer Issue: <?php echo $issue; ?></p>
                    <p for="representative">Sales Representative: <?php echo $representative; ?></p>
                    <p for="technician">Technician: <?php $_SESSION['loggedInUser']; ?> </p>
                    <p for="status">Status: <?php echo $status; ?></p>
                </div>                    
            </form>
   
   
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
		  <?php echo $alertMessage; ?>

            <div class="card-body">
              <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>?idro=<?php echo $roID; ?>" method="POST" class="row">
	              
	              	<div class="form-group col-sm-4">
                        <label for="diagnostic">Diagnostic:</label>
                        <textarea type="text" class="form-control input-lg" id="diagnostic" name="diagnostic"><?php echo $diagnostic; ?></textarea>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="status">Status</label>
                        <select class="custom-select form-control input-lg" id="status" name="status">
                          <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                          <option value="Received">Recieved</option>
                          <option value="Diagnostic">Diagnostic</option>
                          <option value="Waiting for Customer Approval">Waiting for Customer Approval</option>
                          <option value="Service Done">Service Done</option>
                          <option value="Picked Up">Picked Up</option>
                        </select>
                    </div>
                    
                    <?php
                    if ( $_SESSION['adminuser'] == "1" ) {
	                    
	                    ?>
	                    
	                <div class="form-group col-sm-4">
                        <label for="technician">Technician</label>
                        <select class="custom-select form-control input-lg" id="technician" name="technician" value="<?php echo $_SESSION['loggedInUserFullName']; ?>">
                          <option value="<?php echo $_SESSION['loggedInUserFullName']; ?>"><?php echo $_SESSION['loggedInUserFullName']; ?></option>
                        </select>
                    </div>
					<?php
	                    
                    } else {
	                    
	                    ?>
	                    
	                <div class="form-group col-sm-4">
                        <label for="technician">Technician</label>
                        <select class="custom-select form-control input-lg" id="technician" name="technician" value="<?php echo $technician; ?>">
                          <option value="<?php echo $technician; ?>"><?php echo $technician; ?></option>
                        </select>
                    </div>
					<?php
	                    
	                    
                    }
                    ?>
                   	<div class="form-group col-sm-4">
                        <label for="service">Service Done</label>
                        <textarea type="text" class="form-control input-lg" id="service" name="service"><?php echo $service; ?></textarea>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="parts">Replaced Parts</label>
                        <textarea type="text" class="form-control input-lg" id="parts" name="parts"><?php echo $parts; ?></textarea>
                    </div>
					
					<div class="form-group col-sm-4">
						<label for="labor">Labor Charge</label>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text">$</span>
						  </div>
						  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="labor" name="labor" value="<?php echo $labor; ?>">
						</div>
					</div>

					<div class="form-group col-sm-4">
                        <label for="dateout">Date Out</label>
                        <input type="text" class="form-control input-lg" id="datepicker" name="dateout" value="<?php echo $dateout; ?>">
                    </div>
                    
                <div class="col-sm-12">
                    <hr>
                    <div class="pull-right">
                        <a href="repairorders.php" type="button" class="btn btn-lg btn-default">Cancel</a>
                        <button type="submit" class="btn btn-lg btn-primary float-right" name="update">Update</button>
                    </div>
                </div>
            </form>
            
            </div>

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
    
  </div>


<?php
include('../includes/footer.php');
?>
