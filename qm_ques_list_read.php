<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_ques_list_read.php
 * author      : Wyatt Towne, wmtowne@svsu.edu
 * description : This program displays the question list for a quiz
 * ---------------------------------------------------------------------------
 */
/*session_start();

if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
*/
//include 'home/gpcorser/public_html/database/database.php';    //home/gpcorser/public_html/databasePHP/

require '/home/gpcorser/public_html/database/database.php';
//require 'functions.php';
$id = $_GET['id'];
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM qm_questions WHERE id = " . $_GET['id'];
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
		<!--<link rel="icon" href="cardinal_logo.png" type="image/png" />-->
	</head>

	<body style="background-color: lightblue !important";>
		<div class="container">
			
			<div class="row">
				<h3>Question List</h3>
			</div>
			 
			<div class="form-horizontal" >
				
				<div class="control-group col-md-6">
				
					<label class="control-label"><b>ID</b></label>
					<div class="controls ">
						<label class="checkbox">
							<?php echo $data['id'];?> 
						</label>
					</div>
					
					<label class="control-label"><b>Quiz ID</b></label>
					<div class="controls ">
						<label class="checkbox">
							<?php echo $data['quiz_id'];?> 
						</label>
					</div>
					
					<label class="control-label"><b>Question Name</b></label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['ques_name'];?>
						</label>
					</div>
					
					<label class="control-label"><b>Question Text</b></label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['ques_text'];?>
						</label>
					</div>     
					
					<div class="form-actions">
						<a class="btn" href="qm_ques_list.php">Back</a>
					</div>
				
			</div>  <!-- end div: class="form-horizontal" 

		</div> <!-- end div: class="container" -->
		
		<p>Wyatt Towne - wmtowne</p>
		
	</body> 
	
</html>
