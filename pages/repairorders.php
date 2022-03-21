<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInUser'] ) {
    
    // send them to the login page
    header("Location: ../index.php");
}

// connect to database
include('../includes/connection.php');

// query & result
$query = "SELECT * FROM repairorder";
$result = mysqli_query( $conn, $query );

// check for query string
if( isset( $_GET['alert'] ) ) {
    
    // new client added
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New Repair Order added! <a class='close' data-dismiss='alert'>&times;</a></div>";
        
    // client updated
    } elseif( $_GET['alert'] == 'updatesuccess' ) {
        $alertMessage = "<div class='alert alert-success'>Repair Order updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
    
    // client deleted
    } elseif( $_GET['alert'] == 'deleted' ) {
        $alertMessage = "<div class='alert alert-success'>Repair Order deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
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
            <h1>Repair Orders</h1>
          </div>
          <dir class="col-sm-6 text-right">
          	<a href="addro.php" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> Add Repair order</a>
          </dir>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
<?php echo $alertMessage; ?>

            <div class="card-body">
              <table id="dataTable" class="table table-bordered table-striped">
<!--                <tbody>-->
                            <thead>  
                               <tr>  
                                    <th>REPAIR NUMBER</th>
                                    <th>DATE IN</th>
                                    <th>CUSTOMER NAME</th>
                                    <th>PHONE NUMBER</th>
                                    <th>DEVICE</th>
                                    <th>SALES REPRESENTATIVE</th>
                                    <th>STATUS</th>
                                    <th class="text-center">EDIT</th> 
                               </tr>  
                            </thead>  
                          <?php 
                  
                  if( mysqli_num_rows($result) > 0 ) {
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["ro_number"].'</td>  
                                    <td>'.$row["date_in"].'</td>  
                                    <td>'.$row["customer_name"].'</td>
                                    <td>'.$row["phone_number"].'</td>  
                                    <td>'.$row["device_type"].'</td>
                                    <td>'.$row["sales_representative"].'</td>
                                    <td>'.$row["status"].'</td>
                                    <td class="text-center"><a href="editro.php?idro=' . $row['id_ro'] . '" class="btn btn-sm btn-primary">
                    <i class="fa fa-edit text-center"></i>
                    </a></td>
                               </tr>  
                               ';  
                          } 
                      } else { // if no entries
                            echo "<div class='alert alert-warning'>You have no Repair Order registered!</div>";
                        }

                        mysqli_close($conn);

                          ?>  
<!--                </tbody>-->
              </table>
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