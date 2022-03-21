<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInAdmin'] ) {
    
    // send them to the login page
    header("Location: ../index.php");
}

// connect to database
include('../includes/connection.php');

// query & result
$query = "SELECT * FROM employees WHERE status = '1'";
$result = mysqli_query( $conn, $query );

// check for query string
if( isset( $_GET['alert'] ) ) {
    
    // new client added
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New Employee added! <a class='close' data-dismiss='alert'>&times;</a></div>";
        
    // client updated
    } elseif( $_GET['alert'] == 'updatesuccess' ) {
        $alertMessage = "<div class='alert alert-success'>Employee updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
    
    // client deleted
    } elseif( $_GET['alert'] == 'deleted' ) {
        $alertMessage = "<div class='alert alert-success'>Employee deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
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
            <h1>Active Employees</h1>
          </div>

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
                                    <th>EMPLOYEE #</th>
                                    <th>NAME</th>
                                    <th>LAST NAME</th>
                                    <th>DEPARTMENT</th>
                                    <th class="text-center">INFO</th> 
                               </tr>  
                            </thead>  
                          <?php 
                  
                  if( mysqli_num_rows($result) > 0 ) {
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["employee_number"].'</td>  
                                    <td>'.$row["employee_name"].'</td>  
                                    <td>'.$row["employee_lastname"].'</td>  
                                    <td>'.$row["department"].'</td>
                                    <td><a href="editemployee.php?id_employee=' . $row['id_employee'] . '" class="btn btn-sm btn-primary">
                    <i class="fa fa-edit text-center"></i>
                    </a></td>
                               </tr>  
                               ';  
                          } 
                      } else { // if no entries
                            echo "<div class='alert alert-warning'>You have no Employee registred!</div>";
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