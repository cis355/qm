<!DOCTYPE html>
<?php
/*-----------------------------------------------
 *filename	: qm_per_create.php
 *author	: George Beeman, gabeeman@svsu.edu
 *description: Create page for persons
 *-----------------------------------------------
 */
 
  /*session_start();
if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
$sessionid = $_SESSION['fr_person_id'];
*/
include '/home/gpcorser/public_html/database/header.php'; // html <head> section


 
    if ( !empty($_POST)) {
        // keep track validation errors
        $fnameError = null;
		$lnameError = null;
        $emailError = null;
         
        // keep track post values
        $fname = $_POST['fname'];
		$lname = $_POST['lname'];
        $email = $_POST['email'];
         
        // validate input
        $valid = true;
        if (empty($fname)) {
            $fnameError = 'Please enter First Name';
            $valid = false;
        }
		if (empty($lname)) {
            $lnameError = 'Please enter Last Name';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO qm_persons (name,email) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email));
            Database::disconnect();
            //header("Location: index.php");
        }
    }
 

?>

<head>
    <meta charset="utf-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="icon" href="cardinal_logo.png" type="image/png">
</head>
 
 
 <body style="background-color: lightblue !important";>
	<div class="container">
		<div class="row">
			<h3>Create a Person</h3>
		</div>
			 <form class="form-horizontal" action="qm_per_create.php" method="post">
                      <div class="control-group <?php echo !empty($fError)?'error':'';?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input required name="fname" type="text"  placeholder="First Name" value="<?php echo !empty($fname)?$fname:'';?>">
                            <?php if (!empty($fnameError)): ?>
                                <span class="help-inline"><?php echo $fnameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($lnameError)?'error':'';?>">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input required name="lname" type="text"  placeholder="Last Name" value="<?php echo !empty($lname)?$lname:'';?>">
                            <?php if (!empty($lError)): ?>
                                <span class="help-inline"><?php echo $lnameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input required name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <br>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn btn-danger" href="qm_per_list.php">Back</a>
                        </div>
                    </form>
	</div>
  </body>
</html>
 
