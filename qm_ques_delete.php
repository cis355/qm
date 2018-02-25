<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_ques_delete.php
 * author      : mimajumd
 * description : 
 * ---------------------------------------------------------------------------
 *
session_start();
if(!isset($_SESSION["qm_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
*/
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';
$id = $_GET['id'];
if ( !empty($_POST)) { // if user clicks "yes" (sure to delete), delete record
	$id = $_POST['id'];
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM qm_questions  WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	Database::disconnect();
	header("Location: qm_ques_list.php");
	
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
				<thead>
					<tr>
						<th>Question ID</th>
						<th>Question Name</th>
						<th>Question Text</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $data['quiz_id'];?></td>
						<td><?php echo $data['ques_name'];?></td>
						<td><?php echo $data['ques_text'];?></td>
						<td>
						<form class="form-horizontal" action="qm_ques_delete.php" method="post">
							<input type="hidden" name="id" value="<?php echo $id;?>"/>
							<p class="alert alert-error">Are you sure you want to delete?</p>
							<div class="form-actions">
								<button type="submit" class="btn btn-success">Yes</button>
								<a class="btn btn-danger" href="qm_ques_list.php">No</a>
							</div>
						</form></td>
						
					</tr>
					
					
				</tbody>
		</table>
				
				
				

</body>
</html>