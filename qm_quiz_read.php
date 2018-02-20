<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_Quizzes_read.php
 * author      : Christine Torres, cmtorre1@svsu.edu
 * description : This program displays one assignment's details (table: fr_assignments)
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
# get quiz ids
$sql = "SELECT * FROM qm_quizzes where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($data['id']));
$quiz_id_data = $q->fetch(PDO::FETCH_ASSOC);

# get person id
$sql = "SELECT * FROM qm_persons where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($data['per_id']));
$per_id_data = $q->fetch(PDO::FETCH_ASSOC);

# get quiz name
$sql = "SELECT * FROM qm_quizzes where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($data['quiz_name']));
$quiz_name_data = $q->fetch(PDO::FETCH_ASSOC);

# get quiz description
$sql = "SELECT * FROM qm_quizzes where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($data['quiz_description']));
$quiz_description_data = $q->fetch(PDO::FETCH_ASSOC);


Database::disconnect();

//include '../../database/header.php'; //html <head> section
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <div class="container">
    		<?php 
			//gets logo
			//functions::logoDisplay();
		?>
		<div class="span10 offset1">
	
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
				
			</div> <!-- end div: class="form-horizontal" -->
			
		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->
	
</body>
</html>
