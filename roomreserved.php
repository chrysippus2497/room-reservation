
<?php
  require "header.php";
  require "includes/dbh.inc.php";
?>
<?php 

if(!isset($_SESSION['id'])){
  header('location: index.php');
}
  
?>


<?php  
  date_default_timezone_set("ETC/GMT+8");
  $date = date("Y-m-d G:i");
  $name = $_SESSION['uid'];
  $email = $_SESSION['email'];
  $mysqli = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem') or die (mysqli_error($mysqli));
  $result = $mysqli->query("SELECT * FROM roomreserve WHERE name = '$name' AND email = '$email'") or die ($mysqli->error);
?>


<main>
  <div class="container">
  <div class="row justify-content-center">
    <section class="section-default">
      <center>
      <h1>Room reserved</h1>
      <br><br>
    </center>
       
 <table id="datatableid" class="table table-bordered table-dark table-sm">  
  <thead>
    <th>Room</th>
    <th>From</th>
    <th>To</th>
    <th>Status</th>
    <th>Transaction time</th>
  </thead>
  <tbody>
 <?php
  while($row = $result->fetch_assoc())
  {

  date_default_timezone_set("ETC/GMT+8");

  $time = date("Y-m-d H:i");
  //$date1 = new DateTime($time); //realtime now
  $date2 = $row["roomexpire"];

  if($time >= $date2){
    $id = $row['id'];
    $sql = "UPDATE roomreserve SET status = 'ENDED' WHERE id = '$id'";
    $conn->query($sql);
    $status = "ENDED";

  } 
?>
<?php 

  if($row['status'] == 'ENDED')
  { 

    $room_name = $row['room'];
    $sql = "UPDATE rooms SET room_status = 'AVAILABLE' WHERE room_name = '$room_name'";
    $conn->query($sql);

  }


?>
   
<?php 


 if($row['status'] == 'RESERVED')
    {
      $room_name = $row['room'];
      $sql = "UPDATE rooms SET room_status = 'RESERVED' WHERE room_name = '$room_name'";
      $conn->query($sql);
    }
    elseif ($row['status'] == 'OCCUPIED')
    {
      $room_name = $row['room'];
      $sql = "UPDATE rooms SET room_status = 'OCCUPIED' WHERE room_name = '$room_name'";
      $conn->query($sql);
    }
   


?> 
 <tr>

      <td><?php echo $row["room"]?></td>
      <td><?php echo $row["datetime"]?></td>
      <td><?php echo $row["roomexpire"]?></td>
      <td><?php echo $row['status']?></td>
      <td><?php echo $row['transaction_time']?></td>
    </tr>
    <?php
  }
?>
  </tbody>
           </table>
       
      </section>
    </div>
  </div>
</main>
  <script>
  
  $(document).ready(function() {

    $('#datatableid').DataTable({
        "pagingtype": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records..",
        }
    });

});

</script>





  <?php

  require "footer.php";

  ?>

