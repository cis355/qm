<!-- 
---------------------------------------------------------------------------
 filename    : qm_quiz_list.php
 author      : Dakota Ward, dlward@svsu.edu
 description : Shows the list of all Quizzes on the database.
 ---------------------------------------------------------------------------
-->
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
                <h3>Quiz List</h3>
				</br>
            </div>
            <div class="row">
			    <p>
                    <a href="qm_quiz_create.php" class="btn btn-success">Create Quiz</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Quiz Name</th>
					  <th>Options</th>
					  <th>Quiz Questions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '/home/gpcorser/public_html/database/database.php';
                   $pdo = Database::connect();
<<<<<<< HEAD
                   $sql = 'SELECT * FROM qm_quizzes WHERE per_id =' .$_GET['per_id'].' ORDER BY quiz_name'; 
				   //ON qm_quizzes.id = qm_persons.id
=======

                   $sql = 'SELECT * FROM qm_quizzes WHERE per_id =' . 
				        $_GET['per_id'].' ORDER BY quiz_name'; 

>>>>>>> 52f1fea64226d2248c8cacc0715764657166d272
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            
                            echo '<td width=500>'. $row['quiz_name'] . '</td>';
							echo '<td width=250>';
                            echo '<a class="btn" href="qm_quiz_read.php?id='.$row['id'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="qm_quiz_update.php?id='.$row['id'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="qm_quiz_delete.php?id='.$row['id'].'">Delete</a>';
							echo ' ';
                            echo '</td>';
							echo '<td>';
							echo '<a class="btn" href="qm_ques_list.php?id='.$row['id'].'">Questions List</a>';
							echo '</td>';
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
