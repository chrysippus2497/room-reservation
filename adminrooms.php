
<?php
  require "adminheader.php";
  require "adminincludes/dbh.inc.php";
?>
<?php 

if(!isset($_SESSION['id'])){
  header('location: index.php');
}
  
?>
  <?php 

         $conn = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem');
         $result = $conn->query("SELECT * FROM rooms") or die ($conn->error);

  ?>   
        <?php 
      if(isset($_POST['update-submit']))
        {
        $conn = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem');
        $id = $_POST['update_id'];

        $name = $_POST['name'];
        $status = $_POST['status'];

        $query = "UPDATE rooms SET room_name = '$name', room_status = '$status' WHERE room_id = '$id'";
        $query_run = mysqli_query($conn,$query);
        if($query_run)
        {
          header("Location: adminrooms.php");

        }
        else
        {
          echo '<script> alert("There was a problem updating a room!"); </script>';
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
              <th>ID</th>
              <th>Room name</th>
              <th>Image </th>
              <th>Status</th>
              <th>Action</th>
           </tr>
           </thead>
           <tbody>
            
        <?php while ($row = $result->fetch_assoc()):?>
            <tr>
              <td><?php echo $row['room_id']?></td>
              <td><?php echo $row['room_name']?></td>
              <td><?php echo "<a href='rooms/".$row['room_image']."'</a>";?>View image</td> 
              <td><?php echo $row['room_status']?></td>
              <td>
                <button type="submit"class="btn btn-outline-info btn-sm editbtn">EDIT</button>
                <button type="submit"class="btn btn-outline-danger btn-sm deletebtn">DELETE</button>
              </td>
                        
            </tr>
        <?php endwhile; ?>
            </tbody>
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
        <h5 class="modal-title" id="exampleModalLabel">EDIT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <form action="" method="POST">
          <div class="modal-body">
            <input type="hidden" name="update_id" id="update_id">
            <div class="form-group">
              <label>ROOM</label>
              <input type="text" name="name" id="name" class="form-control" autocomplete="off" >
           </div>
           <div class="form-group">
                <label>STATUS</label>
                <select name="status" id="status" class="form-control">
                  <option value="AVAILABLE">AVAILABLE</option>
                  <option value="OCCUPIED">OCCUPIED</option>
                  <option value="RESERVED">RESERVED</option>
                  <option value="CLOSED">CLOSED</option>
                </select>
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
</div>
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete user data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <form action="adminroomsdeletecode.php" method="POST">
          <div class="modal-body">
          <input type="hidden" name="delete_id" id="delete_id">
          <center> 
          <h4>Are you sure?</h4>

          <h6 >Do you really want to delete these records? This process cannot be undone.</h6>
          </center>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" name="delete-submit" class="btn btn-danger">Yes</button>
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
      $('.deletebtn').on('click',function(){

        $('#deletemodal').modal('show');





          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);


          $('#delete_id').val(data[0]);
          

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

          $('#update_id').val(data[0]);
          $('#name').val(data[1]);
          $('#status').val(data[2]);
          $('#status').val(data[3]);


      });
    });
  </script>
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
 











