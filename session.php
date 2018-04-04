<?php 
session_start(); 
// $_SESSION["admin_id"] = 1; // change after login code is done
if(!isset($_SESSION["role"])){ // if "role" not set,
	session_destroy();
	header('Location: login.php');     // redirect to login page
}
?>