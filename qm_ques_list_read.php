<?php 
/* ---------------------------------------------------------------------------
 * filename    : fr_per_read.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program displays one volunteer's details (table: fr_persons)
 * ---------------------------------------------------------------------------
 */
/*session_start();

if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
*/
include 'home/gpcorser/public_html/database/database.php';

require '../../database/database.php';
require 'functions.php';
$id = $_GET['id'];
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM qm_questions";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link   href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<link rel="icon" href="cardinal_logo.png" type="image/png" />
	</head>

	<body>
		<div class="container">
			<?php
				Functions::logoDisplay2();
			?>
			<div class="row">
				<h3>Question List</h3>
			</div>
			 
			<div class="form-horizontal" >
				
				<div class="control-group col-md-6">
				
					<label class="control-label">ID</label>
					<div class="controls ">
						<label class="checkbox">
							<?php echo $data['id'];?> 
						</label>
					</div>
					
					<label class="control-label">Quiz ID</label>
					<div class="controls ">
						<label class="checkbox">
							<?php echo $data['quiz_id'];?> 
						</label>
					</div>
					
					<label class="control-label">Qestion Name</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['ques_name'];?>
						</label>
					</div>
					
					<label class="control-label">Question Text</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['ques_text'];?>
						</label>
					</div>     
					
					
				
			</div>  <!-- end div: class="form-horizontal" 

		</div> <!-- end div: class="container" -->
		
	</body> 
	
</html>