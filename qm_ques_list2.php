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
						<th>Question Name</th>
						<th>Text</th>
						<th>Operation</th>
					</tr>
				</thead>
				<tbody>
<?php 
	include '/home/gpcorser/public_html/database/database.php';
$pdo = Database::connect();

$sql = "SELECT * FROM qm_questions WHERE quiz_id = " . $_GET['quiz_id'];
foreach ($pdo->query($sql) as $row) {
	echo '<tr>';
	echo '<td>'. $row['id'] . '</td>';
	echo '<td>'. $row['quiz_id'] . '</td>';
	echo '<td>'. $row['ques_name'] . '</td>';
	echo '<td>'. $row['ques_text'] . '</td>';
	echo '<td width=270>';
	echo '<a class="btn btn-primary" href="qm_ques_read.php?id='.$row[0].'">Details</a>';
	echo '&nbsp;<a class="btn btn-success" href="qm_ques_update.php?id='.$row[0].'">Update</a>';
	echo '&nbsp;<a class="btn btn-danger" href="qm_ques_delete.php?id='.$row[0].'">Delete</a>';
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
