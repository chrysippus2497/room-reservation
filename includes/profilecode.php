<?php 

require 'includes/dbh.inc.php';


		if(isset($_POST['mailuid']))
		{

			
			
			 $email = $_POST['mailuid'];

			 $mysqli = new mysqli('localhost','root', '', 'loginsystem') or die (mysqli_error($mysqli));
			 $result = $mysqli->query("SELECT emailUsers FROM users WHERE emailU") or die ($mysqli->error);
	         if(mysqli_num_rows($result) === 0)

	         {
	         	 exit("There was an error loading the page you requested.");
	         }

         }

?>