<?php
/* ---------------------------------------------------------------------------
 * filename    : login.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program logs the user in by setting $_SESSION variables
 * ---------------------------------------------------------------------------
 */
// Start or resume session, and create: $_SESSION[] array
session_start(); 

include '/home/gpcorser/public_html/database/database.php';

if ( !empty($_POST)) { // if $_POST filled then process the form
	// initialize $_POST variables
	$username = $_POST['username']; // username is email address, db field is email
	$password = $_POST['password']; // db field is password_hash
	$passwordhash = MD5($password);
	// echo $password . " " . $passwordhash; exit();
	// robot 87b7cb79481f317bde90c116cf36084b
	
	// role is a, t, or s, for Admin, Teacher or Student
	// db field names are role_admin, role_teacher, role_student
	$role = $_POST['role']; 

	// verify the username/password
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM qm_persons WHERE email = ? AND password_hash = ? LIMIT 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($username,$passwordhash));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	
	if($data) { // if successful login set session variables
		
		// if person requested Admin role and is admin then go to per_list
		if (!strcmp($role, 'a') && $data['role_admin']) { 
			$_SESSION['admin_id'] = $data['id'];
			$_SESSION['role'] = $role; // a
			header("Location: qm_per_list.php");
		}
		
		else {
			// else if person is admin or teacher and requests teacher, go to quiz list for person
			if (!strcmp($role, 't') && $data['role_teacher'] ) {
				$_SESSION['per_id']=$data['id'];
				$_SESSION['role'] = $role; // t
				header("Location: qm_quiz_list.php?per_id=" . $data['id']);
			}
			// student was requested. Catch all. Let anyone log in as student.
			else {
				$_SESSION['per_id']=$data['id'];
				$_SESSION['role'] = $role; // s 
				header("Location: qm_qa_list.php"); // uses session variable
			}
		}

		Database::disconnect();
		//header("Location: qm_per_list.php");
		// javascript below is necessary for system to work on github
		// echo "<script type='text/javascript'> document.location = 'fr_assignments.php'; </script>";
		exit();
	}
	else { // otherwise go to login error page
		session_destroy();
		Database::disconnect();
		header("Location: login_error.html");
	}
} 
// if $_POST NOT filled then display login form, below.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<link rel="icon" href="cardinal_logo.png" type="image/png" />
</head>

<body>
    <div class="container">

		<div class="span10 offset1">
		
			<div class="row">
				<img src="svsu_fr_logo.png" />
			</div>
			
			<!--
			<div class="row">
				<br />
				<p style="color: red;">System temporarily unavailable.</p>
			</div>
			-->

			<div class="row">
				<h3>Volunteer Login</h3>
			</div>

			<form class="form-horizontal" action="login.php" method="post">
								  
				<div class="control-group">
					<label class="control-label">Username (Email)</label>
					<div class="controls">
						<input name="username" type="text"  placeholder="me@email.com" required> 
					</div>	
				</div> 
				
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input name="password" type="password" placeholder="not your SVSU password, please" required> 
					</div>	
				</div> 
				
				<div class="control-group">
					<label class="control-label">Role</label>
					<div class="controls">
						<select name="role">
							<option value="a">Admin</option>
							<option value="t" selected>Teacher</option>
							<option value="s">Student</option>
						</select>
					</div>	
				</div> 

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Sign in</button>
					&nbsp; &nbsp;
					<a class="btn btn-primary" href="qm_per_create2.php">Register</a>
				</div>
				
				<footer>
					<small>&copy; Copyright 2017, George Corser
					</small>
				</footer>
				
			</form>


		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->

  </body>
  
</html>
