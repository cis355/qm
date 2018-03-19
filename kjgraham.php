<?php
	include '/home/gpcorser/public_html/database/header.php'; // html <head> section
	require '/home/gpcorser/public_html/database/database.php';
	include 'session.php';
	
class QmComments{
	
	function commentList(){ // comment list
		echo '<body>
		<div class="container">
		<div class="row">
			<h3>Comments</h3>
		</div>
		<div class="row">
			<p>
				<a href="qm_comments.php?oper=1&per=' . $_GET['per_id'] . '&ques=' . $_GET['ques_id'] . '" class="btn btn-primary">Add Comment</a>
			</p>
				
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>Comment ID</th>
						<th>Person ID</th>
						<th>Question ID</th>
						<th>Comment</th>
						<th>Rating</th>
					</tr>
				</thead>
				<tbody>'
		include '/home/gpcorser/public_html/database/database.php';
		$pdo = Database::connect();
		$sql = 'SELECT * FROM qm_comments';

		foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. trim($row['id']) . '</td>'; 
			echo '<td>'. trim($row['per_id']) . '</td>'; 
			echo '<td>'. trim($row['ques_id']) . '</td>'; 
			echo '<td>'. trim($row['comment']) . '</td>'; 
			echo '<td>'. trim($row['rating']) . '</td>';	
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
			echo '	</tbody>
					</table>
					</div>
				</div> <!-- /container -->
				</body>';
		
	}
	
	function commentRead($id){ // comment read
		include '/home/gpcorser/public_html/database/header.php';
		$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM qm_persons where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
		
		// display data
		echo '<body style="background-color: lightblue !important"; >
			<div class="container">
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Person Details</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Comment ID: </label> ';
						echo $data['id'];
						echo'</div><br><div class="control-group">
                        <label class="control-label">Person ID: </label> ';
						echo $data['per_id'];	
                      echo '<div class="control-group">
                        <label class="control-label">Comment: </label> ';
						echo $data['comment'];
						echo'</div><br><div class="control-group">
                        <label class="control-label">Rating: </label> ';
						echo $data['rating'];
						echo'</div><div class="form-actions">
						<a class="btn" href="qm_per_list.php">Back</a></div>
                     </div>
                </div>';
				
    }
	}
}	

if($_GET['operation'] == 1) {Foo::commentRead($_GET['id'];}
else
?>