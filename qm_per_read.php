<?php

/* ---------------------------------------------------------------------------
 * filename    : qm_per_read.php
 * author      : dneupan1
 * description : Displays the person details
 * ---------------------------------------------------------------------------
 */
 


    require '/home/gpcorser/public_html/database/database.php';
    require '/home/gpcorser/public_html/database/header.php';
    include 'session.php';
    
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: qm_per_list.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM qm_persons where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">

<body style="background-color: lightblue !important"; >
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h2>Person Details</h2>
						
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">First Name: </label> <?php echo $data['fname'];?> <?php echo "</br>";?>
                        
                      <div class="control-group">
                        <label class="control-label">Last Name: </label> <?php echo $data['lname'];?> <?php echo "</br>";?>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Email : </label> <?php echo $data['email'];?> <?php echo "</br>";?>
                      </div>
                        <div class="form-actions">
						                <a class="btn" href="qm_per_list.php">Back</a>
				                	</div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
	<footer><p>Page by Deepak Neupane</p></footer>
</html>
