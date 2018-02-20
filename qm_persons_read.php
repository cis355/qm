<?php 
/* ---------------------------------------------------------------------------
 * filename    : fr_per_read.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program displays one volunteer's details (table: fr_persons)
 * ---------------------------------------------------------------------------
 */
 
 /*
  session_start();
  if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
  	session_destroy();
  	header('Location: login.php');     // go to login page
  	exit;
  }

*/

require '../../database/database.php';


$id = $_GET['id'];

$id = 1;

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM qm_persons where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link   href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		
	</head>

	<body>
    <div class="container">
            <div class="row">
                <h2>Events For Winter 2018 </h2>
                </br>
            </div>
            <div class="row">
			    <p>
                    <a href="create_events.php" class="btn btn-success">Create Event</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Person Id</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email </th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '/home/gpcorser/public_html/database/database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM qm_persons ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['fname'] . '</td>';
                            echo '<td>'. $row['lname'] . '</td>';
                            echo '<td>'. $row['email'] . '</td>';
                            echo '<td><a class="btn" href="qm_persons_read.php?id='.$row['id'].'">Read</a></td>';
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
