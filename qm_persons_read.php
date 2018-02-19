<?php 
/* ---------------------------------------------------------------------------
 * filename    : fr_per_read.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program displays one volunteer's details (table: fr_persons)
 * ---------------------------------------------------------------------------
 */
 
 /*
  session_start();
  if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
  	session_destroy();
  	header('Location: login.php');     // go to login page
  	exit;
  }

*/

require '../../database/database.php';


$id = $_GET['id'];

$id = 1;

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM qm_persons where id = ?";
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
		
	</head>

	<body>
		<div class="container">
			
      echo "This is working";
      
			<div class="row">
				<h3>View Student Details</h3>
			</div>
			 
			<div class="form-horizontal" >
				
				<div class="control-group col-md-6">
				
					<label class="control-label">First Name</label>
					<div class="controls ">
						<label class="checkbox">
							<?php echo $data['fname'];?> 
						</label>
					</div>
					
					<label class="control-label">Last Name</label>
					<div class="controls ">
						<label class="checkbox">
							<?php echo $data['lname'];?> 
						</label>
					</div>
					
					<label class="control-label">Email</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['email'];?>
						</label>
					</div>
					
					
					<!-- password omitted on Read/View -->
					
					<div class="form-actions">
						<a class="btn" href="fr_persons.php">Back</a>
					</div>
					
				</div>
				
				
				
				<div class="row">
					<h4>Quizzes for which this Volunteer has been assigned</h4>
				</div>
				
        
			</div>  <!-- end div: class="form-horizontal" -->

		</div> <!-- end div: class="container" -->
		
	</body> 
	
</html>
