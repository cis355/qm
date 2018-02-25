
<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_quiz_create.php
 * author      : Tyler Parker, tjparker@svsu.edu
 * description : This php file will create a new question (table: qm_question)
 * id   [auto incremented]
 * quiz_id
 * ques_name
 * ques_text
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
require '../../database/database.php';
if ( !empty($_POST)) { // if not first time through
	// initialize user input validation variables
  $idError = null;
	$quiz_idError = null;
	$ques_nameError = null;
	$ques_textError = null;
	
	// initialize $_POST variables
	$id = $_POST['id'];
	$pid = $_POST['quiz_id'];
	$qName = $_POST['ques_name'];
	$description = $_POST['ques_text'];		
	
	// validate user input
	$valid = true;
	if (empty($id)) {
		$idError = 'Please enter ID of the question';
		$valid = false;
	}
	if (empty($qid)) {
		$quiz_idError = 'Please enter Quiz ID';
		$valid = false;
	} 		
	if (empty($qName)) {
		$ques_nameError = 'Please enter Question Name';
		$valid = false;
	}		
	if (empty($qText)) {
		$ques_textError = 'Please enter Question Text';
		$valid = false;
	}
	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO qm_questions (id, quiz_id, ques_name, ques_text) values(?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($id,$qid,$qName,$qText));
		Database::disconnect();
		header("Location: qm_ques_create.php");
	}
}
include '../../database/header.php'; //html <head> section
?>
<body>
    <div class="container">
		<div class="span10 offset1">
		
			<div class="row">
				<h3>Add New Question</h3>
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
			  
				<div class="control-group <?php echo !empty($ques_nameError)?'error':'';?>">
					<label class="control-label">Quiz ID</label>
					<div class="controls">
						<input name="per_id" type="text" placeholder="Time" value="<?php echo !empty($time)?$time:'';?>">
						<?php if (!empty($ques_nameError)): ?>
							<span class="help-inline"><?php echo $ques_nameError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($quiz_nameError)?'error':'';?>">
					<label class="control-label">Question Name</label>
					<div class="controls">
						<input name="quiz_name" type="text" placeholder="Location" value="<?php echo !empty($location)?$location:'';?>">
						<?php if (!empty($quiz_nameError)): ?>
							<span class="help-inline"><?php echo $quiz_nameError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($ques_textError)?'error':'';?>">
					<label class="control-label">Question Text</label>
					<div class="controls">
						<input name="quiz_description" type="text" placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
						<?php if (!empty($ques_textError)): ?>
							<span class="help-inline"><?php echo $ques_textError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn" href="qm_quiz.php">Back</a>
				</div>
				
			</form>
			
		</div> <!-- div: class="container" -->
				
    </div> <!-- div: class="container" -->
	
</body>
</html>