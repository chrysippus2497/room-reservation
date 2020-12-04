
<?php
  require "adminheader.php";
  require "includes/dbh.inc.php";

?>
<?php 

  if(isset($_POST['submit']))
  {

    $code = $_POST['code'];
    $name = $_SESSION['uid'];

    $mysqli = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem') or die (mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM roomreserve WHERE reserve_code = '$code'") or die ($mysqli->error);
    $row = $result->fetch_assoc();

    if($row['reserve_code'] == $code)
    {
    $sql = "UPDATE roomreserve SET status = 'OCCUPIED' WHERE reserve_code = '$code'";
    $conn->query($sql);
    $status = "OCCUPIED";
    echo '<script> alert("Success") </script>';
    }
    elseif ($code == $row['reserve_code'])
    {
      echo '<script> alert("Code is expired!")</script>';
    }

  }


?>


<main>
<div class="container">
  <div class="row justify-content-center">
    <section class="section-default">
        <center>
      <h2>Activate Room </h2> 
      <form class="form-reserve" action="" method="post">

      <input type="text" name="code" placeholder="Enter code" required="">
        <button type="submit" name="submit">Activate</button>
      </form>
      <br><br>
    </center>
  


</section>
</div>
</div>
</main>

  <?php

  require "footer.php";

  ?>
    <script>
 











