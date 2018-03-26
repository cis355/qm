<!-- /* * * * * * *  * * * * * * * * * * * * * * * * * * * * * * * * * * * 
*  Filename:     qm_option_list3.php
*  Author:        Michael Drayton, mhdrayto@svsu.edu
*  Description:  Program manages a list of quiz question options
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */ -->

<!-- remnant code from a concept I am still trying to implement:

//$sql = 'SELECT * FROM qm_options INNER JOIN qm_questions ON qm_options.id = qm_questions.id';
						/*$sql = 'SELECT * FROM qm_options WHERE quest_id =' .
							$_GET['quest_id'] . ' ORDER BY quiz_name';*/
							//echo $row['ques_name'];
							
-->

<?php
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
/*include 'session.php';
//session_start();
if(!isset($_SESSION["per_id"])){ // if "user" not set,
	session_destroy();
	//header('Location: login.php');     // go to login page
	exit;
}
$sessionid = $_SESSION['per_id'];
$id = $_GET['id'];*/


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
							echo '<td>'. trim($row['ques_id']) . '</td>';
							echo '<td>'. trim($row['opt_text']) . '</td>'; 
							echo '<td>'. trim($row['opt_isCorrect']) . '</td>'; 
							echo '<td width=250>';
                                echo '<a class="btn" href="qm_option_read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="qm_option_update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="qm_option_delete.php?id='.$row['id'].'">Delete</a>';
								echo '<a class="btn" href="qm_ques_list2.php?id='.$row['ques_id'].'">Question</a>';
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