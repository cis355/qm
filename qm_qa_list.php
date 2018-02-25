<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_qa_list.php
 * author      : Gage, Brandon bgage@svsu.edu
 * description : Lists the attempts of a given quiz for a single person
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
include '../../database/header.php'; // html <head> section
?>

<body style="background-color: lightblue !important";>
    <div class="container">
		<div class="row">
      <?php
      require '../../database/database.php';
      $pdo = Database::connect();
      $sql = 'SELECT quiz_name, fname, lname FROM qm_attempts WHERE qm_attempts.quiz_id = ? Join qm_quizzes on qm_attempts.quiz_id = qm_quizzes.quiz_id Join qm_persons on qm_quizzes.per_id = qm_persons.id'
      $q = $pdo->prepare($sql);
      $q->execute(array($id));
      $data = $q->fetch(PDO::FETCH_ASSOC);
      echo 'Quiz Attemts on Quiz:' . $data['quiz_name'] . 'made by: ' . $data['lname'] . ', ' . $data['fname'];
      ?>
			<h3>Person</h3>
		</div>
		<div class="row">
			<p>
				<a href="qm_qa_create.php?per_id" class="btn btn-primary">Add Attempt</a>'
			</p>

			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>AttemptNumber</th>
						<th>Quiz Score</th>
						<th>Start Date</th>
            <th>Start Time</th>
            <th>End Date</th>
            <th>End Time</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						require '../../database/database.php';
						$pdo = Database::connect();
						$sql = 'SELECT qa_score, qa_start_date, qa_start_time, qa_end_date, qa_end_time FROM qm_attempts WHERE quiz_id = ?';
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. trim($row['qa_score']) . '</td>';
							echo '<td>'. trim($row['qa_start_date']) . '</td>';
							echo '<td>'. trim($row['qa_start_time']) . '</td>';
              echo '<td>'. trim($row['qa_end_date']) . '</td>';
              echo '<td>'. trim($row['qa_end_time']) . '</td>';
							echo '<td>'. '<a href=qm_qa_read.php?quiz_id>Read</a>'. '<a href="qm_qa_delete?quiz_id" class="btn btn_delete">Delete</a>' . '</td>';
						}
						Database::disconnect();
					?>
				</tbody>
			</table>

    	</div>
    </div> <!-- /container -->
  </body>
</html>
