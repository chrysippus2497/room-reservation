
<?php
  require "adminheader.php";
  if(!isset($_SESSION['id'])){
  header('location: index.php');
}
  
?>
<?php
	
	require 'includes/dbh.inc.php';
	$msg = "";
	if(isset($_POST['submit']))
	{
	$target = "rooms/" . basename($_FILES["image"]["name"]);
	$conn = mysqli_connect("localhost", "root", "", "loginsystem");

	$image = $_FILES['image']['name'];
	$name = $_POST['name'];
	$status = "AVAILABLE";
	$sql = "INSERT INTO rooms (room_name, room_image, room_status) VALUES ('$name','$image', '$status')";
	
	mysqli_query($conn, $sql);
	if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
	{
		echo '<script> alert("Room added successfully!"); </script>';

	}
	else
	{
		echo '<script> alert("There was a problem adding a room!"); </script>';
	}
		 

		    
	}
?>


<main>
<div class="container">
  <div class="row justify-content-center">
    <section class="section-default">
    	<h1>Add Room </h1><br>
    	<center>
    	<p><?php echo $msg; ?></p>
    	</center>
    	<form class="form-reserve" action="addrooms.php" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="size" value="5000000">
    	<input type="text" name="name" placeholder="Room name" autocomplete="off" required="">
    	<input type="file" name="image"  required=""><br><br>
        <button type="submit" name="submit">add</button>
    	</form>
   
    </section>
  </div>
</div>



</main>




  <?php

  require "adminfooter.php";

  ?>



</script>


