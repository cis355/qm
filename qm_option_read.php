<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_option_read.php
 * author      : Shrijesh Siwakoti, shrijesh@live.com
 * description : This reads and displays a selected record.
 * ---------------------------------------------------------------------------
 */
 include  '../../database/header.php'; // html <head> section 
 require '../../database/database.php';
 
 $id = $_GET['id'];
 
 $pdo = Database::connect();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sql = "SELECT * FROM qm_options where id = ?";
 $q = $pdo->prepare($sql);
 $q->execute(array($id));
 $data = $q->fetch(PDO::FETCH_ASSOC);
 Database::disconnect();

 ?>
<body style="background-color: lightblue !important";>
    <div class="container">
		<div class="row">
			<h3>View Option Details</h3>
		</div>
		<div class="form-horizontal" >
				
				<div class="control-group col-md-6">
					<label class="control-label">Option ID</label>
					<div class="controls ">
						<label class="checkbox">
							<?php echo $data['id'];?> 
						</label>
					</div>
					<label class="control-label">Question ID</label>
					<div class="controls ">
						<label class="checkbox">
							<?php echo $data['ques_id'];?> 
						</label>
					</div>
					<label class="control-label">Option Text</label>
					<div class="controls ">
						<label class="checkbox">
							<?php echo $data['option_text'];?> 
						</label>
					</div>
					<label class="control-label">Option is Correct?</label>
					<div class="controls ">
						<label class="checkbox">
							<?php echo $data['option_isCorrect'];?> 
						</label>
					</div>
					<div class="form-actions">
						<a class="btn" href="qm_option_list.php">Back</a>
					</div>
					
				
				</div>	 <!-- end div: class="form-horizontal" -->
		
    </div> <!-- /container -->
  </body>
</html>
