<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_option_list.php
 * author      : Dewayne Beard
 * description : This program displays a list of Options
 * ---------------------------------------------------------------------------
 */
 /*
session_start();
if(!isset($_SESSION["qm_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
$sessionid = $_SESSION['qm_person_id'];
*/
include 'session.php';
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
$_SESSION['ques_id'] = $_GET['ques_id'];
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
						<th>id</th>
						<th>question_id</th>
						<th>option-text</th>
						<th>option_isCorrect</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						include '/home/gpcorser/public_html/database/database.php';
						$pdo = Database::connect();
						$sql = 'SELECT * FROM qm_options WHERE ques_id=' . $_GET['ques_id'];
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. trim($row['id']) . '</td>'; 
							echo '<td>'. trim($row['ques_id']) . '</td>'; 
							echo '<td>'. trim($row['opt_text']) . '</td>'; 
							echo '<td>'. trim($row['opt_isCorrect']) . '</td>'; 
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
				 'Created by Dewayne Beard'
    	</div>
    </div> <!-- /container -->
  </body>
</html>
