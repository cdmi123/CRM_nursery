<?php 

/* start Session for using Login page */

session_start();

/* Check Login */



/* Database Connection */

$con = mysqli_connect("localhost","root","","crm_system");

if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}




?>