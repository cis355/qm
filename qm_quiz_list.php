<!-- 
---------------------------------------------------------------------------
 filename    : qm_quiz_list.php
 author      : Dakota Ward, dlward@svsu.edu
 description : Shows the list of all Quizzes on the database.
 ---------------------------------------------------------------------------
-->
<?php
require 'session.php';
include '/home/gpcorser/public_html/database/header.php';
 include '/home/gpcorser/public_html/database/database.php';
 $_SESSION['per_id'] = $_GET['per_id'];
?>

<body style="background-color: lightblue !important";>
    <div class="container">
            <div class="row">
                <h3>Quiz List For: <?php
                   include '/home/gpcorser/public_html/database/.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT fname, lname FROM qm_persons WHERE id =' . 
				        $_GET['per_id'];
							
						foreach ($pdo->query($sql) as $row) {
							echo $row['fname'], " ", $row['lname']; 
                   }
                   Database::disconnect();
                  ?></h3>
				</br>
				</br>
            </div>
            <div class="row">
			    <p>
                    <a href="qm_quiz_create.php?per_id=<?php echo $_GET['per_id'];?>" class="btn btn-success">Create Quiz</a>
					<a href="qm_quiz_list_archive.php?per_id=<?php echo $_GET['per_id'];?>" class="btn btn-secondary">View Archive</a>
                </p>
				
                <table class="table table-striped table-bordered" style="background-color: lightgrey !important">
                  <thead>
                    <tr>
                      <th>Quiz Name</th>
					  <!--<th>Archived?</th><!--check if archived-->
					  <th>Options</th>
					  <th>Quiz Questions</th>
					  <th>Quiz Attempts</th>
                    </tr>
                  </thead>
                  <tbody>
				  
                  <?php
                   $sql = 'SELECT * FROM qm_quizzes WHERE per_id =' . 
				        $_GET['per_id'].' AND archive_flag = 0 ORDER BY quiz_name'; 
						


                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td width=500>'. $row['quiz_name'] . '</td>';
                          //  echo '<td width=250>'. $row['archive_flag'] . '</td>';

							echo '<td width=250>';
                            echo '<a class="btn" href="qm_quiz_read.php?id='.$row['id'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="qm_quiz_update.php?id='.$row['id'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="qm_quiz_archive.php?id='.$row['id'].'">Delete</a>'; //changed delete to archive
							echo ' ';
                            echo '</td>';
							echo '<td>';
							echo '<a class="btn" href="qm_ques_list.php?quiz_id='.$row['id'].'">Questions List</a>';
							echo '</td>';
							echo '<td>';
							echo '<a class="btn" href="qm_qa_list.php?id='.$row['id'].'">Quiz Attempts</a>';
							echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
				  
                  </tbody>
            </table>
			<br/>
			<p>Dakota Ward, dlward@svsu</p>
        </div>
    </div> <!-- /container -->
  </body>
</html>
