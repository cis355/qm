<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_option_create.php
 * author      : Jacob Kaufman , jmkaufma@svsu.edu
 * description : This program adds/inserts a new option (table: qm_options)
 * ---------------------------------------------------------------------------
 */
<<<<<<< HEAD

require '/home/gpcorser/public_html/database/database.php';
=======
//session_start();
//if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
//	session_destroy();
//	header('Location: login.php');     // go to login page
//	exit;
//}
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
include '/home/gpcorser/public_html/database/database.php'; // gpcorser
>>>>>>> 07fd39b125319fa2002aa09ac38dbc414b4c769c

if ( !empty($_POST)) { // if not first time through

	// initialize user input validation variables
	// $ques_idError = null; // gpcorser: never let user choose id
	$option_textError = null;
	$option_isCorrectError = null;

	// initialize $_POST variables
	// $ques_id = $_POST['ques_id']; // gpcorser: never let user choose id
	$option_text = $_POST['opt_text'];
	$option_isCorrect = $_POST['opt_isCorrect'];

	// validate user input
<<<<<<< HEAD
=======
	$valid = true;
	/* // gpcorser: never let user choose id
	if (empty($ques_id)) {
		$ques_idError = 'Please enter Question ID';
		$valid = false;
	}
	*/
>>>>>>> 07fd39b125319fa2002aa09ac38dbc414b4c769c
	if (empty($option_text)) {
		$option_textError = 'Please enter Question Text';
		$valid = false;
	}

	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO qm_options (opt_text, opt_isCorrect) values(?, ?)"; // gpcorser: never let user choose id
		$q = $pdo->prepare($sql);
		$q->execute(array($option_text,$option_isCorrect));
		Database::disconnect();
<<<<<<< HEAD
		header("Location: qm_option_list.php");
=======
		header("Location: qm_option_list.php"); // gpcorser
>>>>>>> 07fd39b125319fa2002aa09ac38dbc414b4c769c
	}
}

include '/home/gpcorser/public_html/database/header.php'; //html <head> section

?>

<body style="background-color: lightblue">
    <div class="container">

		<div class="span10 offset1">
			<br>
			<div class="row">
				<h3>Add New Option</h3>
			</div>

			<form class="form-horizontal" action="qm_option_create.php" method="post">

<<<<<<< HEAD
				<div class="control-group <?php echo !empty($ques_idError)?'error':'';?>">
					<label class="control-label">Question</label>
					<div class="controls">
						<select name="ques_id" type="text">
							<?php
								$pdo = Database::connect();
								$sql = 'SELECT * FROM qm_questions';
								foreach ($pdo->query($sql) as $row) {
									echo '<option value="' . $row['id'] . '">' . $row['id'] . ' ' . $row['ques_text'] . '</option>';
								}
								Database::disconnect();
							?>
						</select>
					</div>
				</div>

=======
>>>>>>> 07fd39b125319fa2002aa09ac38dbc414b4c769c
				<div class="control-group <?php echo !empty($option_textError)?'error':'';?>">
					<br>
					<label class="control-label">Option Text</label>
					<div class="controls">
						<input name="opt_text" type="text" placeholder="Option Text" value="<?php echo !empty($option_text)?$option_text:'';?>">
						<?php if (!empty($option_textError)): ?>
							<span class="help-inline"><?php echo $option_textError;?></span>
						<?php endif;?>
					</div>
				</div>

				<div class="control-group <?php echo !empty($option_isCorrectError)?'error':'';?>"><br>
					<label class="control-label">Is this Option the Correct Answer?</label>
					<div class="controls">
						<div class="controls">
						  <input type="checkbox" name="opt_isCorrect" value="1"> This is the Correct Answer<br>
						</div>
					</div>
				</div>

				<div class="form-actions">
					<br><br>
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn btn-secondary" href="qm_option_list.php">Back</a>
				</div>

			</form>

		</div> <!-- div: class="container" -->

    </div> <!-- div: class="container" -->

</body>
</html>
