<<<<<<< HEAD
<?php

include '/home/gpcorser/public_html/database/header.php';
include '/home/gpcorser/public_html/database/database.php';
include 'session.php';

	class Foo {
		
		public $aMemberVar = 'aMemberVAr Member Variable';
		public $aFuncName = 'aMemberFunc';
		
		function aMemberFunc(){
			print 'Inside `aMemberFunc()`';
		}
		
		function perList(){
			//Person List
			//beggining body section of person list
			echo '<body style="background-color: lightblue !important";> <div class="container"><div class="row"><h3>Person</h3></div><div class="row"><p><a href="qm_per_create.php" class="btn btn-primary">Add Person</a></p><table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead><tr><th>Lastname</th><th>Firstname</th><th>Email</th><th>Action</th></tr></thead><tbody>';
			
			//Title of page
			echo '<h3>Comments</h3></div><div class="row">';
			
			//Create button
			echo '<p><a href="qm_comments.php?oper=1&per=' . $GET_['per'] . 
			'&ques=' . $_GET['ques'] . '" class="btn btn-primary">Add Comment</a></p>';
			
			//beginning of table
			echo '<table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead>';
			echo '<tr><th>com id</th><th>per id</th><th>ques id</th><th>comment</th><th>rating</th></tr></thead><tbody>';
			
			<?php 
			include '../../database/database.php';
			$pdo = Database::connect();
			$sql = 'SELECT * FROM qm_persons';
=======
<<<<<<< HEAD
<?php
include '/home/gpcorser/public_html/database/header.php';
include '/home/gpcorser/public_html/database/database.php';
class Foo {
	public $aMemberVar = 'aMemberVar Member Variable';
	public $aFuncName = 'aFuncName';
	
	function aMemberFunc(){
		print 'Inside `aMemberFunc()`';	
	}
	
	function perList(){ // person list
		//begining body section of person list
		echo'<body style="background-color: lightblue !important";> <div class="container"><div class="row"><h3>Persons</h3></div><div class="row"><p><a href="qm_per_create.php" class="btn btn-primary">Add Person</a></p><table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead><tr><th>Lastname</th><th>Firstname</th><th>Email</th><th>Action</th></tr></thead><tbody>';
		
		// populate person list table
		$pdo = Database::connect();
			$sql = 'SELECT * FROM qm_persons';

>>>>>>> 238d8f6f997c54ec58073418f4925eb5a3d58c0e
			foreach ($pdo->query($sql) as $row) {
				echo '<tr>';
				echo '<td>'. trim($row['lname']) . '</td>'; 
				echo '<td>'. trim($row['fname']) . '</td>'; 
				echo '<td>'. trim($row['email']) . '</td>'; 
<<<<<<< HEAD
				echo '<td>'. 'read update delete' . '</td>'; 
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
		}
=======
				 
				
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
			// end of body
				echo'</tbody></table> </div></div></body>';
	}
}
Foo::aMemberFunc();
//echo"<br />";

//$foo = new Foo;

//$foo ->aMemberFunc();
=======
<?php 

include '/home/gpcorser/public_html/database/header.php';
include '/home/gpcorser/public_html/database/database.php';

class Foo { 
    public $aMemberVar = 'aMemberVar Member Variable'; 
    public $aFuncName = 'aMemberFunc'; 
    
    function aMemberFunc() { 
        print 'Inside `aMemberFunc()`'; 
    } 
	
	function perList() { // Person List
	
		// beginning body section of person list
		echo '<body style="background-color: lightblue !important";> <div class="container"><div class="row"><h3>Persons</h3></div><div class="row"><p><a href="qm_per_create.php" class="btn btn-primary">Add Person</a></p><table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead><tr><th>Lastname</th><th>Firstname</th><th>Email</th><th>Action</th></tr></thead><tbody>';
		
		// populate persons List table
		$pdo = Database::connect();
		$sql = 'SELECT * FROM qm_persons';

		foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. trim($row['lname']) . '</td>'; 
			echo '<td>'. trim($row['fname']) . '</td>'; 
			echo '<td>'. trim($row['email']) . '</td>'; 
			 
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
		
		// end body section of person list
		echo '</tbody></table></div></div></body>';
		
>>>>>>> 238d8f6f997c54ec58073418f4925eb5a3d58c0e
		
	}
	
	
<<<<<<< HEAD
	//Foo::aMemberFunc();
	//echo "<br />";
	//
	//$foo = new Foo;
if($_GET['operation']==1) Foo::perRead($_GET['id']);
else Foo::perList();
=======
}

// Foo::aMemberFunc();
// echo "<br />";

// $foo = new Foo; 

// $foo->aMemberFunc();
>>>>>>> 067b28058b11cf764c95f2bea753f5f604f4edbb

Foo::perList();



<<<<<<< HEAD
?>
=======



>>>>>>> 238d8f6f997c54ec58073418f4925eb5a3d58c0e




<<<<<<< HEAD
?>
=======
?> 
>>>>>>> 067b28058b11cf764c95f2bea753f5f604f4edbb
>>>>>>> 238d8f6f997c54ec58073418f4925eb5a3d58c0e
