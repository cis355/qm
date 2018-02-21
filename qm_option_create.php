<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_option_create.php
 * author      : Jacob Kaufman , jmkaufma@svsu.edu
 * description : This program adds/inserts a new option (table: qm_options)
 * ---------------------------------------------------------------------------
 */
//session_start();
//if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
//	session_destroy();
//	header('Location: login.php');     // go to login page
//	exit;
//}
include '/home/gpcorser/public_html/database/header.php'; // html <head> section




if ( !empty($_POST)) { // if not first time through

	// initialize user input validation variables
	$ques_idError = null;
	$option_textError = null;
	$option_isCorrectError = null;

	// initialize $_POST variables
	$ques_id = $_POST['ques_id'];
	$option_text = $_POST['option_text'];
	$option_isCorrect = $_POST['option_isCorrect'];

	// validate user input
	$valid = true;
	if (empty($ques_id)) {
		$ques_idError = 'Please enter Question ID';
		$valid = false;
	}
	if (empty($option_text)) {
		$option_textError = 'Please enter Question Text';
		$valid = false;
	}
	if (empty($option_isCorrect)) {
		$option_isCorrectError = 'Please enter Correct Option';
		$valid = false;
	}

	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO qm_options (ques_id, option_text, option_isCorrect) values(?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($ques_id,$option_text,$option_isCorrect));
		Database::disconnect();
		header("Location: qm_options.php");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="icon" href="cardinal_logo.png" type="image/png" />
</head>

<body style="background-color: lightblue">
    <div class="container">

		<div class="span10 offset1">
			<br>
			<div class="row">
				<h3>Add New Option</h3>
			</div>

			<form class="form-horizontal" action="qm_option_create.php" method="post">

				<div class="control-group <?php echo !empty($ques_idError)?'error':'';?>">
					<label class="control-label">Question ID</label>
					<div class="controls">
						<select name="ques_id" type="text">
							<?php
								include '/home/gpcorser/public_html/database/database.php';
								$pdo = Database::connect();
								$sql = 'SELECT * FROM qm_questions';
								foreach ($pdo->query($sql) as $row) {
									echo '<option value="' . "$id" . '">' . "$id" . '</option>';
								}
								Database::disconnect();
							?>
						</select>
					</div>
				</div>

				<div class="control-group <?php echo !empty($option_textError)?'error':'';?>">
					<br>
					<label class="control-label">Option Text</label>
					<div class="controls">
						<input name="option_text" type="text" placeholder="Option Text" value="<?php echo !empty($option_text)?$option_text:'';?>">
						<?php if (!empty($option_textError)): ?>
							<span class="help-inline"><?php echo $option_textError;?></span>
						<?php endif;?>
					</div>
				</div>

				<div class="control-group <?php echo !empty($option_isCorrectError)?'error':'';?>">
					<br>
					<label class="control-label">Is This Option the Correct Answer?</label>
					<div class="controls">
						<select name="option_isCorrect" type="text">
							<option value = "1">Yes</option>
							<option value = "2">No</option>
						</select>
					</div>
				</div>

				<div class="form-actions">
					<br><br>
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn" href="qm_option_list.php">Back</a>
				</div>

			</form>

		</div> <!-- div: class="container" -->

    </div> <!-- div: class="container" -->

</body>
</html>
