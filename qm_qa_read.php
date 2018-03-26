<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_qa_list_read.php
 * author      : Cecilia Hentkowski, cehentko@svsu.edu
 * description : This program displays data pertaining to a quiz taken
 * ---------------------------------------------------------------------------
 */
//include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: qm_qa_list.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM qm_qa where quiz_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link   href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body style="background-color: lightblue !important";>
    <div class="container">

		    <div class="row">
                <h3>Read a Quiz Attempt</h3>
			</div>
			
				<div class="control-group">
					<label class="control-label">ID:</label>
					<div class="controls">
						<?php echo $data['id'] ;?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Quiz ID:</label>
					<div class="controls">
						<?php echo $data['quiz_id'] ;?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Score:</label>
					<div class="controls">
						<?php echo ($data['qa_score']);?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Start Date:</label>
					<div class="controls">
						<?php echo ($data['qa_start_date']);?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">End Date:</label>
					<div class="controls">
						<?php echo ($data['qa_end_date']);?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Start Time:</label>
					<div class="controls">
						<?php echo ($data['qa_start_time']);?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">End Time:</label>
					<div class="controls">
						<?php echo ($data['qa_end_time']);?>
					</div>
				</div>
				
				<div class="form-actions">
					<a class="btn" href="qm_qa_list.php">Back</a>
				</div>
				
				<div><p>Made by: Cecilia Hentkowski, cehentko@svsu.edu</p></div>
		
    </div> 
</body>
</html>
