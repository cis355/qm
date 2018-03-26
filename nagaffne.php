<?php
include '/home/gpcorser/public_html/database/database.php';
include '/home/gpcorser/public_html/database/header.php';
class Foo {
  public $aMemberVar = 'aMemberVar Member Variable';
  public $aFuncName = 'aMemberFunc';
  
  function aMemberFunc(){
    print 'Inside aMemberFunc';
  }
  function perList(){
    //Begin body of person list
    echo '<body style="background-color: lightblue !important";> <div class="container"><div class="row"><h3>Persons</h3></div><div class="row"><p><a href="qm_per_create.php" class="btn btn-primary">Add Person</a></p><table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead><tr><th>Lastname</th><th>Firstname</th><th>Email</th><th>Action</th></tr></thead><tbody>';
    //Populate Table
    $pdo = Database::connect();
      $sql = 'SELECT * FROM qm_persons';

      foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td>'. trim($row['lname']) . '</td>'; 
        echo '<td>'. trim($row['fname']) . '</td>'; 
        echo '<td>'. trim($row['email']) . '</td>'; 
         
        
        //echo '<td width=250>';
        echo '<td>';
        echo '<a class="btn" href="nagaffne.php?id='.$row['id'].'&operation=1">Read</a>';
        echo ' ';
        echo '<a class="btn btn-success" href="nagaffne.php?id='.$row['id'].'&operation=update">Update</a>';
        echo ' ';
        echo '<a class="btn btn-danger" href="nagaffne.php?id='.$row['id'].'&operation=delete">Delete</a>';
        echo ' ';
        echo '<a class="btn btn-primary" href="nagaffne.php?per_id='.$row['id'].'">Quizzes</a>';							
        echo '</td>';
        echo '</tr>';
      }
      Database::disconnect();
      //Close Table Tags
    echo '</tbody></table> </div></div></body>';
  }
  function perRead(){
    //Retrieve data from database
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM qm_persons where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    //Begin body section
    echo '<body> <div class="container"> <div class="row"> <h3>Read a Quiz </h3></div><div class="control-group"><label class="control-label">Quiz ID: </label><div class="controls">';
    echo ''.$data['id'].'<br/>' ;
    
    
  }
}
if($_GET['operation']==1) {Foo::perRead($_GET['id']);}
else {
Foo::perList();}
?>