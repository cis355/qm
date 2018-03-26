<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_qa_read.php
 * author      : Ryan Ott, raott@svsu.edu
 * description : This program displays the quiz attempt from a person
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

include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';
<<<<<<< HEAD
 ?>
 <body style="background-color: lightblue !important";>
     <div class="container">
       <h3>Attempt</h3>
       <?php
          $pdo = Database::connect();
          $attempt_id = $_GET['attempt_id'];
          
       ?>
     </div>
   </body>
=======
session_start();
/*if(!isset($_SESSION['per_id'])){
	session_destroy();
	header('Location: login.php');
	exit;
}*/

$id = $_GET['attempt_id'];
$per_id = $_SESSION['per_id'];
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM qm_attempts where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">

	<body style="background-color: lightblue !important";>
		<div class="container">
			
			<div class="row">
				<h3>Attempt</h3>
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
					
					<label class="control-label"><b>Quiz Attempt Score</b></label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['qa_score'];?>
						</label>
					</div>
					
					<label class="control-label"><b>Date Started</b></label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['qa_start_date'];?>
						</label>
					</div>  

					<label class="control-label"><b>Date Ended</b></label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['qa_end_date'];?>
						</label>
					</div>
					
					<label class="control-label"><b>Time Started</b></label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['qa_start_time'];?>
						</label>
					</div>
					
					<label class="control-label"><b>Time Ended</b></label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['qa_end_time'];?>
						</label>
					</div>
					
					<div class="form-actions">
						<a class="btn btn-success" href="qm_qa_list.php?per_id=<?php echo $_SESSION['per_id'];?>">Back</a>
					</div>
				
			</div>  <!-- end div: class="form-horizontal" 

		</div> <!-- end div: class="container" -->
		
		<p>Ryan Ott - raott</p>
		
	</body> 
	
</html>
>>>>>>> cf616e2da1cd47a0107e80387ef280d64c851148
