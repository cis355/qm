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
	$i = 9;
	$location = "Location: qm_qa_list.php?per_id=$id";
	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO qm_attempts (id, quiz_id, qa_score, qa_start_date, qa_end_date, qa_start_time, qa_end_time) values(?, ?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($id,$quiz_id,$qa_score,$qa_start_date,$qa_end_date, $qa_start_time, $qa_end_time));
		Database::disconnect();
	header($location);
	}
}

?>
<body style ="background-color: lightblue !important";>
	
    <div class="container">
		<div class="span10 offset1">
		
			<div class="row">
				<h3>Add New Quiz Attempt</h3>
			</div>
			<div>
				<h5>What Quiz would you like to attempt?</h5>
				 <select name="quiz" multiple="multiple">
					<option value = "1" selected>&nbsp 1 &nbsp </option>
					<option value = "2">&nbsp 2 &nbsp </option>
					<option value = "3">&nbsp 3 &nbsp </option>
					<option value = "4">&nbsp 4 &nbsp </option>
					<option value = "5">&nbsp 5 &nbsp </option>
				 </select>
			</div>
	
	
			<form class="form-horizontal" action="qm_qa_create.php" method="post">
			
		<!--	NO NEED FOR THIS NOW. PERSON ID SHOULD BE PROVIDED.	
				<div class="control-group <?php echo !empty($idError)?'error':'';?>">
					<label class="control-label">Person ID</label>
					<div class="controls">
						<input name="id" type="text"  placeholder="ID" value="<?php echo !empty($id)?$id:'';?>">
						<?php if (!empty($idError)): ?>
							<span class="help-inline"><?php echo $idError;?></span>
						<?php endif; ?>
					</div>
				</div>
	-->
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
					<a class="btn" href="qm_qa_list.php?per_id=<?php echo $_GET[per_id];?>" >Back</a>
				</div>
				
			</form>
			
		</div> <!-- div: class="container" -->
				
    </div> <!-- div: class="container" -->
	</br>
	<p>&nbsp apolisan@svsu.edu<p>
</body>
</html>