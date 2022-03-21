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
$query = "SELECT * FROM users";
$result = mysqli_query( $conn, $query );

// check for query string
if( isset( $_GET['alert'] ) ) {
    
    // new client added
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New USER added! <a class='close' data-dismiss='alert'>&times;</a></div>";
        
    // client updated
    } elseif( $_GET['alert'] == 'updatesuccess' ) {
        $alertMessage = "<div class='alert alert-success'>USER updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
    
    // client deleted
    } elseif( $_GET['alert'] == 'deleted' ) {
        $alertMessage = "<div class='alert alert-success'>USER deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
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
            <h1>Users</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <div class="input-group">
                    <input id="filtrar" type="text" class="form-control" placeholder="search">
                </div>
                <br>
            </div>


<?php echo $alertMessage; ?>
<div class="card-body">
<table class="table table-striped table-bordered">
    <tr>
        
        <th>User Name</th>
        <th>Full Name</th>
        <th>Job Tilte</th>
        <th>Edit</th>
    </tr>
    
    <tbody class="buscar">
    
    <?php
    
    if( mysqli_num_rows($result) > 0 ) {
        
        // we have data!
        // output the data
        
        while( $row = mysqli_fetch_assoc($result) ) {
            echo "<tr>";
            
            echo "<td>" . $row['username'] . "</td><td>" . $row['fullname'] . "</td><td>" . $row['jobtitle'] . "</td>";
            
            echo '<td><a href="editusers.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">
                    <i class="fa fa-edit"></i>
                    </a></td>';
            
            echo "</tr>";
        }
    } else { // if no entries
        echo "<div class='alert alert-warning'>You have no USERS!</div>";
    }

    mysqli_close($conn);

    ?>
        <tr>
            <td colspan="7"><div class="text-center"><a href="addusers.php" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> ADD USER</a></div></td>
        </tr>

</tbody>
                <tfoot>
                </tfoot>
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