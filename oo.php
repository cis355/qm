<<<<<<< HEAD
<?php 
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
include '/home/gpcorser/public_html/database/database.php'; // 
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
>>>>>>> dfcbc1905c7dbba047887f365dff6f7a6a773765

class Foo { 
    public $aMemberVar = 'aMemberVar Member Variable'; 
    public $aFuncName = 'aMemberFunc'; 
    
    function aMemberFunc() { 
        print 'Inside `aMemberFunc()`'; 
    } 
	
<<<<<<< HEAD
	function perList(){ //person list
	
		//beginning body section of person list
		//the code below is from qm_per_list.php and minified using this site: https://www.willpeavy.com/minifier/
		echo '<body style="background-color: lightblue !important";> <div class="container"><div class="row"><h3>Persons</h3></div><div class="row"><p><a href="qm_per_create.php" class="btn btn-primary">Add Person</a></p><table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead><tr><th>Lastname</th><th>Firstname</th><th>Email</th><th>Action</th></tr></thead><tbody>';
		
		//populate person list table
=======
	function perList() { // Person List
	
		// beginning body section of person list
		echo '<body style="background-color: lightblue !important";> <div class="container"><div class="row"><h3>Persons</h3></div><div class="row"><p><a href="qm_per_create.php" class="btn btn-primary">Add Person</a></p><table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead><tr><th>Lastname</th><th>Firstname</th><th>Email</th><th>Action</th></tr></thead><tbody>';
		
		// populate persons List table
>>>>>>> dfcbc1905c7dbba047887f365dff6f7a6a773765
		$pdo = Database::connect();
		$sql = 'SELECT * FROM qm_persons';

		foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. trim($row['lname']) . '</td>'; 
			echo '<td>'. trim($row['fname']) . '</td>'; 
			echo '<td>'. trim($row['email']) . '</td>'; 
			 
<<<<<<< HEAD
			
			//echo '<td width=250>';
			echo '<td>';
			echo '<a class="btn" href="qm_per_read.php?id='.$row['id'].'">Read</a>';
			echo ' ';
                        echo '<a class="btn btn-success" href="qm_per_update.php?id='.$row['id'].'">Update</a>';
=======
			echo '<td>';
			echo '<a class="btn" href="qm_per_read.php?id='.$row['id'].'">Read</a>';
			echo ' ';
			echo '<a class="btn btn-success" href="qm_per_update.php?id='.$row['id'].'">Update</a>';
>>>>>>> dfcbc1905c7dbba047887f365dff6f7a6a773765
			echo ' ';
			echo '<a class="btn btn-danger" href="qm_per_delete.php?id='.$row['id'].'">Delete</a>';
			echo ' ';
			echo '<a class="btn btn-primary" href="qm_quiz_list.php?per_id='.$row['id'].'">Quizzes</a>';							
			echo '</td>';
			echo '</tr>';
		}
		Database::disconnect();
<<<<<<< HEAD
		//end of body section of person list
		echo '</tbody></table> </div></div></body></html>';
	}
} 
=======
		
		// end body section of person list
		echo '</tbody></table></div></div></body>';
		
		
	}
	
	
}
>>>>>>> dfcbc1905c7dbba047887f365dff6f7a6a773765

// Foo::aMemberFunc();
// echo "<br />";

<<<<<<< HEAD
// $foo = new Foo; //instantiating object

// $foo->aMemberFunc();

Foo::perList();
?> 
=======
// $foo = new Foo; 

// $foo->aMemberFunc();
>>>>>>> 067b28058b11cf764c95f2bea753f5f604f4edbb

Foo::perList();



<<<<<<< HEAD
?>
=======







?> 
>>>>>>> 067b28058b11cf764c95f2bea753f5f604f4edbb
>>>>>>> dfcbc1905c7dbba047887f365dff6f7a6a773765
