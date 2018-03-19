<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_qa_delete.php
 * author      : Ryan Ott, raott@svsu.edu - taken from george corser original code fr_per_delete.php
 * description : This program deletes one quiz attempt's details (table: qm_attempts)
 * ---------------------------------------------------------------------------
 *
*/
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';
$id = $_GET['quiz_id'];
if ( !empty($_POST)) { // if user clicks "yes" (sure to delete), delete record
	$id = $_POST['id'];
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM qm_attempts  WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	Database::disconnect();
	header("Location: qm_qa_list.php");
	
} 
else { // otherwise, pre-populate fields to show data to be deleted
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM qm_attempts where quiz_id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}
?>

<!--/* ---------------------------------------------------------------------------
 * filename    : qm_qa_delete.php
 * author      : Ryan Ott, raott@svsu.edu - taken from george corser original code fr_per_delete.php
 * description : This program deletes one quiz attempt's details (table: qm_attempts)
 * ---------------------------------------------------------------------------
 *
*/ -->
<!DOCTYPE html>

<html lang="en">

<!--<link rel="icon" href="ohno.jpg" type="image/jpg" />-->

<body>
    <div class="container">
		<div class="row">
			<h3><br><br>Delete Quiz Attempt</h3>
			<!--<h2>&nbsp&nbsp<img src="ohno.jpg" alt="Oh No Dude"/></h2>-->
		</div>
		
		<form class="form-horizontal" action="qm_qa_delete.php" method="post">
			<input type="hidden" name="id" value="<?php echo $id;?>"/>
			<p class="alert alert-error">Are you sure you want to delete?</p>
			<div class="form-actions">
				<button type="submit" class="btn btn-danger">Yes</button>
				<a class="btn" href="qm_qa_list.php">No</a>
			</div>
		</form>
		
		<!-- Display same information as in file: qm_per_read.php -->
		
		<div class="form-horizontal" >
				
			<div class="control-group col-md-6">
			
				<label class="control-label">ID</label>
				<div class="controls ">
					<label class="checkbox">
						<?php echo $data['id'];?> 
					</label>
				</div>
				
				<label class="control-label">Quiz ID</label>
				<div class="controls ">
					<label class="checkbox">
						<?php echo $data['quiz_id'];?> 
					</label>
				</div>
				
				<label class="control-label">Quiz Attempt Score</label>
				<div class="controls">
					<label class="checkbox">
						<?php echo $data['qa_score'];?>
					</label>
				</div>
				
				<label class="control-label">Date Started</label>
				<div class="controls">
					<label class="checkbox">
						<?php echo $data['qa_start_date'];?>
					</label>
				</div>
				
				<label class="control-label">Date Ended</label>
				<div class="controls">
					<label class="checkbox">
						<?php echo $data['qa_end_date'];?>
					</label>
				</div>
				
				<label class="control-label">Time Started</label>
				<div class="controls">
					<label class="checkbox">
						<?php echo $data['qa_start_time'];?>
					</label>
				</div>
				
				<label class="control-label">Time Ended</label>
				<div class="controls">
					<label class="checkbox">
						<?php echo $data['qa_end_time'];?>
					</label>
				</div>
				
				<!-- password omitted on Read/View -->
				
			</div>
				
		</div>  <!-- end div: class="form-horizontal" -->
		<p>Made by: Ryan Ott raott@svsu.edu</p>
    </div> <!-- end div: class="container" -->
	
</body>
</html>