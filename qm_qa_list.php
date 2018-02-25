<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_qa_list.php
 * author      : Gage, Brandon bgage@svsu.edu
 * description :
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
						include '../../database/database.php';
						$pdo = Database::connect();
						$sql = 'SELECT * FROM qm_persons';
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. trim($row['lname']) . '</td>';
							echo '<td>'. trim($row['fname']) . '</td>';
							echo '<td>'. trim($row['email']) . '</td>';
							echo '<td>'. 'read update delete' . '<a href=qm_qa_read.php?quiz_id></a>' . '</td>';
						}
						Database::disconnect();
					?>
				</tbody>
			</table>

    	</div>
    </div> <!-- /container -->
  </body>
</html>
