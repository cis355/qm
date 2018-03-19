<?php  
/* ---------------------------------------------------------------------------
 * filename    : qm_quiz_delete.php
 * author      : Andrew Savage, amsavag2@svsu.edu - taken from george corser original code
 * description : This program deletes one quiz's details (table: qm_quizzes)
 * ---------------------------------------------------------------------------
 *
session_start();
if(!isset($_SESSION["qm_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
*/
include 'session.php';
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';
//require 'functions.php';
$id = $_GET['id'];
if ( !empty($_POST)) { // if user clicks "yes" (sure to delete), delete record
	$id = $_POST['id'];
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM qm_quizzes  WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	Database::disconnect();
	header("Location: qm_quiz_list.php");
	
} 
else { // otherwise, pre-populate fields to show data to be deleted
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM qm_quizzes where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="icon" href="cardinal_logo.png" type="image/png" />
</head>

<body>
    <div class="container">
		<div class="row">
			<h3>Delete Quiz</h3>
		</div>
		
		<form class="form-horizontal" action="qm_quiz_delete.php" method="post">
			<input type="hidden" name="id" value="<?php echo $id;?>"/>
			<p class="alert alert-error">Are you sure you want to delete ?</p>
			<div class="form-actions">
				<button type="submit" class="btn btn-danger">Yes</button>
				<a class="btn" href="qm_quiz_list.php">No</a>
			</div>
		</form>
		
		<!-- Display same information as in file: qm_per_read.php -->
 
		<div class="form-horizontal" >
				
			<div class="control-group col-md-6">
			
				<label class="control-label">Id</label>
				<div class="controls ">
					<label class="checkbox">
						<?php echo $data['per_id'];?> 
					</label>
				</div>
				
				<label class="control-label">Quiz Name</label>
				<div class="controls ">
					<label class="checkbox">
						<?php echo $data['quiz_name'];?> 
					</label>
				</div>
				
				<label class="control-label">Quiz Description</label>
				<div class="controls">
					<label class="checkbox">
						<?php echo $data['quiz_description'];?>
					</label>
				</div>
				
				<!-- password omitted on Read/View -->
				
			</div>
				
		</div>  <!-- end div: class="form-horizontal" -->

    </div> <!-- end div: class="container" -->
	
	<p>Andrew Savage (amsavag2)</p>
	
</body>
</html>


