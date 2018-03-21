<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_quiz_create.php
 * author      : Nathan Gaffney, gaffney.nathan@svsu.edu
 * description : This php file will create a new quiz (table: qm_quiz)
 * Schema:
 * id   [auto incremented]
 * per_id
 * quiz_name
 * quiz_description
 * ---------------------------------------------------------------------------
 * 
 */
include 'session.php';
require '/home/gpcorser/public_html/database/database.php';
include '/home/gpcorser/public_html/database/header.php'; //html <head> section
if ( !empty($_POST)) { // if not first time through
	session_start();
	// initialize user input validation variables
	$quiz_nameError = null;
	$quiz_descriptionError = null;
	
	// initialize $_POST variables
	$per_id = $_SESSION['per_id'];
	$qName = $_POST['quiz_name'];
	$description = $_POST['quiz_description'];		
	$valid = true;
	// validate user input 		
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
		$sql = "INSERT INTO qm_quizzes (per_id, quiz_name, quiz_description) values(?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($per_id,$qName,$description));
		Database::disconnect();
		header("Location: qm_quiz_list.php?per_id=" . $per_id);	
	}
}
//include '../../database/header.php'; //html <head> section

?>
<body style="background-color: lightblue !important";>
    <div class="container">
		<div class="span10 offset1">
		
			<div class="row">
				<h3>Add New Quiz</h3>
			</div>
	
			<form class="form-horizontal" action="qm_quiz_create.php" method="post">
				
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
					<a class="btn" href="qm_quiz_list.php?per_id=<?php echo $_SESSION['per_id']; ?>">Back</a>
				</div>
				
			</form>
			
		</div> <!-- div: class="container" -->
				
    </div> <!-- div: class="container" -->
	
</body>
</html>