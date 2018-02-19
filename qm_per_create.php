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
include '../../database/header.php'; // html <head> section


 require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         
        if (empty($mobile)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customers (name,email,mobile) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$mobile));
            Database::disconnect();
            header("Location: index.php");
        }
    }
 

?>
 
 
 <body style="background-color: lightblue !important";>
	<div class="container">
		<div class="row">
			<h3>Create a Person</h3>
		</div>
			 <form class="form-horizontal" action="qm_per_create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input required name="firstname" type="text"  placeholder="First Name" value="<?php echo !empty($firstname)?$firstname:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input required name="lastname" type="text"  placeholder="Last Name" value="<?php echo !empty($lastname)?$lastname:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
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
                          <a class="btn btn-danger" href="index.php">Back</a>
                        </div>
                    </form>
	</div>
  </body>
</html>
 
