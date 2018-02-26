<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_qa_list_read.php
 * author      : Cecilia Hentkowski, cehentko@svsu.edu
 * description : This program displays data pertaining to a quiz taken
 * ---------------------------------------------------------------------------
 */

include 'home/gpcorser/public_html/database/database.php';
require '/home/gpcorser/public_html/database/database.php';

$id = $_GET['id'];

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
		<link   href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		
	</head>

	<body>
    <div class="container">
            <div class="row">
                <h2>Quiz Attemps</h2>
                </br>
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
					
					<label class="control-label">Score</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['qa_score'];?>
						</label>
					</div>
					
					<label class="control-label">Start Date</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['qa_start_date'];?>
						</label>
					</div>     
					
					<label class="control-label">End Date</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['qa_end_date'];?>
						</label>
					</div>   
					
					<label class="control-label">Start Time</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['qa_start_time'];?>
						</label>
					</div> 

					<label class="control-label">End Time</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['qa_end_time'];?>
						</label>
					</div> 

					<div class="form-actions">
						<a class="btn" href="qm_qa_list.php">Back</a>
					</div>
				
			</div> 
                  <tbody>
                  <?php
                   include '/home/gpcorser/public_html/database/database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM qm_persons ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
							echo '<td>'. $row['quiz_id'] . '</td>';
                            echo '<td>'. $row['qa_score'] . '</td>';
                            echo '<td>'. $row['qa_start_date'] . '</td>';
                            echo '<td>'. $row['qa_end_date'] . '</td>';
							echo '<td>'. $row['qa_start_time'] . '</td>';
							echo '<td>'. $row['qa_end_time'] . '</td>';
                            echo '<td><a class="btn" href="qm_qa_list_read.php?id='.$row['id'].'">Read</a></td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>                  
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body> 
	
</html>