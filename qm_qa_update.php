<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_qa_create.php
 * author      : Anthony Polisano, apolisan@svsu.edu
 * description : This php file will create a new quiz attempt.
 * ---------------------------------------------------------------------------
 */
 
//require '../../database/database.php';
include 'session.php';
require '/home/gpcorser/public_html/database/header.php'; //html <head> section
require '/home/gpcorser/public_html/database/database.php';

$per_id = $_GET['per_id'];
if ( !empty($_POST)) { // if not first time through
	// initialize user input validation variables
	$idError = null;
	$qa_scoreError = null;
	$qa_start_dateError = null;
	$qa_end_dateError = null;
	$qa_start_timeError = null;
	$qa_end_timeError = null;
	
	//          !!!            
	$quiz = $_POST['quiz']; 
	
	
	$qa_score = $_POST['qa_score'];
	$qa_start_date = $_POST['qa_start_date'];		
	$qa_end_date = $_POST['qa_end_date'];
	$qa_start_time = $_POST['qa_start_time'];
	$qa_end_time = $_POST['qa_end_time'];
	
	// validate user input
	$valid = true;

	// person id is provided in the URL
	$id = $_GET['per_id'];
	$per_id = $id;
	$quiz_id = '2';

	
	// The rest are provided by user
	if (empty($qa_score)) {
		$per_idError = 'Please enter Quiz score';
		$valid = false;
	} 		
	
	if (empty($qa_start_date)) {
		$per_idError = 'Please enter Start Date';
		$valid = false;
	} 			
	if (empty($qa_end_date)) {
		$per_idError = 'Please enter End Date';
		$valid = false;
	} 			
	if (empty($qa_start_time)) {
		$per_idError = 'Please enter Start Time';
		$valid = false;
	} 			
	if (empty($qa_end_time)) {
		$per_idError = 'Please enter End Time';
		$valid = false;
	} 			
	
	if ($valid) { // if valid user input update the database
	
		if($fileSize > 0) { // if file was updated, update all fields
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'UPDATE qm_attempts  set qa_score = ?, qa_start_date = ?, qa_end_date = ?, qa_start_time = ?, qa_end_time = ? WHERE id = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($qa_score,$qa_start_date,$qa_end_date, $qa_start_time, $qa_end_time, $id));
			Database::disconnect();
			header("Location: qm_qa_list.php?per_id='.$_SESSION[per_id].'");
		}
		else { // otherwise, update all fields EXCEPT file fields
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'UPDATE qm_attempts  set qa_score = ?, qa_start_date = ?, qa_end_date = ?, qa_start_time = ?, qa_end_time = ? WHERE id = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($qa_score,$qa_start_date,$qa_end_date, $qa_start_time, $qa_end_time, $id));
			Database::disconnect();
			header("Location: qm_qa_list.php?per_id='.$_SESSION[per_id].'");
		}
	}
} else { // if $_POST NOT filled then pre-populate the form
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM qm_attempts where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<body style="background-color: lightblue !important";>
    <div class="container">

		<div class="span10 offset1">

		
			<div class="row">
				<h3>Update Attempt</h3>
			</div>
	
			<form class="form-horizontal" action="qm_qa_update.php?per_id=<?php echo $_SESSION['per_id']?>" method="post" enctype="multipart/form-data">
			
			
				
				<div class="control-group <?php echo !empty($qa_scoreError)?'error':'';?>">
					<label class="control-label"><h6>Quiz Attempt Score</h6></label>
					<div class="controls">
						<input style="background-color: lightgrey !important; width: 40%;" name="qa_score" type="text" placeholder="Quiz Attempt Score" value="<?php echo !empty($qa_score)?$qa_score:'';?>">
						<?php if (!empty($qa_scoreError)): ?>
							<span class="help-inline"><?php echo $qa_scoreError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($qa_start_dateError)?'error':'';?>">
					<label class="control-label"><h6>Date Started</h6></label>
					<div class="controls">
						<input style="background-color: lightgrey !important; width: 40%;" name="qa_start_date" type="text" placeholder="Date Started" value="<?php echo !empty($qa_start_date)?$qa_start_date:'';?>">
						<?php if (!empty($qa_start_dateError)): ?>
							<span class="help-inline"><?php echo $qa_start_dateError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($qa_end_dateError)?'error':'';?>">
					<label class="control-label"><h6>Date Ended</h6></label>
					<div class="controls">
						<input style="background-color: lightgrey !important; width: 40%;" name="qa_end_date" type="text" placeholder="Date Ended" value="<?php echo !empty($qa_end_date)?$qa_end_date:'';?>">
						<?php if (!empty($qa_end_dateError)): ?>
							<span class="help-inline"><?php echo $qa_end_dateError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($qa_start_timeError)?'error':'';?>">
					<label class="control-label"><h6>Time Started</h6></label>
					<div class="controls">
						<input style="background-color: lightgrey !important; width: 40%;" name="qa_start_time" type="text" placeholder="Time Started" value="<?php echo !empty($qa_start_time)?$qa_start_time:'';?>">
						<?php if (!empty($qa_start_timeError)): ?>
							<span class="help-inline"><?php echo $qa_start_timeError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($qa_end_timeError)?'error':'';?>">
					<label class="control-label"><h6>Time Ended</h6></label>
					<div class="controls">
						<input style="background-color: lightgrey !important; width: 40%;" name="qa_end_time" type="text" placeholder="Time Ended" value="<?php echo !empty($qa_end_time)?$qa_end_time:'';?>">
						<?php if (!empty($qa_end_timeError)): ?>
							<span class="help-inline"><?php echo $qa_end_timeError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<br />
				
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Update</button>
					<a class="btn btn-primary" href="qm_qa_list.php?per_id=<?php echo $_SESSION['per_id']?>">Back</a>
				</div>
				
			</form>
			
				
				
		</div><!-- end div: class="span10 offset1" -->
		
    </div> <!-- end div: class="container" -->
	
</body>
</html>