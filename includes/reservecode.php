<?php 

 require 'dbh.inc.php';
 session_start();


 	if(isset($_POST['reserve-submit']))
 	{	

 		$name = $_SESSION['uid'];
 		$room = $_POST['name'];
 		$date1 = $_POST['date1'];
 		$date2 = $_POST['date2'];
 	


 		$mysqli =  new mysqli("localhost","root","","loginsystem") or die (mysqli_error($mysqli));
  		$result = $mysqli->query("INSERT INTO roomreserve (name, room, datetime, roomexpire ) VALUES ('$name', '$room', '$date1','$date2')") or die($mysqli->error);
 	}


?>