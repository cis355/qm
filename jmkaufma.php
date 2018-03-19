<?php

include '/home/gpcorser/public_html/database/header.php';
include '/home/gpcorser/public_html/database/database.php';
include 'session.php';

class Foo {
    public $aMemberVar = 'aMemberVar Member Variable';
    public $aFuncName = 'aMemberFunc';

    function aMemberFunc() {
        print 'Inside `aMemberFunc()`';
    }

    function perRead($id) { // Person Read

        // get info from database
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM qm_persons where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        // display first part of body section
        echo '<body> <div class="container"> <div class="span10 offset1"> <div class="row"> <h3>Person Details</h3> </div><div class="form-horizontal" > <div class="control-group"> <label class="control-label">First Name: </label>';
        echo ' ' . $data['fname'] . '<br />';

    }

    function perList() { // Person List

        // beginning body section of person list
        echo '<body style="background-color: lightblue !important";> <div class="container"><div class="row"><h3>Persons</h3></div><div class="row"><p><a href="qm_per_create.php" class="btn btn-primary">Add Person</a></p><table class="table table-striped table-bordered" style="background-color: lightgrey !important"><thead><tr><th>Lastname</th><th>Firstname</th><th>Email</th><th>Action</th></tr></thead><tbody>';

        // populate persons List table
        $pdo = Database::connect();
        $sql = 'SELECT * FROM qm_persons';

        foreach ($pdo->query($sql) as $row) {
            echo '<tr>';
            echo '<td>'. trim($row['lname']) . '</td>';
            echo '<td>'. trim($row['fname']) . '</td>';
            echo '<td>'. trim($row['email']) . '</td>';

            echo '<td>';
            echo '<a class="btn" href="jmkaufma.php?id='.$row['id'].'&operation=1">Read</a>';
            echo ' ';
            echo '<a class="btn btn-success" href="qm_per_update.php?id='.$row['id'].'">Update</a>';
            echo ' ';
            echo '<a class="btn btn-danger" href="qm_per_delete.php?id='.$row['id'].'">Delete</a>';
            echo ' ';
            echo '<a class="btn btn-primary" href="qm_quiz_list.php?per_id='.$row['id'].'">Quizzes</a>';
            echo '</td>';
            echo '</tr>';
        }
        Database::disconnect();

        // end body section of person list
        echo '</tbody></table></div></div></body>';


    }


}

// Foo::aMemberFunc();
// echo "<br />";

// $foo = new Foo;

// $foo->aMemberFunc();

if($_GET['operation']==1) {Foo::perRead($_GET['id']);}
else {Foo::perList();}


?>
