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

// if add button was submitted
if( isset( $_POST['add'] ) ) {
    
    // set all variables to empty by default
    $roNumber = $roDatein = $roCustomername = $phoneNumber = $email = $deviceType = $brand = $customerIssue = $missingParts = $representative = $status = $dateout = "";
    
    // check to see if inputs are empty
    // create variables with form data
    // wrap the data with our function
    
    // these inputs are not required
    // so we'll just store whatever has been entered
    $roNumber = validateFormData( $_POST["ronumber"] );
    $roDatein = validateFormData( $_POST["rodatein"] );
    $roCustomername = validateFormData( $_POST["customername"] );
    $phoneNumber    = validateFormData( $_POST["phonenumber"] );
    $email    = validateFormData( $_POST["email"] );
    $deviceType  = validateFormData( $_POST["device"] );
    $brand = validateFormData( $_POST["brand"] );
    $customerIssue  = validateFormData( $_POST["issue"] );
    $missingParts    = validateFormData( $_POST["missingparts"] );
    $representative    = validateFormData( $_POST["representative"] );
    $status    = validateFormData( $_POST["status"] );
    $dateout = "";
    
    // if required fields have data
//    if( $sorRoNumber && $sorParts ) {
        
        // create query
        $query = "INSERT INTO repairorder (id_ro, ro_number, date_in, customer_name, phone_number, email, device_type, brand, customer_issue, missing_parts, sales_representative, status, date_out) VALUES (NULL, '$roNumber', '$roDatein', '$roCustomername', '$phoneNumber', '$email', '$deviceType', '$brand', '$customerIssue', '$missingParts', '$representative', '$status', '$dateout')";
        
        $result = mysqli_query( $conn, $query );
        
        // if query was successful
        if( $result ) {
            
            // refresh page with query string
            header( "Location: repairorders.php?alert=success" );
        } else {
            
            // something went wrong
            echo "Error: ". $query ."<br>" . mysqli_error($conn);
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
            <h1>Add Repair Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                  
            </ol>
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

                <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" class="row">
                    <div class="form-group col-sm-4">
                        <label for="ronumber">RO Number</label>
                        <input type="text" class="form-control input-lg" id="ronumber" name="ronumber" value="">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="datein">Date In</label>
                        <input type="text" class="form-control input-lg" id="datepicker" name="rodatein" value="">
                    </div>
                     <div class="form-group col-sm-4">
                        <label for="customername">Customer Name</label>
                        <input type="text" class="form-control input-lg" id="customername" name="customername" value="">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="phonenumber">Phone Number</label>
                        <input type="text" class="form-control input-lg" id="phonenumber" name="phonenumber" value="">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="email">Email</label>
                        <input type="text" class="form-control input-lg" id="email" name="email" value="">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="device">Device Type</label>
                        <select class="custom-select form-control input-lg" id="device" name="device" value="">
                          <option value="Laptop">Laptop</option>
                          <option value="Desktop">Desktop</option>
                          <option value="Cellphone">Cellphone</option>
						  <option value="Tablet">Tablet</option>
						  <option value="Printer">Printer</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control input-lg" id="brand" name="brand"></input>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="issue">Issue</label>
                        <textarea type="text" class="form-control input-lg" id="issue" name="issue"></textarea>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="misingparts">Missing Parts</label>
                        <textarea type="text" class="form-control input-lg" id="missingparts" name="missingparts"></textarea>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="representative">Sales Representative</label>
                        <input type="text" class="form-control input-lg" id="representative" name="representative"></input>
                    </div>
        <!--            <div class="form-group col-sm-4">-->
        <!--                <label for="representative">Sales Representative</label>-->
        <!--                <select class="custom-select form-control input-lg" id="representative" name="representative" value="">-->
        <!--                  <option value="Claudia DeLeon">Claudia DeLeon</option>-->
        <!--                  <option value="Maritza DeLeon">Maritza DeLeon</option>-->
        <!--                  <option value="Mirna DeLeon">Mirna DeLeon</option>-->
        <!--                  <option value="Alexis DeLeon">Alexis DeLeon</option>-->
						  <!--<option value="Luis Alvarado">Luis Alvarado</option>-->
						  <!--<option value="Agru DeLeon">Agru DeLeon</option>-->
        <!--                </select>-->
        <!--            </div>-->
                    <div class="form-group col-sm-4">
                        <label for="status">Status</label>
                        <select class="custom-select form-control input-lg" id="status" name="status" value="">
                          <option value="Received">Recieved</option>
                          <option value="Diagnostic">Diagnostic</option>
                          <option value="Waiting for Customer Approval">Waiting for Customer Approval</option>
                          <option value="Service Done">Service Done</option>
                          <option value="Picked Up">Picked Up</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <a href="repairorders.php" type="button" class="btn btn-lg btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-lg btn-primary float-right" name="add">ADD REPAIR ORDER</button>
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