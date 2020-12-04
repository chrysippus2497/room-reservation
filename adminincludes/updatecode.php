<?php 

$mysqli = new mysqli("localhost","root","","loginsystem");

	

		if(isset($_POST['update-submit']))
		{

			$id = $_POST['update_id'];


			
			$usertype = $_POST['usertype'];

			
			$query = "UPDATE users SET user_type = '$usertype' WHERE idUsers=$id ";
			$query_run = mysqli_query($mysqli,$query);

			if($query_run)
			{
				echo '<script> alert("Data Updated"); </script>';
				header('location: ../users.php');
			}
			else
			{
				echo '<script> alert("Error Updating Data"); </script>';
			}
		}

?>