<<<<<<< HEAD
<?php
session_start();

=======
<?php 
session_start(); 
$_SESSION["admin_id"] = 1; // change after login code is done
if(!isset($_SESSION["admin_id"]) && !isset($_SESSION["per_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
>>>>>>> dfcbc1905c7dbba047887f365dff6f7a6a773765
?>