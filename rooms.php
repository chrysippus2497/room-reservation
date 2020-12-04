
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

  require "footer.php";

  ?>
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
<script>
    
    $(document).ready(function() {
      $('.editbtn').on('click',function(){

        $('#editmodal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);

          $('#room_name').val(data[0]);
          $('#image').val(data[1]);

      });
    });
  </script>
  <?php 

                  $conn = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem');
                  $result = $conn->query("SELECT * FROM rooms WHERE room_status = 'AVAILABLE'") or die ($conn->error);


                  

           ?>  
                 <?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php'; 
    require 'includes/dbh.inc.php';
    // Instantiation and passing `true` enables exceptions


    if(isset($_POST['reserve-submit']))
    {
        /*RESERVATION CODEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE*/
        echo '<script> alert("Reservation code has been sent to your email, use it to activate the room.")</script>';
          $name = $_SESSION['uid'];
          $room_name = $_POST['room_name'];
          $date1 = $_POST['date1'];
          $date2 = $_POST['date2'];




        /*PHPMAILER CODEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE*/
        date_default_timezone_set("Asia/Manila");
        $transaction_time = date("Y-m-d H:i");
        $emailTo = $_SESSION['email'];
        $name = $_SESSION['uid'];
        $reserve_code =   bin2hex(openssl_random_pseudo_bytes(4));
        $status = "RESERVED";
        $query = mysqli_query($conn, "INSERT INTO roomreserve (name, email, room, datetime, roomexpire, reserve_code, status, transaction_time) VALUES ('$name','$emailTo', '$room_name', '$date1','$date2' , '$reserve_code', '$status', '$transaction_time')");
        if(!$query)
        {
           echo '<script> alert("Error")</script>';
        }
        else 
         {
          header("Location: roomreserved.php");
          }

        $mail = new PHPMailer(true);

        try {
      //Server settings

      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = 'roomreservation6@gmail.com';                     // SMTP username
      $mail->Password   = 'amaccpassword';                               // SMTP password
      $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port       = 465;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('roomreservation6@gmail.com', 'Room Reservation');
      $mail->addAddress($emailTo);     // Add a recipient
      $mail->addReplyTo('no-replyinfo@example.com', 'No reply');
      $mail->addCC('cc@example.com');
      $mail->addBCC('bcc@example.com');


      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Reservation Code';
      $mail->Body    = "<h3>Your room has been reserved, please get your code and activate your room.</h3>
               <h2> Code:</h2><h1>$reserve_code</h1>";
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      

      
      } catch (Exception $e) {
    

      
      }
          
    }

      ?>  
      <main>
<div class="container">
  <div class="row justify-content-center">
    <section class="section-default">
      <center>
        <h2>Rooms</h2>
      </center>
      <br><br>
        <table id="datatableid" class="table table-bordered table-dark table-sm">
            <thead> 
           <tr>
              <th>Room name</th>
              <th>Image </th>
              <th>Action</th>
           </tr>
           </thead>
           <tbody>
            
        <?php while ($row = $result->fetch_assoc()):?>
            <tr>
              <td><?php echo $row['room_name']?></td>
              <td><?php echo "<a href='rooms/".$row['room_image']."'</a>";?>View image</td> 
              <td>
                <button type="submit" class="btn btn-outline-info btn-sm editbtn" name="login-submit">Reserve</button>
              </td>
                        
            </tr>
        <?php endwhile; ?>
            <tbody>
           </table>


      </div>
      </div>

</div>
     
</section>
</div>
      <!-- EDIT MODAL -->  


<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">NOTE: Activation code will be sent to your email, after reserving.</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <form action="#" method="POST">
          <div class="modal-body">
            <input type="hidden" name="update_id" id="update_id">
            <div class="form-group">
                 <div class="form-group">
              <label>ROOM</label>
              <input type="text" name="room_name" id="room_name" class="form-control" autocomplete="off">
           </div>
              <label>From</label>
              <input type="datetime-local" name="date1" id="date1" class="form-control" autocomplete="off" required="" >
            </div>
            <div class="form-group">
              <label>To</label>
              <input type="datetime-local" name="date2" id="date2" class="form-control" autocomplete="off" required="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" name="reserve-submit" class="btn btn-primary">Reserve</button>
          </div>
          </form> 
    </div>
  </div>
</div>
<!-- END OF DIVIDER -->
</div>
</main>















