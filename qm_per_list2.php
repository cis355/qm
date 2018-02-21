<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_per_list2.php
 * author      : Anthony Polisano; Apolisan@svsu.edu
 * description : This program displays a list of people (table: qm_persons)
 * ---------------------------------------------------------------------------
 */
session_start();
if(!isset($_SESSION["qm_per_id"])){ // if "user" not set,
	session_destroy();
	//header('Location: login.php');     // go to login page
	exit;
}
$sessionid = $_SESSION['qm_per_id'];
include 'functions.php';
?>

<body style="background-color: pink !important";>
    <div class="container">
		  <?php 
			//gets logo
			//functions::logoDisplay2();
			//probably won't work yet
		?>

		<div class="row">
			<h3>Person2</h3>
		</div>
		
		<div class="row">

		<p>
			<a href="qm_per_create.php" class="btn btn-primary">Add Person</a>'
		</p>
			
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						include '../../database/database.php';
						$pdo = Database::connect();
						$sql = 'SELECT FROM qr_persons';
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. $row['id'] . '</td>';
							echo '<td>'. $row['fname'] . '</td>';
							echo '<td>'. $row['lname'] . '</td>';
							
							
							//echo '<td width=250>';
							echo '<td>';
							echo '<a class="btn" href="qm_per_read.php?id='.$row['id'].'">Read</a>';
							echo ' ';
                            echo '<a class="btn btn-success" href="qm_per_update.php?id='.$row['id'].'">Update</a>';
							echo ' ';
							echo '<a class="btn btn-danger" href="qm_per_delete.php?id='.$row['id'].'">Delete</a>';
							
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