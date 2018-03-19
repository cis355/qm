<?php 
/* ---------------------------------------------------------------------------
 * filename    : fr_ques_list2.php
 * author      : nmccarth, <echo "bm1jY2FydGggW2F0XSBzdnN1IFtkb3RdIGVkdQo=" | base64 -d>
 * description : This program displays a list of questions (table: fr_questions)
 * definition  : A question has the quiz it is a part of, name, and the text
 *			of the question.
 * ---------------------------------------------------------------------------
 */

include 'session.php';

include '/home/gpcorser/public_html/database/header.php'; // Add html header
?>


<body style="background-color: lightblue !important">
	<div class="container">
		<div class="row">
			<h3>Questions List</h3>
			</br>
		</div>
		<div class="row">
			<p>
				<a href="qm_ques_create.php" class="btn btn-primary">Add Question</a>
			</p>
		<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>ID</th>
						<th>Quiz ID</th>
						<th>Quiz Name</th>
						<th>Name</th>
						<th>Text</th>
					</tr>
				</thead>
				<tbody>
<?php 
	include '/home/gpcorser/public_html/database/database.php';
$pdo = Database::connect();

$sql = "SELECT qs.*, qz.* FROM qm_questions qs, qm_quizzes qz WHERE qs.quiz_id = qz.id AND qz.id =" .
	$_GET['quiz_id'];
foreach ($pdo->query($sql) as $row) {
	echo '<tr>';
	echo '<td>'. $row['id'] . '</td>';
	echo '<td>'. $row['quiz_id'] . '</td>';
	echo '<td>'. $row['quiz_name'] . '</td>';
	echo '<td>'. $row['ques_name'] . '</td>';
	echo '<td>'. $row['ques_text'] . '</td>';
	echo '<td width=270>';
	# use $row[0] because there are 3 fields called "id"
	echo '<a class="btn btn-primary" href="qm_ques_read.php?id='.$row[0].'">Details</a>';
	/*if ($_SESSION['qm_person_title']=='Administrator' )*/
	echo '&nbsp;<a class="btn btn-success" href="qm_ques_update.php?id='.$row[0].'">Update</a>';
						/*if ($_SESSION['qm_person_title']=='Administrator' 
						|| $_SESSION['qm_person_id']==$row['quiz_per_id'])*/
	echo '&nbsp;<a class="btn btn-danger" href="qm_ques_delete.php?id='.$row[0].'">Delete</a>';
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
	<footer class="footer bg-dark text-center pt-1 mt-1 pb-1 fixed-bottom">
		<div class="container">
			<span class="text-light">nmccarth</span>
		</div>
	</footer>

</body>
</html>
