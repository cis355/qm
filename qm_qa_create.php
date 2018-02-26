<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_qa_create.php
 * author      : Anthony Polisno, apolisan@svsu.edu
 * description : This php file will create a new quiz attempt.
 * ---------------------------------------------------------------------------
 */
 /*
   session_start();
if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
*/
//require '../../database/database.php';
require '/home/gpcorser/public_html/database/database.php';
if ( !empty($_POST)) { // if not first time through
	// initialize user input validation variables
	$idError = null;
	$quiz_idError = null;
	$qa_scoreError = null;
	$qa_start_dateError = null;
	$qa_end_dateError = null;
	$qa_start_timeError = null;
	$qa_end_timeError = null;
	
	
	// initialize $_POST variables
	$id = $_POST['id'];
	$quiz_id = $_POST['quiz_id'];
	$qa_score = $_POST['qa_score'];
	$qa_start_date = $_POST['qa_start_date'];		
	$qa_end_date = $_POST['qa_end_date'];
	$qa_start_time = $_POST['qa_start_time'];
	$qa_end_time = $_POST['qa_end_time'];
	
	// validate user input
	$valid = true;
	if (empty($id)) {
		$idError = 'Please enter person ID';
		$valid = false;
	}
	if (empty($quiz_id)) {
		$per_idError = 'Please enter Quiz ID';
		$valid = false;
	} 		
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
	
	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO qm_attempts (id, quiz_id, qa_score, qa_start_date, qa_end_date, qa_start_time, qa_end_time) values(?, ?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($id,$quiz_id,$qa_score,$qa_start_date,$qa_end_date, $qa_start_time, $qa_end_time));
		Database::disconnect();
		//header("Location: qm_quiz.php");
		header("Location: qm_qa_list.php");
	}
}
//include '../../database/header.php'; //html <head> section
include '/home/gpcorser/public_html/database/header.php'; //html <head> section
?>
<body>
    <div class="container">
		<div class="span10 offset1">
		
			<div class="row">
				<h3>Add New Quiz Attempt</h3>
			</div>
	
			<form class="form-horizontal" action="qm_qa_create.php" method="post">
			
				<div class="control-group <?php echo !empty($idError)?'error':'';?>">
					<label class="control-label">id</label>
					<div class="controls">
						<input name="id" type="text"  placeholder="ID" value="<?php echo !empty($id)?$id:'';?>">
						<?php if (!empty($idError)): ?>
							<span class="help-inline"><?php echo $idError;?></span>
						<?php endif; ?>
					</div>
				</div>
			  
				<div class="control-group <?php echo !empty($quiz_idError)?'error':'';?>">
					<label class="control-label">Quiz ID</label>
					<div class="controls">
						<input name="quiz_id" type="text" placeholder="Quiz ID" value="<?php echo !empty($quiz_id)?$quiz_id:'';?>">
						<?php if (!empty($quiz_idError)): ?>
							<span class="help-inline"><?php echo $quiz_idError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($qa_scoreError)?'error':'';?>">
					<label class="control-label">Quiz Score</label>
					<div class="controls">
						<input name="qa_score" type="text" placeholder="Quiz Score" value="<?php echo !empty($qa_score)?$qa_score:'';?>">
						<?php if (!empty($qa_scoreError)): ?>
							<span class="help-inline"><?php echo $qa_scoreError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($qa_start_dateError)?'error':'';?>">
					<label class="control-label">Start Date</label>
					<div class="controls">
						<input name="qa_start_date" type="text" placeholder="Start Date" value="<?php echo !empty($qa_start_date)?$qa_start_date:'';?>">
						<?php if (!empty($qa_start_dateError)): ?>
							<span class="help-inline"><?php echo $qa_start_dateError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($qa_end_dateError)?'error':'';?>">
					<label class="control-label">End Date</label>
					<div class="controls">
						<input name="qa_end_date" type="text" placeholder="End Date" value="<?php echo !empty($qa_end_date)?$qa_end_date:'';?>">
						<?php if (!empty($qa_end_dateError)): ?>
							<span class="help-inline"><?php echo $qa_end_dateError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($qa_start_timeError)?'error':'';?>">
					<label class="control-label">Start Time</label>
					<div class="controls">
						<input name="qa_start_time" type="text" placeholder="Start Time" value="<?php echo !empty($qa_start_time)?$qa_start_time:'';?>">
						<?php if (!empty($qa_start_timeError)): ?>
							<span class="help-inline"><?php echo $qa_start_timeError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($qa_end_timeError)?'error':'';?>">
					<label class="control-label">End Time</label>
					<div class="controls">
						<input name="qa_end_time" type="text" placeholder="End Time" value="<?php echo !empty($qa_end_time)?$qa_end_time:'';?>">
						<?php if (!empty($qa_end_timeError)): ?>
							<span class="help-inline"><?php echo $qa_end_timeError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<!---------------------------------------------------------------------------------------------->
		
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn" href="qm_qa_list.php">Back</a>
				</div>
				
			</form>
			
		</div> <!-- div: class="container" -->
				
    </div> <!-- div: class="container" -->
	
</body>
</html>