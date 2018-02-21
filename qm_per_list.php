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
include '../../database/header.php'; // html <head> section
?>
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="icon" href="cardinal_logo.png" type="image/png" />
</head>

<body style="background-color: lightblue !important";>
    <div class="container">
		<div class="row">
			<h3>Person3</h3>
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
							echo '<td>'. 'read update delete' . '</td>'; 
						}
						Database::disconnect();
					?>
				</tbody>
			</table>
			
    	</div>
    </div> <!-- /container -->
  </body>
</html>