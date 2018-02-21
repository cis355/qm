<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_Quizzes_read.php
 * author      : Christine Torres, cmtorre1@svsu.edu
 * description : This program displays the read page for quiz database 
 *               (table: qm_quizes, qm_persons)
 * ---------------------------------------------------------------------------
 */
 
/*session_start();
if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}*/

require '/home/gpcorser/public_html/database/database.php';
//require 'functions.php';
$id = $_GET['id'];
$pdo = Database::connect();

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
# get quiz ids, 
$sql = "SELECT * FROM qm_quizzes where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($quizdata['id']));
$quizdata = $q->fetch(PDO::FETCH_ASSOC);

# get person id
$sql = "SELECT * FROM qm_persons where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($quizdata['per_id']));
$quizdata = $q->fetch(PDO::FETCH_ASSOC);

# get quiz name
$sql = "SELECT * FROM qm_quizzes where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($quizdata['quiz_name']));
$quizdata = $q->fetch(PDO::FETCH_ASSOC);

# get quiz description
$sql = "SELECT * FROM qm_quizzes where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($quizdata['quiz_description']));
$quizdata = $q->fetch(PDO::FETCH_ASSOC);


Database::disconnect();

include '/home/~gpcorser/public_html/database/database/header.php'; //html <head> section
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!--<meta charset="utf-8">
	//<link   href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
   // <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
-->
   </head>
<body>
    <div class="container">

    	<?php 
			//gets logo
			//functions::logoDisplay();
		?>
		<div class="span10 offset1">
		    <div class="row">
                <h2>Read a Quiz </h2>
                </br>
				</div>
			<div class="form-horizontal" >
			
				<div class="control-group">
					<label class="control-label">Quiz ID</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $quizdata['id'] ;?>
						</label>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Person's ID</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $quizdata['per_id'] ;?>
						</label>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Quiz Name</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo trim($quizdata['quiz_name']);?>
						</label>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Quiz Description</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo ($quizdata['quiz_description']);?>
						</label>
					</div>
				</div>
				    <div class="form-actions">
						  <a class="btn" href="qm_quiz_list.php">Back</a>
				    </div>
			</div> <!-- end div: class="form-horizontal" -->
				
		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->
	
</body>
</html>
