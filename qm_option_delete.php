<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_option_delete.php
 * author      : Robert Zinger
 * description : This program deletes one option thats selected
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

include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';
/*
$id = $_GET['id'];
if ( !empty($_POST)) { // if user clicks "yes" (sure to delete), delete record
	$id = $_POST['id'];
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM qm_option  WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	Database::disconnect();
	header("Location: qm_option_list.php");
	
} 
else { // otherwise, pre-populate fields to show data to be deleted
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM qm_option where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}
*/

if ( !empty($_GET['id'])) {
	$id = $_REQUEST['id'];
	}
	if ( !empty($_POST)) {
		$id = $_POST['id'];
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM qm_options WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		/*header("Location: index.php"); */
		}
?>


<body>
    <div class="container">

		<div class="span10 offset1">
		
			<div class="row">
				<h3>Delete Option</h3>
			</div>
			
			<form class="form-horizontal" action="qm_option_list.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id;?>"/>
				<p class="alert alert-error">Are you sure you want to delete ?</p>
				<div class="form-actions">
					<button type="submit" class="btn btn-danger">Yes</button>
					<a class="btn" href="qm_option_list.php">No</a>
				</div>
			</form>
			
			<!-- Display same information as in file: fr_event_read.php -->
			
			<div class="form-horizontal" >
			
				<div class="control-group">
					<label class="control-label">ID</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $id;?>
						</label>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Question ID</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $quest_id;?>
						</label>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Option Text</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $option_text;?>
						</label>
					</div>
				</div>

				
			<!--<div class="row">
				<h4>Volunteers Assigned to This Shift</h4>
			</div>
			-->
			<?php
			/*
				$pdo = Database::connect();
				$sql = "SELECT * FROM fr_assignments, fr_persons WHERE assign_per_id = fr_persons.id AND assign_event_id = " . $data['id'] . ' ORDER BY lname ASC, fname ASC';
				$countrows = 0;
				foreach ($pdo->query($sql) as $row) {
					echo $row['lname'] . ', ' . $row['fname'] . ' - ' . $row['mobile'] . '<br />';
					$countrows++;
				}
				if ($countrows == 0) echo 'none.';
				*/
			?>
			
			</div> <!-- end div: class="form-horizontal" -->
			
		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->
  </body>
</html>