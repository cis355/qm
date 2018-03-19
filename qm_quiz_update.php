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
	$ques_name = $_POST['qm_persons'];
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
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body style="background-color: lightblue !important";>
    <div class="container">

		<div class="span10 offset1">

		
			<div class="row">
				<h3>Update Quizzes</h3>
			</div>
	
			<form class="form-horizontal" action="qm_quiz_update.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
			
			
				
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
					<a class="btn btn-primary" href="qm_quiz_list.php">Back</a>
				</div>
				
			</form>
			
				
				
		</div><!-- end div: class="span10 offset1" -->
		
    </div> <!-- end div: class="container" -->
	
</body>
	 <footer>
  <p>Posted by: Todd Lovas III</p>
  <p>Contact information: <a href="mailto:tslovas@svsu.edu">
	tslovas@svsu.edu</a>.</p>
</footer> 
</html>