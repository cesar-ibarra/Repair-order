<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInUser'] ) {
    
    // send them to the login page
    header("Location: ../index.php");
}

// get ID sent by GET collection
$userID = $_GET['id'];

// connect to database
include('../includes/connection.php');

// include functions file
include('../includes/functions.php');

// query the database with client ID
$query = "SELECT * FROM users WHERE id='$userID'";
$result = mysqli_query( $conn, $query );

// if result is returned
if( mysqli_num_rows($result) > 0 ) {
    
    // we have data!
    // set some variables
    while( $row = mysqli_fetch_assoc($result) ) {
        $userEmail     = $row['email'];
        $userEmployee    = $row['employee'];
        $userFullname  = $row['fullname'];
        $userJobTitle  = $row['jobtitle'];
        $userPrivileges    = $row['privileges'];
    }
} else { // no results returned
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='users.php'>Head back</a>.</div>";
}

// if update button was submitted
if( isset($_POST['update']) ) {
    
    // set variables
    $userFullname  = validateFormData( $_POST["fullname"] );
    $userJobTitle    = validateFormData( $_POST["jobtitle"] );
    $userPrivileges    = validateFormData( $_POST["privileges"] );
    
    // new database query & result
    $query = "UPDATE users
            SET fullname='$userFullname',
            jobtitle='$userJobTitle',
            privileges='$userPrivileges'
            WHERE id='$userID'";
    
    $result = mysqli_query( $conn, $query );
    
    if( $result ) {
        
        // redirect to client page with query string
        header("Location: users.php?alert=updatesuccess");
    } else {
        echo "Error updating record: " . mysqli_error($conn); 
    }
}

// if delete button was submitted
if( isset($_POST['delete']) ) {
    
    $alertMessage = "<div class='alert alert-danger'>
                        <p>Are you sure you want to delete this USER? No take backs!</p><br>
                        <form action='". htmlspecialchars( $_SERVER["PHP_SELF"] ) ."?id=$userID' method='post'>
                            <input type='submit' class='btn btn-warning btn-sm' name='confirm-delete' value='Yes, delete!'>
                            <input type='button' class='btn btn-secundary btn-sm' data-dismiss='alert' value='Oops, no thanks!'>
                        </form>
                    </div>";
    
}
 
// if confirm delete button was submitted
if( isset($_POST['confirm-delete']) ) {
    
    // new database query & result
    $query = "DELETE FROM users WHERE id='$userID'";
    $result = mysqli_query( $conn, $query );
    
    if( $result ) {
        
        // redirect to client page with query string
        header("Location: users.php?alert=deleted");
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
          <div class="col-sm-12">
            <h1 class="float-left">Edit User</h1>
            <a href="users.php" type="button" class="btn btn-lg btn-default float-right">Cancel</a>
          </div>
		 <?php echo $alertMessage; ?>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            
    <div class="card-body">

            <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>?id=<?php echo $userID; ?>" method="post" class="row">
                <div class="form-group col-sm-6">
                    <label for="fulname">Full Name</label>
                    <input type="text" class="form-control input-lg" id="fullname" name="fullname" value="<?php echo $userFullname; ?>">
                </div>
                <div class="form-group col-sm-6">
                    <label for="jobtitle">Job Title</label>
                    <input type="text" class="form-control input-lg" id="jobtitle" name="jobtitle" value="<?php echo $userJobTitle; ?>">
                </div>
                
                <div class="form-group col-sm-6">
                <label for="privileges">Privilege*</label>
                <select class="custom-select form-control input-lg" id="privileges" name="privileges" value="">
                  <option value="<?php echo $userPrivileges; ?>"><?php echo $userPrivileges; ?></option>
                  <option value="0">Administrator</option>
                  <option value="1">Technician</option>
                  <option value="2">Sales Person</option>
                </select>
            	</div>

				<div class="col-sm-12">
                <hr>
	         		<button type="submit" class="btn btn-lg btn-danger float-left" name="delete">Delete</button> 
		     		<button type="submit" class="btn btn-lg btn-primary float-right" name="update">Update</button>
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



