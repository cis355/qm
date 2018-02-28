<?php 

include '/home/gpcorser/public_html/database/header.php';
include '/home/gpcorser/public_html/database/database.php';


class QmComments { 
	

	function listTable() { 
	
		// beginning body section 
		echo '<body> <div class="container">';
		
		// title of page
		echo '<div class="row"><h3>Comments</h3></div>';
		
		// create button
		echo '<div class="row"><p><a href="qm_comments.php?oper=1&per=' . $_GET['per'] . '&ques=' . $_GET['ques'] . '" class="btn btn-primary">Add Comment</a></p>';
		
		// beginning of table
		echo '<table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead>';
		echo '<tr><th>com id</th><th>per id</th><th>ques id</th><th>comment</th><th>rating</th><th>actions</th></tr></thead><tbody>';
		
		// populate table rows
		$pdo = Database::connect();
		$sql = 'SELECT * FROM qm_comments WHERE per_id=' . $_GET['per'] . ' AND ques_id=' . $_GET['ques'];

		foreach ($pdo->query($sql) as $row) {
			
			echo '<tr>';
			
			echo '<td>'. trim($row['id']) . '</td>'; 
			echo '<td>'. trim($row['per_id']) . '</td>'; 
			echo '<td>'. trim($row['ques_id']) . '</td>'; 
			echo '<td>'. trim($row['comment']) . '</td>';
			echo '<td>'. trim($row['rating']) . '</td>';
			
			// actions for each row
			echo '<td>';
			echo '<a class="btn btn-secondary" href="qm_comments.php?oper=2&per=' . $_GET['per'] . '&ques=' . $_GET['ques'] .'">Read</a>';
			echo ' ';
			echo '<a class="btn btn-success" href="qm_comments.php?oper=3&per=' . $_GET['per'] . '&ques=' . $_GET['ques'] . '&com=' . $row['id'] . '">Update</a>';
			echo ' ';
			echo '<a class="btn btn-danger" href="qm_comments.php?oper=4&per=' . $_GET['per'] . '&ques=' . $_GET['ques'] . '&com=' . $row['id'] . '">Delete</a>';
			echo ' ';
			echo '</td>';
			
			echo '</tr>';
		}
		Database::disconnect();
		
		// end body section of person list
		echo '</tbody></table></div></div></body>';
		
		
	}
	
	
}


if($_GET['oper']==0) {QmComments::listTable();}
else {echo "error";}




?> 