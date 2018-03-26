<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_ques_delete.php
 * author      : mimajumd 
 * ---------------------------------------------------------------------------
 *
session_start();
if(!isset($_SESSION["qm_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
*/
include 'session.php';
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';
include 'session.php';
$id = $_GET['id'];
if ( !empty($_POST)) { // if user clicks "yes" (sure to delete), delete record
	$id = $_POST['id'];
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM qm_questions  WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	Database::disconnect();
	header("Location: qm_ques_list.php?quiz_id=" . $_SESSION['quiz_id']);
	
} 
else { // otherwise, pre-populate fields to show data to be deleted
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM qm_questions where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">

<body style ="background-color: lightblue !important";>
    <div class="container">
		<div class="row">
			<h3>Delete Questions</h3>
		</div>
	</div>
		<br>
		
		<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				
					
						<p>Question ID: <?php echo $data['quiz_id'];?></p>
						<p>Question Name: <?php echo $data['ques_name'];?></p>
						<p>Question Text: <?php echo $data['ques_text'];?></p>
						
					
				
				<tbody>
					<tr>
						
						<form class="form-horizontal" action="qm_ques_delete.php" method="post">
							<input type="hidden" name="id" value="<?php echo $id;?>"/>
							<p class="alert alert-error">Are you sure you want to delete?</p>
							<div class="form-actions">
								<button type="submit" class="btn btn-success">Yes</button>
								<a class="btn btn-danger" href="qm_ques_list.php?quiz_id=<?php echo $_SESSION['quiz_id'];?>">No</a>
							</div>
						</form></td>
						
					</tr>
					
					
				</tbody>
		</table>
				
				
		<p> Mazharul Majumder | mimajumd@svsu.edu</p>		

</body>
</html>