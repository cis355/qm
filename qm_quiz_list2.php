<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_quiz_list2.php
 * author      : Ryan Ott, raott@svsu.edu
 * description : This program displays a list of quizzes (table: qm_quizzes)
 * ---------------------------------------------------------------------------
 */
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
			<h3>Quiz List</h3>
		</div>
		<div class="row">
			<p>
					<a href="qm_quiz_create.php"<!--was: qm_per_create.php--> class="btn btn-primary">Create Quiz</a> <!--Ryan I (Nathan Gaffney) edited this portion  -->
			</p>
				
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>ID</th>
						<th>Quiz Name</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						include '../database/database.php';
						$pdo = Database::connect();
						$sql = 'SELECT * FROM qm_quizzes ORDER BY id DESC';
						
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['quiz_name'] . '</td>';
                            echo '<td>'. $row['email'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn" href="qm_quiz_read.php?id='.$row['id'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="qm_quiz_update.php?id='.$row['id'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="qm_quiz_delete.php?id='.$row['id'].'">Delete</a>';
                            echo '</td>';
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