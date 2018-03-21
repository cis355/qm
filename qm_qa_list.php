<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_qa_list.php
 * author      : Gage, Brandon bgage@svsu.edu
 * description : Lists the attempts of a given quiz for a single person
 * ---------------------------------------------------------------------------
 */
 /*
session_start();
if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
$sessionid = $_SESSION['fr_person_id'];
*/
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';
?>

<body style="background-color: lightblue !important";>
    <div class="container">
      <h1 sytle="header">Attempts</h1>
		<div class="row">

      <?php

      $pdo = Database::connect();


      echo '<div class="row"><p><a href="qm_qa_create.php?per_id" class="btn btn-primary">Add Attempt</a></p><table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead><tr><th>Quiz Score</th><th>Start Date</th> <th>Start Time</th> <th>End Date</th> <th>End Time</th><th>Action</th></tr></thead><tbody>';


      $sql = 'SELECT * FROM qm_attempts WHERE quiz_id = '. $_GET['quiz_id'];
      foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td>'. trim($row['qa_score']) . '</td>';
        echo '<td>'. trim($row['qa_start_date']) . '</td>';
        echo '<td>'. trim($row['qa_start_time']) . '</td>';
        echo '<td>'. trim($row['qa_end_date']) . '</td>';
        echo '<td>'. trim($row['qa_end_time']) . '</td>';
        echo '<td>'. '<a href="qm_qa_delete.php?quiz_id=' . $_GET['quiz_id'] . '" class="btn btn-danger">Delete</a>' . '</td>';
        echo '</tr>';
      }
      echo '</tbody></table> </div></div><p>Made by: Brandon Gage bgage@svsu.edu</p>';
      Database::disconnect();
      ?>
		</div>

  </body>
</html>
