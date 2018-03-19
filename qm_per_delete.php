<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_per_delete.php
 * author      : Kyle Graham, kyle.graham11@gmail.com - taken from george corser original code fr_per_delete.php
 * description : This program deletes one person's details (table: qm_persons)
 * ---------------------------------------------------------------------------
 *
session_start();
if(!isset($_SESSION["qm_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
*/
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';
$id = $_GET['id'];
if ( !empty($_POST)) { // if user clicks "yes" (sure to delete), delete record
	$id = $_POST['id'];
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM qm_persons  WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	Database::disconnect();
	header("Location: qm_per_list.php");
	
} 
else { // otherwise, pre-populate fields to show data to be deleted
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM qm_persons where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">

<body style ="background-color: lightblue !important";>
    <!-- <div class="container">
		<div class="row">
			<h3>Delete Person</h3>
		</div>
	</div>
		<br>
		
		<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>Lastname</th>
						<th>Firstname</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<th>Action</th>
					</tr>
					<tr>
						<td><form class="form-horizontal" action="qm_per_delete.php" method="post">
							<input type="hidden" name="id" value=""/>
							<p class="alert alert-error">Are you sure you want to delete?</p>
							<div class="form-actions">
								<button type="submit" class="btn btn-success">Yes</button>
								<a class="btn btn-danger" href="qm_per_list.php">No</a>
							</div>
						</form></td>
					</tr>
				</tbody>
		</table> -->
		 <div class="container">
		<div class="row">
			<h3>Delete Person</h3>
		</div>
		
		<form class="form-horizontal" action="qm_per_delete.php" method="post">
			<input type="hidden" name="id" value="<?php echo $id;?>"/>
			<p class="alert alert-error">Are you sure you want to delete ?</p>
			<div class="form-actions">
				<button type="submit" class="btn btn-success">Yes</button>
				<a class="btn btn-danger" href="qm_per_list.php">No</a>
			</div>
		</form>
		<br>
		
		
		<div class="form-horizontal" >
				
			<div class="control-group col-md-6">
			
				<label class="control-label">First Name</label>
				<div class="controls ">
					<label class="checkbox">
						<?php echo $data['fname'];?> 
					</label>
				</div>
				
				<label class="control-label">Last Name</label>
				<div class="controls ">
					<label class="checkbox">
						<?php echo $data['lname'];?> 
					</label>
				</div>
				
				<label class="control-label">Email</label>
				<div class="controls">
					<label class="checkbox">
						<?php echo $data['email'];?>
					</label>
				</div>
				  
				
				
			</div>
				
			<br><br>
			
			<p>Kyle Graham, kjgraham@svsu.edu</p>
				

</body>
</html>