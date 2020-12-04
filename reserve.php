<?php
  require "header.php";
  
?>
<?php 

include "includes/reserve.inc.php";

?>
<!-- <?php 
  if(isset($_POST['datetimepicker2'])){
  date_default_timezone_set('Asia/Manila');
  $date = date("Y-m-d G:i");
  $datetimepicker2 = $_POST['datetimepicker2'];
  $status = '';
  if($date > $datetimepicker2)
  {
      $status = 'Room expired';
  }else
  {
      $status = 'Room on process';
  }
 } 
 /*datetime-local*/
 
?> -->


    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <h1>Reserve a room </h1><br>
          <center>
          <p><?php echo $message; ?></p>
              
          <form class="form-reserve" action="" method="post">
            <input type="text" name="room" placeholder="Room" autocomplete="off" required>
            <input type="none" id="datetimepicker"name="datetimepicker" autocomplete="off"placeholder="Reserve starts on" value="" required>
            <input type="none" id="datetimepicker2"name="datetimepicker2" autocomplete="off"placeholder="Reserve ends at" value="" required>
            <button type="submit" name="reserve">Reserve</button>
          </form>
          </center> 

                <script>
                   $("#datetimepicker").datetimepicker({
                    timepicker: true,
                    datetimepicker: true,
                    format: 'Y/m/d G:i '
                   });
                </script>
                <script>
                   $("#datetimepicker2").datetimepicker({
                    timepicker: true,
                    datetimepicker2: true,
                    format: 'Y/m/d G:i '
                   });
                </script>
                <?php  
                  if(isset($_POST['reserve']))
                {
                  $datetime = $_POST['datetimepicker'];
                  $datetimeends = $_POST['datetimepicker2'];
                  if($datetime > $datetimeends)
                  {
                    echo '<script> alert("Invalid dates!"); </script>';
                  }
                } 

                ?>
             

          
        </section>
      </div>

    </main>

<?php

  require "footer.php";
?>
