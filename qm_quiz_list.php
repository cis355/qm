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
            </div>
            <div class="row">
			    <p>
                    <a href="qm_quiz_create.php" class="btn btn-success">Create Quiz</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Quiz Name</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '../../database/database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM QM_QUIZZES ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
                            //echo '<td>'. $row['per_id'] . '</td>';
                            echo '<td>'. $row['quiz_name'] . '</td>';
							//echo '<td>'. $row['quiz_description'] . '</td>';
							echo '<td width=250>';
                            echo '<a class="btn" href="qm_quiz_read.php?id='.$row['id'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="qm_quiz_update.php?id='.$row['id'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="qm_quiz_delete.php?id='.$row['id'].'">Delete</a>';
							echo ' ';
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