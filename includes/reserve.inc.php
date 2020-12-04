<?php 
  require 'dbh.inc.php';
  $message = "";
  if(isset($_POST['reserve'])){
  $alert = "Success!";
  date_default_timezone_set('Asia/Manila');
  $date = date("Y-m-d G:i");
  $datetime = $_POST['datetimepicker'];
  $datetimeends = $_POST['datetimepicker2'];
  $room = $_POST['room'];
  $name = $_SESSION['uid'];
  $status = $_SESSION['status'];
  if($datetimeends > $date)
  {
    $status = "ACTIVE";
  }
  $mysqli =  new mysqli("localhost","root","","loginsystem") or die (mysqli_error($mysqli));
  $result = $mysqli->query("INSERT INTO roomreserve (datetime, room, roomexpire, name, status) VALUES ('$datetime', '$room', '$datetimeends','$name','$status')") or die($mysqli->error);

  if(empty($datetime)||empty($room) ||empty($datetimeends)){
    $message = " Please fill out all fields!";

 
  }
  else
  {
      
     $message = "Success!";
  }
  if($datetimeends < $date)
  {
    $sql = "UPDATE roomreserve SET status = INACTIVE ";

              $stmt = $conn->prepare($sql);

              $stmt->bind_param('s', $status);
              $stmt->execute();

              if ($stmt->error) {
                echo "FAILURE!!! " . $stmt->error;
              }
              else echo "Updated {$stmt->affected_rows} rows";

              $stmt->close();
  }
}
  
  
?>
<?php 

if(!isset($_SESSION['id'])){
  header('location: index.php');
}
?>
