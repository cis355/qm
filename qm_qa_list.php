<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_qa_list.php
 * author      : Gage, Brandon bgage@svsu.edu
 * description : Lists the attempts of quizzes for a single person
 * ---------------------------------------------------------------------------
 */
/*
session_start();
if(!isset($_SESSION["per_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
$sessionid = $_SESSION['per_id'];
*/
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';
?>

<body style="background-color: lightblue !important";>
    <div class="container">
      <h3>Attempts</h3>

      <?php

      $pdo = Database::connect();
      $per_id = $_GET['per_id'];
      $sql = 'SELECT fname, lname FROM qm_persons WHERE id = ?';
      $q = $pdo->prepare($sql);
      $q->execute(array($per_id));
      $data = $q->fetch(PDO::FETCH_ASSOC);
      echo '<div class="row">By: ' . $data['lname'] . ", " . $data['fname'] . '</div>';

      echo '<div class="row"><p><a href="qm_qa_create.php?per_id=' . $per_id .'" class="btn btn-primary">Add Attempt</a></p><table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead><tr><th>Quiz Name</th><th>Quiz Score</th><th>Start Date</th> <th>Start Time</th> <th>End Date</th> <th>End Time</th><th>Action</th></tr></thead><tbody>';
      // '. trim($row['quiz_name']) . '
      // INNER JOIN qm_quizzes WHERE qm_quizzes.per_id=$per_id qm_attempts.quiz_id=qm_quizzes.id
      $sql = "SELECT quiz_name, qa_score, qa_start_date, qa_start_time, qa_end_date, qa_end_time, qm_attempts.id  FROM qm_attempts INNER JOIN qm_quizzes ON qm_quizzes.per_id=$per_id ORDER BY qm_quizzes.quiz_name";
      foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td>' . trim($row['quiz_name']) . '</td>';
        echo '<td>'. trim($row['qa_score']) . '</td>';
        echo '<td>'. trim($row['qa_start_date']) . '</td>';
        echo '<td>'. trim($row['qa_start_time']) . '</td>';
        echo '<td>'. trim($row['qa_end_date']) . '</td>';
        echo '<td>'. trim($row['qa_end_time']) . '</td>';
        echo '<td>'.'<a href="qm_qa_read.php?attempt_id='. trim($row['id']).'&per_id=' . $per_id .'" class="btn btn-success">Read</a> <a href="qm_qa_update.php?attempt_id=' . trim($row['id']) . '&per_id='. $per_id . '" class="btn btn-warning">Update</a> <a href="qm_qa_delete.php?attempt_id=' . trim($row['id']) . '&per_id='. $per_id . '" class="btn btn-danger">Delete</a> ' . '</td>';
        echo '</tr>';
      }
      echo '</tbody></table> </div><p>Made by: Brandon Gage bgage@svsu.edu</p>';
      Database::disconnect();
      ?>
		</div>

  </body>
</html>
