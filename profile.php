<?php
  require "header.php";
  require "includes/profilecode.php";
  require 'includes/dbh.inc.php';
  
?>
<?php 

if(!isset($_SESSION['id']))
{
  header('location: index.php');
}
else
{

       $email = $_SESSION['email'];
       $username = $_SESSION['uid'];
       $mysqli = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem') or die (mysqli_error($mysqli));
       $result = $mysqli->query("SELECT * FROM users  WHERE uidUsers = '$username'") or die ($mysqli->error);

}
  
?>
<?php 
$mysqli = new mysqli("localhost","root","","loginsystem");

  

    if(isset($_POST['update-submit']))
    {

      $email = $_SESSION['email'];
      $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    
      $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?";

              $stmt = $conn->prepare($sql);

              $stmt->bind_param('ss', $pass, $email);
              $stmt->execute();

              if ($stmt->error) {
                echo "FAILURE!!! " . $stmt->error;
              }
              else echo '<script> alert("Password updated successfully!"); </script>';;

              $stmt->close();

    }

?>

 <main>
      <div class="wrapper-main">
        <section class="section-default">
   		 <h1>Profile</h1><br>
          
            
            <table>
            <thead> 
           <tr>
              <th>Username</th>
              <th>Email-Address</th>
              <th>Change password</th> 
              
           </tr>
           </thead>
           <tbody>
            
        <?php while ($row = $result->fetch_assoc()):?>
            <tr>
              <td><?php echo $row['uidUsers']?></td>
              <td><?php echo $row['emailUsers']?></td>
              <td> 
              <button type="submit" class="btn btn-outline-info btn-sm editbtn" name="login-submit">Change</button>
              </td>
            
          
                
            </tr>
        <?php endwhile; ?>
            <tbody>
           </table>
          
        </section>
      </div>


<!-- EDIT MODAL -->    
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <form action="#" method="POST">
          <div class="modal-body">
            <input type="hidden" name="update_id" id="update_id">
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="uname" id="uname" class="form-control" autocomplete="off" disabled>
            </div>
             <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" id="email" class="form-control" autocomplete="off" disabled>
            </div>
            <div class="form-group">
              <label>Change password</label>
              <input type="password" name="pass" id="pass" class="form-control" autocomplete="off" >
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" name="update-submit" class="btn btn-primary">Update</button>
          </div>
          </form>
    </div>
  </div>
</div>
<!-- END OF DIVIDER -->

    </main>

<?php

  require "footer.php";
?>
<script>
    
    $(document).ready(function() {
      $('.editbtn').on('click',function(){

        $('#editmodal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);

          $('#uname').val(data[0]);
          $('#email').val(data[1]);

      });
    });
  </script>
