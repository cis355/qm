<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_options_update.php
 * author      : Andrew Petricevic, ampetric@svsu.edu
 * description : This program updates an option (table: qm_options)
 * ---------------------------------------------------------------------------
 */
 include  '../../database/header.php'; // html <head> section 
require '/home/gpcorser/public_html/database/database.php';
$id = $_GET['id'];
if ( !empty($_POST)) { // if $_POST filled then process the form
	
	# same as create
	// initialize user input validation variables
	$idError = null;
	$ques_idError = null;
	$option_textError = null;
	$option_isCorrectError = null;
	
	// initialize $_POST variables
	$id = $_POST['id'];    // same as HTML name= attribute in put box
	$ques_id = $_POST['ques_id'];
	$option_text = $_POST['option_text'];
	$option_isCorrect = $_POST['option_isCorrect'];
	
	/* // initialize $_FILES variables
	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];
	$content = file_get_contents($tmpName); */
	
	// validate user input
	$valid = true;
	if (empty($id)) {
		$idError = 'Please choose a volunteer';
		$valid = false;
	}
	if (empty($ques_id)) {
		$ques_idError = 'Please choose an ques_id';
		$valid = false;
	} 
	if (empty($option_text)) {
		$option_textError = 'Please choose an option_text';
		$valid = false;
	} 
	if (empty($option_isCorrect)) {
		$option_isCorrectError = 'Please choose an option_isCorrect';
		$valid = false;
	} 
		
	if ($valid) { // if valid user input update the database
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE qm_options set ques_id = ?, option_text = ?, option_isCorrect = ? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($ques_id,$option_text,$option_isCorrect, $id));
		Database::disconnect();
		header("Location: qm_options_update.php");
	}
} else { // if $_POST NOT filled then pre-populate the form
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM qm_options where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	
	$ques_id = $data['ques_id'];
	$option_text = $data['option_text'];
	$option_isCorrect = $data['option_isCorrect'];
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
				<h3>Update Options</h3>
			</div>
	
			<form class="form-horizontal" action="qm_ques_update.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
			
				

				<div class="control-group <?php echo !empty($ques_idError)?'error':'';?>">
					<label class="control-label">Ques ID</label>
					<div class="controls">
						<input name="ques_id" type="text"  placeholder="Ques ID" value="<?php echo !empty($ques_id)?$ques_id:'';?>">
						<?php if (!empty($ques_idError)): ?>
							<span class="help-inline"><?php echo $ques_idError;?></span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($option_text)?'error':'';?>">
					<label class="control-label">Option Text</label>
					<div class="controls">
						<input name="option_text" type="text"  placeholder="Option Text" value="<?php echo !empty($option_text)?$option_text:'';?>">
						<?php if (!empty($option_textError)): ?>
							<span class="help-inline"><?php echo $option_textError;?></span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($ques_textError)?'error':'';?>"><br>
					<label class="control-label">Option Is Correct?</label>
					<div class="controls">
						<div class="controls">
						  <input type="checkbox" name="option_isCorrect" value="true"> Is Correct Answer<br>
						</div>
						
							
						
					</div>
				</div>
				
				
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Update</button>
					<a class="btn btn-secondary" href="qm_option_list.php">Back</a>
				</div>
				
			</form>
			
				
				
		</div><!-- end div: class="span10 offset1" -->
		
    </div> <!-- end div: class="container" -->
	
</body>
</html>