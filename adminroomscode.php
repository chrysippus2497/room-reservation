<?php 
if(isset($_POST['update-submit']))
  {
  $conn = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem');
  $id = $_POST['update_id'];

  $name = $_POST['name'];
  $status = $_POST['status'];

  $query = "UPDATE rooms SET room_name = '$name' AND room_status = '$status' WHERE room_id = '$id'";
  $query_run = mysqli_query($conn,$query);
  if($query_run)
  {
    echo '<script> alert("Room updated successfully!"); </script>';
    header("Location: adminrooms.php");

  }
  else
  {
    echo '<script> alert("There was a problem updating a room!"); </script>';
  }
     

        
  }
?>