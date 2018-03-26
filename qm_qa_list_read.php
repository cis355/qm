<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_qa_list_read.php
 * author      : Cecilia Hentkowski, cehentko@svsu.edu
 * description : This program displays data pertaining to a quiz taken
 * ---------------------------------------------------------------------------
 */
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
include '/home/gpcorser/public_html/database/database.php'; // 
include 'session.php';

//Class QmAttempts
 	//function readRow(){
		//get info from database
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT * FROM qm_qa_list where id =' . $_GET['id'] .'';
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
		
		//display first part of body section
		echo '<div class="container"><div class="span10 offset1">';
		echo '<div class="row"><h3>Quiz Attempts</h3></div>';
		echo '<div class="form-horizontal"><div class="control-group">';
		echo '<div class="control-group"><label class="control-label"><u>ID:</u></label></div>';
		echo $data['id'];
		echo '<div class="control-group"><label class="control-label"><u>Quiz ID:</u></label></div>';
		echo $data['quiz_id'];
		echo '<div class="control-group"><label class="control-label"><u>Score:</u></label></div>';
		echo $data['qa_score'];
		echo '<div class="control-group"><label class="control-label"><u>Start Date:</u></label></div>';
		echo $data['qa_start_date'];
		echo '<div class="control-group"><label class="control-label"><u>End Date:</u></label></div>';
		echo $data['qa_end_date'];
		echo '<div class="control-group"><label class="control-label"><u>Start Time:</u></label></div>';
		echo $data['qa_start_time'];
		echo '<div class="control-group"><label class="control-label"><u>End Time:</u></label></div>';
		echo $data['qa_end_time'];
		//echo '<div class="form-actions"><a href="qm_qa_list.php?oper=0&per=' . $_GET['per'] . '&ques=' . $_GET['ques'] . '" class="previous">Back</a></div>';
		echo '<div class="form-actions"><a href="qm_qa_list.php?oper=2&per=' . $_GET['per'] . '&quiz_id=' . $_GET['quiz_id'] . '" class="previous">Back</a></div>';
		echo '</div></div>';
	//}
//}
?>