<?php 

$mysqli = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem');
	
if(isset($_POST['delete-submit']))
{
	$id = $_POST['delete_id'];



	$query = "DELETE FROM users WHERE idUsers ='$id' ";
	$query_run = mysqli_query($mysqli,$query);


	if($query_run)
	{
		echo'<script> alert("Data Deleted"); </script>';
		header('location: ../users.php');
	}
	else
	{
		echo'<script> alert("Error Deleting Data"); </script>';
	}
}

?>