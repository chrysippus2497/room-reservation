<!-- <?php
  while($row = $result->fetch_assoc())
  {

  date_default_timezone_set("ETC/GMT+8");

  $time = date("Y-m-d H:i");
  //$date1 = new DateTime($time); //realtime now
  $date2 = $row["roomexpire"];

  if($time >= $date2){

    $sql = "UPDATE roomreserve SET status = 'INACTIVE' WHERE id = '".$row['id']."'";
    $conn->query($sql);
    $status = "INACTIVE";

  } else {

    $sql = "UPDATE roomreserve SET status = 'RESERVED' WHERE id = '".$row['id']."'";
    $conn->query($sql);
    $status = "RESERVED";

  }
?>
    -->