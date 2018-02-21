<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_per_list.php
 * author      : Guadalupe Ruiz, gruiz@svsu.edu
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
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
?>

<body style="background-color: lightblue !important";>
    <div class="container">
		<div class="row">
			<h3>Persons</h3>
		</div>
		<div class="row">
			<p>
				<a href="qm_per_create.php" class="btn btn-primary">Add Person</a>
			</p>
				
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>Lastname</th>
						<th>Firstname</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						include '/home/gpcorser/public_html/database/database.php';
						$pdo = Database::connect();
						$sql = 'SELECT * FROM qm_persons';

						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. trim($row['lname']) . '</td>'; 
							echo '<td>'. trim($row['fname']) . '</td>'; 
							echo '<td>'. trim($row['email']) . '</td>'; 
							 
							
							//echo '<td width=250>';
							echo '<td>';
							echo '<a class="btn" href="qm_per_read.php?id='.$row['id'].'">Read</a>';
							echo ' ';
                            echo '<a class="btn btn-success" href="qm_per_update.php?id='.$row['id'].'">Update</a>';
							echo ' ';
							echo '<a class="btn btn-danger" href="qm_per_delete.php?id='.$row['id'].'">Delete</a>';
							echo ' ';
							echo '<a class="btn btn-primary" href="qm_quiz_list.php?per_id='.$row['id'].'">Quizzes</a>';							
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