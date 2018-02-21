/* * * * * * *  * * * * * * * * * * * * * * * * * * * * * * * * * * * 
*  Filename:     qm_option_list3.php
*  Author:        Michael Drayton
*  Description:  Program manages a list of quiz question options
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */



/*
session_start();
if(!isset($_SESSION["qm_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
$sessionid = $_SESSION['qm_person_id'];
*/

include '/home/gpcorser/public_html/database/header.php'; // html <head> section
?>


<body style="background-color: lightblue !important";>
    <div class="container">

		<div class="row">
			<h3>Options</h3>
		</div>
		<div class="row">
			<a href="qm_option_create.php" class = "btn btn-primary">Add Option</a>
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>ID</th>
						<th>Question ID</th>
						<th>Option Text</th>
						<th>Option Validity</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						include '/home/gpcorser/public_html/database/database.php';
						$pdo = Database::connect();
						$sql = 'SELECT * FROM qm_options';
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. trim($row['id']) . '</td>'; 
							echo '<td>'. trim($row['quest_id']) . '</td>'; 
							echo '<td>'. trim($row['option_text']) . '</td>'; 
							echo '<td>'. trim($row['option_isCorrect']) . '</td>'; 
							echo '<td width=250>';
                                echo '<a class="btn" href="qm_option_read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="qm_option_update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="qm_option_delete.php?id='.$row['id'].'">Delete</a>';
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