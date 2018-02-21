<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_ques_list.php
 * author      : clfrost
 * description : Question list
 * ---------------------------------------------------------------------------
 */
 /*
session_start();
if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
$sessionid = $_SESSION['fr_person_id'];
*/
include '/home/gpcorser/public_html/database/header.php';
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
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						include '/home/gpcorser/public_html/database/database.php';
						$pdo = Database::connect();
						$sql = 'SELECT * FROM qm_questions ORDER BY quiz_id';
						// $sql = 'SELECT * FROM qm_questions WHERE quiz_id = ' . $_GET['quiz_id'];
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. trim($row['id']) . '</td>';
							echo '<td>'. trim($row['quiz_id']) . '</td>';
							echo '<td>'. trim($row['ques_name']) . '</td>';
							echo '<td>'. trim($row['ques_text']) . '</td>';
							echo '<td width=250>';
							    echo '<a class="btn" href="qm_ques_list_read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="qm_ques_update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="qm_ques_delete.php?id='.$row['id'].'">Delete</a>';
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