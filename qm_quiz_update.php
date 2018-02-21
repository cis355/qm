<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_quiz_update.php
 * author      : Todd Lovas III - tslovas
 * description : code for updating a quiz
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
	$quiz_nameError = null;
	$quiz_textError = null;
	
	
	// initialize $_POST variables
	$quiz_id = $_POST['quiz_id'];
	$quiz_name = $_POST['quiz_name'];
	$quiz_text = $_POST['quiz_text'];
	
	//
	// initialize $_FILES variables
	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];
	$content = file_get_contents($tmpName);
	// validate user input
	$valid = true;
	if (empty($quiz_id)) {
		$quiz_idError = 'Please enter Quiz ID';
		$valid = false;
	}
	if (empty($quiz_name)) {
		$quiz_nameError = 'Please enter Quiz Name';
		$valid = false;
	}
	if (empty($quiz_text)) {
		$quiz_textError = 'Please enter Quiz text';
		$valid = false;
	} 
	
	// restrict file types for upload
	
	if ($valid) { // if valid user input update the database
	
		if($fileSize > 0) { // if file was updated, update all fields
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE qm_quiz  set quiz_id = ?, quiz_name = ?, quiz_text = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($quiz_id, $quiz_name, $quiz_text, $id));
			Database::disconnect();
			header("Location: qm_quiz_list.php");
		}
		else { // otherwise, update all fields EXCEPT file fields
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE qm_quiz  set quiz_id = ?, quiz_name = ?, quiz_text = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($quiz_id, $quiz_name, $quiz_text, $id));
			Database::disconnect();
			header("Location: qm_quiz_list.php");
		}
	}
} else { // if $_POST NOT filled then pre-populate the form
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM qm_quiz where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$quiz_id = $data['quiz_id'];
	$quiz_name = $data['quiz_name'];
	$quiz_text = $data['quiz_text'];
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

<body>
    <div class="container">

		<div class="span10 offset1">

		
			<div class="row">
				<h3>Update Quiz</h3>
			</div>
	
			<form class="form-horizontal" action="qm_quiz_update.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
			
				

				<div class="control-group <?php echo !empty($quiz_idError)?'error':'';?>">
					<label class="control-label">Quiz ID</label>
					<div class="controls">
						<input name="quiz_id" type="text"  placeholder="Quiz ID" value="<?php echo !empty($quiz_id)?$quiz_id:'';?>">
						<?php if (!empty($quiz_idError)): ?>
							<span class="help-inline"><?php echo $quiz_idError;?></span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($quiz_name)?'error':'';?>">
					<label class="control-label">Quiz Name</label>
					<div class="controls">
						<input name="quiz_name" type="text"  placeholder="Quiz Name" value="<?php echo !empty($quiz_name)?$quiz_name:'';?>">
						<?php if (!empty($quiz_nameError)): ?>
							<span class="help-inline"><?php echo $quiz_nameError;?></span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($quiz_textError)?'error':'';?>">
					<label class="control-label">Quiz Text</label>
					<div class="controls">
						<input name="quiz_text" type="text" placeholder="Quiz Text" value="<?php echo !empty($quiz_text)?$quiz_text:'';?>">
						<?php if (!empty($quiz_textError)): ?>
							<span class="help-inline"><?php echo $quiz_textError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Update</button>
					<a class="btn btn-secondary" href="qm_quiz_list.php">Back</a>
				</div>
				
			</form>
			
				
				
		</div><!-- end div: class="span10 offset1" -->
		
    </div> <!-- end div: class="container" -->
	
</body>
</html>