<?php
include '/home/gpcorser/public_html/database/header.php'; // html <head> section
require '/home/gpcorser/public_html/database/database.php';
 ?>
 <body style="background-color: lightblue !important";>
     <div class="container">
       <h3>Attempt</h3>
       <?php
          $pdo = Database::connect();
          $attempt_id = $_GET['attempt_id'];
          
       ?>
     </div>
   </body>
