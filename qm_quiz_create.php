<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_quiz_create.php
 * author      : Nathan Gaffney, gaffney.nathan@svsu.edu
 * description : This php file will create a new quiz (table: qm_quiz)
 * id   [auto incremented]
 * per_id
 * quiz_name
 * quiz_description
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
	$per_idError = null;
	$quiz_nameError = null;
	$quiz_descriptionError = null;
	
	// initialize $_POST variables
	$id = $_POST['id'];
	$pid = $_POST['per_id'];
	$qName = $_POST['quiz_name'];
	$description = $_POST['quiz_description'];		
	
	// validate user input
	$valid = true;
	if (empty($id)) {
		$idError = 'Please enter ID of quiz';
		$valid = false;
	}
	if (empty($pid)) {
		$per_idError = 'Please enter Person ID';
		$valid = false;
	} 		
	if (empty($qName)) {
		$quiz_nameError = 'Please enter Quiz Name';
		$valid = false;
	}		
	if (empty($description)) {
		$quiz_descriptionError = 'Please enter Description';
		$valid = false;
	}

	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO qm_quizzes (id, per_id, quiz_name, quiz_description) values(?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($id,$pid,$qName,$description));
		Database::disconnect();
		header("Location: qm_quiz.php");
	}
}
//include '../../database/header.php'; //html <head> section
include '/home/gpcorser/public_html/database/header.php'; //html <head> section
?>
<body>
    <div class="container">
		<div class="span10 offset1">
		
			<div class="row">
				<h3>Add New Quiz</h3>
			</div>
	
			<form class="form-horizontal" action="qm_quiz_create.php" method="post">
			
				<div class="control-group <?php echo !empty($idError)?'error':'';?>">
					<label class="control-label">id</label>
					<div class="controls">
						<input name="id" type="text"  placeholder="ID" value="<?php echo !empty($id)?$id:'';?>">
						<?php if (!empty($idError)): ?>
							<span class="help-inline"><?php echo $idError;?></span>
						<?php endif; ?>
					</div>
				</div>
			  
				<div class="control-group <?php echo !empty($per_idError)?'error':'';?>">
					<label class="control-label">Persons ID</label>
					<div class="controls">
						<input name="per_id" type="text" placeholder="Persons ID" value="<?php echo !empty($time)?$time:'';?>">
						<?php if (!empty($per_idError)): ?>
							<span class="help-inline"><?php echo $per_idError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($quiz_nameError)?'error':'';?>">
					<label class="control-label">Quiz Name</label>
					<div class="controls">
						<input name="quiz_name" type="text" placeholder="Quiz Name" value="<?php echo !empty($location)?$location:'';?>">
						<?php if (!empty($quiz_nameError)): ?>
							<span class="help-inline"><?php echo $quiz_nameError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($quiz_descriptionError)?'error':'';?>">
					<label class="control-label">Description</label>
					<div class="controls">
						<input name="quiz_description" type="text" placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
						<?php if (!empty($quiz_descriptionError)): ?>
							<span class="help-inline"><?php echo $quiz_descriptionError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn" href="qm_quiz_list.php">Back</a>
				</div>
				
			</form>
			
		</div> <!-- div: class="container" -->
				
    </div> <!-- div: class="container" -->
	
</body>
</html>