<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_ques_create.php
 * author      : Tyler Parker, tjparker@svsu.edu
 * description : This php file will create a new question (table: qm_question)
 * id   [auto incremented]
 * quiz_id
 * ques_name
 * ques_text
 * ---------------------------------------------------------------------------
 */
include 'session.php';
include '/home/gpcorser/public_html/database/header.php';
include '/home/gpcorser/public_html/database/database.php';
if ( !empty($_POST)) { // if not first time through
	// initialize user input validation variables
  //$idError = null;
	
	$ques_nameError = null;
	$ques_textError = null;
	
	// initialize $_POST variables
	//$id = $_POST['id'];
	$qid = $_SESSION['quiz_id'];
	$qName = $_POST['ques_name'];
	$qText = $_POST['ques_text'];		
	
	// validate user input
	$valid = true;
	//if (empty($id)) {
	//	$idError = 'Please enter ID of the question';
	//	$valid = false;
	//}
		
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
		$sql = "INSERT INTO qm_questions (quiz_id, ques_name, ques_text) values(?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($qid,$qName,$qText));
		Database::disconnect();
		header("Location: qm_ques_list.php?quiz_id=" . $qid);
	}
}
//include '../../database/header.php'; //html <head> section
 //html <head> section
?>
<html>
<body>
    <div class="container">
		<div class="span10 offset1">
		
			<div class="row">
				<h3>Add New Question</h3>
			</div>
	
			<form class="form-horizontal" action="qm_ques_list.php" method="post">						  
				<div class="control-group <?php echo !empty($quiz_nameError)?'error':'';?>">
					<label class="control-label">Question Name</label>
					<div class="controls">
						<input name="ques_name" type="text" placeholder="Question Name" value="<?php echo !empty($qName)?$qName:'';?>">
						<?php if (!empty($quiz_nameError)): ?>
							<span class="help-inline"><?php echo $quiz_nameError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($ques_textError)?'error':'';?>">
					<label class="control-label">Question Text</label>
					<div class="controls">
						<input name="ques_text" type="text" placeholder="Ask Your Question" value="<?php echo !empty($qText)?$qText:'';?>">
						<?php if (!empty($ques_textError)): ?>
							<span class="help-inline"><?php echo $ques_textError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn" href="qm_ques_list.php">Back</a>
				</div>
				
			</form>
			
		</div> <!-- div: class="container" -->
				
    </div> <!-- div: class="container" -->
	
</body>
</html>