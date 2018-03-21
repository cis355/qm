<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_options_update.php
 * author      : Andrew Petricevic, ampetric, ampetric@svsu.edu
 * description : This program updates an option (table: qm_options)
 * ---------------------------------------------------------------------------
 */
 include 'session.php';
 include  '/home/gpcorser/public_html/database/header.php'; // html <head> section 
require '/home/gpcorser/public_html/database/database.php';

$id = $_GET['id'];

if ( !empty($_POST)) { // if $_POST filled then process the form
	
	# same as create
	// initialize user input validation variables
	$ques_idError = null;
	$opt_textError = null;
	$opt_isCorrectError = null;
	
	// initialize $_POST variables
	//$id = $_POST['id'];    // same as HTML name= attribute in put box
	$ques_id = $_POST['ques_id'];
	$opt_text = $_POST['opt_text'];
	$opt_isCorrect = $_POST['opt_isCorrect'];
	
	 // initialize $_FILES variables
	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];
	$content = file_get_contents($tmpName); 
	
	// validate user input
	$valid = true;
	/* if (empty($id)) {
		$idError = 'Please choose a volunteer';
		$valid = false;
	} */
	if (empty($ques_id)) {
		$ques_idError = 'Please choose an ques_id';
		$valid = false;
	} 
	if (empty($opt_text)) {
		$opt_textError = 'Please choose an opt_text';
		$valid = false;
	} 
	
		
	if ($valid) { // if valid user input update the database
	
		if($fileSize > 0) { // if file was updated, update all fields
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE qm_options  set ques_id = ?, opt_text = ?, opt_isCorrect = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($ques_id, $opt_text, $opt_isCorrect, $id));
			Database::disconnect();
			header("Location: qm_option_list.php?ques_id=" . $_SESSION['ques_id']);
		}
		else { // otherwise, update all fields EXCEPT file fields
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE qm_options  set ques_id = ?, opt_text = ?, opt_isCorrect = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($ques_id, $opt_text, $opt_isCorrect, $id));
			Database::disconnect();
			header("Location: qm_option_list.php?ques_id=" . $ques_id);
		}
	}
} else { // if $_POST NOT filled then pre-populate the form
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM qm_options where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$ques_id = $data['ques_id'];
	$opt_text = $data['opt_text'];
	$opt_isCorrect = $data['opt_isCorrect'];
	Database::disconnect();
}
?>



<body>
    <div class="container">

		<div class="span10 offset1">

		
			<div class="row">
				<h3>Update Options</h3>
			</div>
	
			<form class="form-horizontal" action="qm_option_update.php?id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
			
				
				
				<div class="control-group <?php echo !empty($opt_textError)?'error':'';?>">
					<label class="control-label">Option Text</label>
					<div class="controls">
						<input name="opt_text" type="text"  placeholder="Option Text" value="<?php echo !empty($opt_text)?$opt_text:'';?>">
						<?php if (!empty($opt_textError)): ?>
							<span class="help-inline"><?php echo $opt_textError;?></span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($ques_textError)?'error':'';?>"><br>
					<label class="control-label">Option Is Correct?</label>
					<div class="controls">
						<div class="controls">
						  <input type="checkbox" name="opt_isCorrect" <?php if($opt_isCorrect == '0')echo 'value="false"'; else echo 'value="true" checked';?>> Is Correct Answer<br>
						</div>
						
							
						
					</div>
				</div>
				
				<!-- -->
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Update</button>
					<a class="btn btn-secondary" href="qm_option_list.php?ques_id=<?php echo $data['ques_id'];?>">Back</a>
				</div>
				
			</form>
			<br>
			<br>
			<span>Andrew Petricevic (ampetric)</span>
			
				
				
		</div><!-- end div: class="span10 offset1" -->
		
    </div> <!-- end div: class="container" -->
	
</body>
</html>