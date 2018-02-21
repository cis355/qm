<?php 
/* ---------------------------------------------------------------------------
 * filename    : fr_ques_list2.php
 * author      : nmccarth, <echo "bm1jY2FydGggW2F0XSBzdnN1IFtkb3RdIGVkdQo=" | base64 -d>
 * description : This program displays a list of questions (table: fr_questions)
 * definition  : A question has the quiz it is a part of, name, and the text
 *			of the question.
 * ---------------------------------------------------------------------------
 */

/*
session_start();
if(!isset($_SESSION["qm_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');   // go to login page
	exit;
}
$id = $_GET['id']; 
$sessionid = $_SESSION['qm_person_id'];
 */
include '/home/gpcorser/public_html/database/header.php' // Add html header
?>


<body>
	<div class="container">
		<div class="row">
			<h3>Questions List</h3>
			</br>
		</div>
		<div class="row">
			<p>
				<!-- <a href="qm_quiz_create.php" class="btn btn-success">Create Quiz</a> -->
			</p>
		<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>ID</th>
						<th>Quiz</th>
						<th>Name</th>
						<th>Text</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					include '/home/gpcorser/public_html/database/database.php';
					$pdo = Database::connect();
					
					$sql = "SELECT qm_questions.*,qm_quizzes.quiz_name FROM qm_questions,qm_quizzes WHERE qm_questions.quiz_id = qm_quizzes.id";
					
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>'. $row['id'] . '</td>';
						echo '<td>'. $row['quiz_name'] . '</td>';
						echo '<td>'. $row['ques_name'] . '</td>';
						echo '<td>'. $row['ques_text'] . '</td>';
						echo '<td width=300>';
						# use $row[0] because there are 3 fields called "id"
						echo '<a class="btn btn-primary" href="qm_ques_read.php?id='.$row[0].'">Details</a>';
						/*if ($_SESSION['qm_person_title']=='Administrator' )*/
							echo '&nbsp;<a class="btn btn-success" href="qm_ques_update.php?id='.$row[0].'">Update</a>';
						/*if ($_SESSION['qm_person_title']=='Administrator' 
							|| $_SESSION['qm_person_id']==$row['quiz_per_id'])*/
							echo '&nbsp;<a class="btn btn-danger" href="fr_assign_delete.php?id='.$row[0].'">Delete</a>';
						/*if($_SESSION["fr_person_id"] == $row['assign_per_id']) 
							echo " &nbsp;&nbsp;Me";*/
						echo '</td>';
						echo '</tr>';
					}
					Database::disconnect();
					?>
				</tbody>
			</table>
	</div>

    </div> <!-- end div: class="container" -->

</body>
</html>
