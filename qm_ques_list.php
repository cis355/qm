<html>
<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_ques_list.php
 * author      : Cody Frost, clfrost
 * description : Question list
 * ---------------------------------------------------------------------------
 */

include 'session.php';
include '/home/gpcorser/public_html/database/header.php';
 $_SESSION['quiz_id'] = $_GET['quiz_id'];
?>

<body style="background-color: lightblue !important";>
    <div class="container">
		<div class="row">
			<h3>Question List</h3>
		</div>
		<div class="row">
			<p>
				<a href="qm_ques_create.php" class="btn btn-primary">Add Question</a>

			</p>
				
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>Question</th>
						<th>Quiz Number</th>
						<th>Question Name</th>
						<th>Question Text</th>
						<th>Question Actions</th>
						<th>Question Options</th>
						<th>Question Comments</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						include '/home/gpcorser/public_html/database/database.php';
						$pdo = Database::connect();
						$sql = 'SELECT * FROM qm_questions WHERE quiz_id=' . $_GET['quiz_id'] .' AND NOT archive_flag = 1' ;
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. trim($row['id']) . '</td>';
							echo '<td>'. trim($row['quiz_id']) . '</td>';
							echo '<td>'. trim($row['ques_name']) . '</td>';
							echo '<td>'. trim($row['ques_text']) . '</td>';
							echo '<td width=245>';
								
							    echo '<a class="btn btn-primary" href="qm_ques_list_read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="qm_ques_update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="qm_ques_delete.php?id='.$row['id'].'">Delete</a>';
                            echo '</td>';
							
							
							echo '<td>';
								echo '<a class="btn" href="qm_option_list.php?ques_id='.$row['id'] .'">Question Options</a>';
							echo '</td>';
							echo '<td>';
								echo '<a class="btn" href="qm_comments.php?ques_id=' . $row['id'] .'">Question Comments</a>';
                            echo '</td>';
							
							echo '</tr>';
								
						}
						
						Database::disconnect();
					?>
				</tbody>
			</table>
			<br /><p>Cody Frost, clfrost@svsu.edu</p>
    	</div>
    </div> <!-- /container -->
	
  </body>
</html>