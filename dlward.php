<?php
include '/home/gpcorser/public_html/database/header.php';
include '/home/gpcorser/public_html/database/database.php';
include 'session.php';

class qm_comment{
	
	function listTable(){
		
	echo '<body style="background-color: lightblue !important";> <div class="container"><div class="row"><h3>Persons</h3></div><div class="row"><p><a href="qm_per_create.php" class="btn btn-primary">Add Person</a></p><table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead><tr><th>Lastname</th><th>Firstname</th><th>Email</th><th>Action</th></tr></thead><tbody>';

	$pdo = Database::connect();
	$sql = 'SELECT * FROM qm_persons';

	foreach ($pdo->query($sql) as $row) {
		echo '<tr>';
		echo '<td>'. trim($row['lname']) . '</td>'; 
		echo '<td>'. trim($row['fname']) . '</td>'; 
		echo '<td>'. trim($row['email']) . '</td>'; 
		 
		echo '<td>';
		echo '<a class="btn" href=''>Read</a>';
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
	echo '</tbody></table></div></div></body></html>';
	}
	
	function createRow(){
		
	}
	
	function readRow($id){
		
		$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM qm_persons where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
	}
	
	function deleteRow(){
		
	}
	
	function updateRow(){
		
	}	
}

qm_comment::listTable()
?>
