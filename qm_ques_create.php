<<<<<<< HEAD

=======
>>>>>>> 07fd39b125319fa2002aa09ac38dbc414b4c769c
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
<<<<<<< HEAD
  //$idError = null;
=======
  $idError = null;
>>>>>>> 07fd39b125319fa2002aa09ac38dbc414b4c769c
	$quiz_idError = null;
	$ques_nameError = null;
	$ques_textError = null;
	
	// initialize $_POST variables
<<<<<<< HEAD
	//$id = $_POST['id'];
=======
	$id = $_POST['id'];
>>>>>>> 07fd39b125319fa2002aa09ac38dbc414b4c769c
	$qid = $_POST['quiz_id'];
	$qName = $_POST['ques_name'];
	$qText = $_POST['ques_text'];		
	
	// validate user input
<<<<<<< HEAD
	//$valid = true;
	//if (empty($id)) {
	//	$idError = 'Please enter ID of the question';
	//	$valid = false;
	//}
=======
	$valid = true;
	if (empty($id)) {
		$idError = 'Please enter ID of the question';
		$valid = false;
	}
>>>>>>> 07fd39b125319fa2002aa09ac38dbc414b4c769c
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
<<<<<<< HEAD
		$sql = "INSERT INTO qm_questions (quiz_id, ques_name, ques_text) values(?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($qid,$qName,$qText));
=======
		$sql = "INSERT INTO qm_questions (id, quiz_id, ques_name, ques_text) values(?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($id,$qid,$qName,$qText));
>>>>>>> 07fd39b125319fa2002aa09ac38dbc414b4c769c
		Database::disconnect();
		header("Location: qm_ques_list.php");
	}
}
//include '../../database/header.php'; //html <head> section
include '/home/gpcorser/public_html/database/header.php'; //html <head> section
?>
<html>
<body>
    <div class="container">
		<div class="span10 offset1">
		
			<div class="row">
				<h3>Add New Question</h3>
			</div>
	
<<<<<<< HEAD
			<form class="form-horizontal" action="qm_ques_list.php" method="post">						  
				<div class="control-group <?php echo !empty($ques_nameError)?'error':'';?>">
					<label class="control-label">Quiz ID</label>
					<div class="controls">
						<input name="quiz_id" type="text" placeholder="Quiz ID" value="<?php echo !empty($qid)?$qid:'';?>">
						<?php if (!empty($ques_nameError)): ?>
							<span class="help-inline"><?php echo $quiz_idError;?></span>
=======
			<form class="form-horizontal" action="qm_ques_create.php" method="post">
			
				<div class="control-group <?php echo !empty($idError)?'error':'';?>">
					<label class="control-label">Question ID</label>
					<div class="controls">
						<input name="id" type="text"  placeholder="ID" value="<?php echo !empty($id)?$id:'';?>">
						<?php if (!empty($idError)): ?>
							<span class="help-inline"><?php echo $idError;?></span>
						<?php endif; ?>
					</div>
				</div>
			  
				<div class="control-group <?php echo !empty($quiz_nameError)?'error':'';?>">
					<label class="control-label">Quiz ID</label>
					<div class="controls">
						<input name="quiz_id" type="text" placeholder="Quiz ID" value="<?php echo !empty($qid)?$qid:'';?>">
						<?php if (!empty($quiz_nameError)): ?>
							<span class="help-inline"><?php echo $quiz_nameError;?></span>
>>>>>>> 07fd39b125319fa2002aa09ac38dbc414b4c769c
						<?php endif;?>
					</div>
				</div>
				
<<<<<<< HEAD
				<div class="control-group <?php echo !empty($quiz_nameError)?'error':'';?>">
					<label class="control-label">Question Name</label>
					<div class="controls">
						<input name="ques_name" type="text" placeholder="Question Name" value="<?php echo !empty($qName)?$qName:'';?>">
						<?php if (!empty($quiz_nameError)): ?>
							<span class="help-inline"><?php echo $quiz_nameError;?></span>
=======
				<div class="control-group <?php echo !empty($ques_nameError)?'error':'';?>">
					<label class="control-label">Question Name</label>
					<div class="controls">
						<input name="ques_name" type="text" placeholder="Question Name" value="<?php echo !empty($qName)?$qName:'';?>">
						<?php if (!empty($ques_nameError)): ?>
							<span class="help-inline"><?php echo $ques_nameError;?></span>
>>>>>>> 07fd39b125319fa2002aa09ac38dbc414b4c769c
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