<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_option_create.php
 * author      : Jacob Kaufman , jmkaufma@svsu.edu
 * description : This program adds/inserts a new option (table: qm_options)
 * ---------------------------------------------------------------------------
 */

include 'session.php';
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
include '/home/gpcorser/public_html/database/database.php'; // gpcorser

if ( !empty($_POST)) { // if not first time through

	// initialize user input validation variables
	//$ques_idError = null;
	$opt_textError = null;
	$opt_isCorrectError = null;

	// initialize $_POST variables
	$ques_id = $_SESSION['ques_id'];
	$opt_text = $_POST['opt_text'];
	$opt_isCorrect = $_POST['opt_isCorrect'];

	// validate user input

	$valid = true;
	/*
	if (empty($ques_id)) {
		$ques_idError = 'Please enter Question ID';
		$valid = false;
	}
	*/
	if (empty($opt_text)) {
		$opt_textError = 'Please enter Question Text';
		$valid = false;
	}

	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO qm_options (ques_id, opt_text, opt_isCorrect) values(?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($ques_id, $opt_text,$opt_isCorrect));
		Database::disconnect();

		header("Location: qm_option_list.php?ques_id=" . $_SESSION['ques_id']);

	}
}

?>

<body style="background-color: lightblue">
    <div class="container">

		<div class="span10 offset1">
			<div class="row">
				<h3>Add New Option</h3>
			</div>

			<form class="form-horizontal" action="qm_option_create.php?ques_id=<?php echo $_SESSION['ques_id']?>" method="post">
				<div class="control-group <?php echo !empty($opt_textError)?'error':'';?>">
					<label class="control-label">Option Text</label>
					<div class="controls">
						<input name="opt_text" type="text" placeholder="Option Text" value="<?php echo !empty($opt_text)?$opt_text:'';?>">
						<?php if (!empty($opt_textError)): ?>
							<span class="help-inline"><?php echo $opt_textError;?></span>
						<?php endif;?>
					</div>
				</div>

				<div class="control-group <?php echo !empty($opt_isCorrectError)?'error':'';?>"><br>
					<label class="control-label">Is this Option the Correct Answer?</label>
					<div class="controls">
						<div class="controls">
							<input type="hidden" name="opt_isCorrect" value="0" />
							<input type="checkbox" name="opt_isCorrect" value="1"> This is the Correct Answer<br>
						</div>
					</div>
				</div>

				<div class="form-actions">
					<br><br>
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn btn-secondary" href="qm_option_list.php?ques_id=<?php echo $_SESSION['ques_id'];?>">Back</a>
				</div>

			</form>

		</div> <!-- div: class="container" -->

    </div> <!-- div: class="container" -->

		<br><br><footer>Jacob Kaufman <a href="mailto:jmkaufma@svsu.edu">jmkaufma@svsu.edu</a></footer>

</body>
</html>
