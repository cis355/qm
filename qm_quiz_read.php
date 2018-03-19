<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_quiz_read.php
 * author      : Christine Torres, cmtorre1@svsu.edu
 * description : This program displays the read page for quiz database 
 *               (table: qm_quizes, qm_persons)
 * ---------------------------------------------------------------------------
 */
    include 'session.php';
	include '/home/gpcorser/public_html/database/header.php'; //html <head> section
 	require '/home/gpcorser/public_html/database/database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: qm_quiz_list.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM qm_quizzes where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }

?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container">

		    <div class="row">
                <h3>Read a Quiz </h3>
				</div>
			
				<div class="control-group">
					<label class="control-label">Quiz ID: </label>
					<div class="controls">
						<?php echo $data['id'] ;?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Person's ID:</label>
					<div class="controls">
						<?php echo $data['per_id'] ;?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Quiz Name:</label>
					<div class="controls">
						<?php echo ($data['quiz_name']);?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Quiz Description:</label>
					<div class="controls">
						<?php echo ($data['quiz_description']);?>
					</div>
				</div>
				    <div class="form-actions">
						  <a class="btn" href="qm_quiz_list.php">Back</a>
				    </div>
		
    </div> <!-- end div: class="container" -->
	
	<br></br><br></br><br></br>
	Posted by: Christine Torres <br></br>
	Contact information: cmtorre1@svsu.edu
</body>
</html>
