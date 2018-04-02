<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_ques_update.php
 * author      : Aashish Shrestha (ashrest8@svsu.edu)
 * ---------------------------------------------------------------------------
 */
// session_start();
// if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
	// session_destroy();
	// header('Location: login.php');     // go to login page
	// exit;
// }
	include 'session.php';
require '/home/gpcorser/public_html/database/database.php';
include '/home/gpcorser/public_html/database/header.php';

      $quiz_id = $_GET['quiz_id'];
      $ques_id = $_GET['ques_id'];

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE qm_questions  set archive_flag = true WHERE id = ? ";
			$q = $pdo->prepare($sql);
			$q->execute(array($ques_id));
			Database::disconnect();
      
			header("Location: qm_ques_list.php?quiz_id=" . $quiz_id);
		

?>