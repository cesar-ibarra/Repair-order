<?php

$server     = "sdb-d.hosting.stackcp.net";
$username   = "repairorder-313733cc6b";
$password   = "n5iuqutsns";
$db         = "repairorder-313733cc6b";

// create a connection
$conn = mysqli_connect( $server, $username, $password, $db );

// check connection
if( !$conn ) {
    die( "Connection failed: " . mysqli_connect_error() );
}

?>