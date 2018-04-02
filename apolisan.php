<?php
include '/home/gpcorser/public_html/database/database.php';
include '/home/gpcorser/public_html/database/header.php';
class QmComments {
  public $aMemberVar = 'aMemberVar Member Variable';
  public $aFuncName = 'aMemberFunc';
  
  function aMemberFunc(){
    print 'Inside aMemberFunc';
  }
  function ListTable(){
    //Begin body of person list
    echo '<body style="background-color: lightblue !important";> <div class="container">';
	echo '<div class="row"><h3>Comments</h3></div><div class="row"><p><a href="qm_comments.php?oper=1&per=' . $_GET['per'] . '&ques=' . $_GET['ques'] . 'class="btn btn-primary">Add Comment</a></p><table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead><tr><th>Comment ID</th><th>Person ID</th><th>Question ID</th><th>Comment</th><th>Rating</th><th>Actions</th></tr></thead><tbody>';
	
	
    //Populate Table
    $pdo = Database::connect();
      $sql = 'SELECT * FROM qm_comments WHERE per_id=' . $_GET['per'] . ' AND ques_id=' . $_GET['ques'];;

      foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td>'. trim($row['id']) . '</td>'; 
        echo '<td>'. trim($row['per_id']) . '</td>'; 
        echo '<td>'. trim($row['ques_id']) . '</td>'; 
        echo '<td>'. trim($row['comment']) . '</td>'; 
        echo '<td>'. trim($row['rating']) . '</td>'; 
		echo '<td>'. trim($row['actions']) . '</td>'; 
		echo '</tr>';
         
        
        //echo '<td width=250>';
       /* echo '<td>';
        echo '<a class="btn" href="apolisan.php?">Read</a>';
        echo ' ';
        echo '<a class="btn btn-success" href="nagaffne.php?id='.$row['id'].'&operation=update">Update</a>';
        echo ' ';
        echo '<a class="btn btn-danger" href="nagaffne.php?id='.$row['id'].'&operation=delete">Delete</a>';
        echo ' ';
        echo '<a class="btn btn-primary" href="nagaffne.php?per_id='.$row['id'].'">Quizzes</a>';							
        echo '</td>';
        echo '</tr>';*/
      }
      Database::disconnect();
	  
      //Close Table Tags
    echo '</tbody></table> </div></div></body>';
	
  }
  function CommentsRead(){
    //Retrieve data from database
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM qm_comments where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    //Begin body section
    echo '<body> <div class="container"> <div class="row"> <h3>Read a Quiz </h3></div><div class="control-group"><label class="control-label">Quiz ID: </label><div class="controls">';
    echo ''.$data['id'].'<br/>' ;
    
    
  }
}
if($_GET['oper']==0) {QmComments::listTable();}
else {
QmComments::aMemberFunc();}
?>