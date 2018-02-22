<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_quiz_update.php
 * author      : Todd Lovas III - tslovas
 * ---------------------------------------------------------------------------
 */
// session_start();
// if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
	// session_destroy();
	// header('Location: login.php');     // go to login page
	// exit;
// }
	
require '/home/gpcorser/public_html/database/database.php';
$id = $_GET['id'];
if ( !empty($_POST)) { // if $_POST filled then process the form
	# initialize/validate (same as file: fr_per_create.php)
	// initialize user input validation variables
	$quiz_idError = null;
	$ques_nameError = null;
	$ques_textError = null;
	
	
	// initialize $_POST variables
	$quiz_id = $_POST['quiz_id'];
	$ques_name = $_POST['ques_name'];
	$ques_text = $_POST['ques_text'];
	
	//
	// initialize $_FILES variables
	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];
	$content = file_get_contents($tmpName);
	// validate user input
	$valid = true;
	if (empty($quiz_name)) {
		$quiz_idError = 'Please enter Quiz ID';
		$valid = false;
	}
	if (empty($qm_persons)) {
		$ques_nameError = 'Please enter Question Name';
		$valid = false;
	}

	
	// restrict file types for upload
	
	if ($valid) { // if valid user input update the database
	
		if($fileSize > 0) { // if file was updated, update all fields
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE qm_quizzes  set quiz_id = ?, ques_name = ?, ques_text = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($quiz_name, $qm_persons, $ques_text, $id));
			Database::disconnect();
			header("Location: qm_ques_list.php");
		}
		else { // otherwise, update all fields EXCEPT file fields
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE qm_quizzes  set quiz_id = ?, ques_name = ?, ques_text = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($quiz_name, $qm_persons, $ques_text, $id));
			Database::disconnect();
			header("Location: qm_ques_list.php");
		}
	}
} else { // if $_POST NOT filled then pre-populate the form
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM qm_questions where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$quiz_name = $data['quiz_name'];
	$qm_persons = $data['qm_persons'];
	$ques_text = $data['ques_text'];
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

<body style="background-color: lightblue !important";>
    <div class="container">

		<div class="span10 offset1">

		
			<div class="row">
				<h3>Update Quizzes</h3>
			</div>
	
			<form class="form-horizontal" action="qm_ques_update.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
			
				

				<div class="control-group <?php echo !empty($quiz_idError)?'error':'';?>">
					<label class="control-label"><h6>Quiz ID</h6></label>
					<div class="controls">
						<input style="background-color: lightgrey !important; width: 40%;" name="quiz_id" type="text"  placeholder="Quiz ID" value="<?php echo !empty($quiz_id)?$quiz_id:'';?>">
						<?php if (!empty($quiz_idError)): ?>
							<span class="help-inline"><?php echo $quiz_idError;?></span>
						<?php endif; ?>
						
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($ques_name)?'error':'';?>">
					<label class="control-label"><h6>Quiz Name</h6></label>
					<div class="controls">
						<input style="background-color: lightgrey !important; width: 40%;" name="ques_name" type="text"  placeholder="Quiz Name" value="<?php echo !empty($ques_name)?$ques_name:'';?>">
						<?php if (!empty($ques_nameError)): ?>
							<span class="help-inline"><?php echo $ques_nameError;?></span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($ques_textError)?'error':'';?>">
					<label class="control-label"><h6>Quiz Text</h6></label>
					<div class="controls">
						<input style="background-color: lightgrey !important; width: 40%;" name="ques_text" type="text" placeholder="Quiz Text" value="<?php echo !empty($ques_text)?$ques_text:'';?>">
						<?php if (!empty($ques_textError)): ?>
							<span class="help-inline"><?php echo $ques_textError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<br />
				
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Update</button>
					<a class="btn btn-primary" href="qm_ques_list.php">Back</a>
				</div>
				
			</form>
			
				
				
		</div><!-- end div: class="span10 offset1" -->
		
    </div> <!-- end div: class="container" -->
	
</body>
</html>