<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_ques_list.php
 * author      : 
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
include '../../database/header.php';
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
						<th>Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						include '../../database/database.php';
						$pdo = Database::connect();
						$sql = 'SELECT * FROM qm_questions';
						
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. trim($row['lname']) . '<td>';
							echo '<td>'. trim($row['fname']) . '<td>';
								
						}
						Database::disconnect();
					?>
				</tbody>
			</table>
			
    	</div>
    </div> <!-- /container -->
  </body>
</html>