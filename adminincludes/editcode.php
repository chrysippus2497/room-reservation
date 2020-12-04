<?php 

$mysqli = new mysqli("localhost","root","","loginsystem");

	

		if(isset($_POST['edit-submit']))
		{

			$id = $_POST['update_id'];


			$name = $_POST['name'];
			$room = $_POST['room'];
			$datetime = $_POST['datetime'];
			$roomexpire = $_POST['roomexpire'];
			$status = $row['status'];
			

			
			$query = "UPDATE roomreserve SET name = '$name', room = '$room', datetime = '$datetime', roomexpire = '$roomexpire', status = '$status' WHERE id=$id ";
			$query_run = mysqli_query($mysqli,$query);

			if($query_run)
			{
				echo '<script> alert("Data Updated"); </script>';
				header('location: ../adminroomreserved.php');
			}
			else
			{
				echo '<script> alert("Error Updating Data"); </script>';
			}
		}

?>
<?php 
			  date_default_timezone_set('Asia/Manila');
			  $date = date("Y-m-d G:i");
			  

  
?>