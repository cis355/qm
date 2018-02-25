<?php 
/* -----------------------------------------------------------------------------------------------------------
 * filename    : qm_option_delete.php
 * author      : Robert Zinger, rjzinger@svsu.edu. Derived from George Corser's fr_assign_delete.php
 * description : This program deletes one option thats selected
 * -----------------------------------------------------------------------------------------------------------
 */
 
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';

$id = $_GET['id'];

	$ques_id = $_POST['ques_id'];
	$opt_text = $_POST['opt_text'];

if ( !empty($_POST)) { // if user clicks "yes" (sure to delete), delete record
	$id = $_POST['id'];
	
	// delete data
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM qm_options  WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	Database::disconnect();
	header("Location: qm_options.php");
} 
else { // otherwise, pre-populate fields to show data to be deleted
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	# get option details
	$sql = "SELECT * FROM qm_options where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	
	$ques_id = $data['ques_id'];
	$opt_text = $data['opt_text'];
	
	Database::disconnect();
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
			
			<!-- Display same information as in file: qm_option_list.php -->
			
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
							<?php echo $ques_id;?>
						</label>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Option Text</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $opt_text;?>
						</label>
					</div>
				</div>
			
			</div> <!-- end div: class="form-horizontal" -->
			
		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->
  </body>
</html>