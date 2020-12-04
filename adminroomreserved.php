
<?php
  require "adminheader.php";
  
?>
<?php 

if(!isset($_SESSION['id'])){
  header('location: index.php');
}
  
?>


<?php 

      $connection = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem');
      $query = "SELECT * FROM roomreserve";
      $query_run = mysqli_query($connection, $query);

    




?>


           <!-- EDIT MODAL -->


<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit user data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <form action="adminincludes/editcode.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="update_id" id="update_id">
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" id="name" class="form-control" autocomplete="off" required="">
            </div>
             <div class="form-group">
              <label>Room</label>
              <input type="text" name="room" id="room" class="form-control" autocomplete="off" required="">
            </div>
             <div class="form-group">
              <label>Reserve starts</label>
              <input type="text" name="datetime" id="datetime" class="form-control" autocomplete="off" required="" >
            </div>  
            <div class="form-group">
              <label>Reserve ends</label>
              <input type="text" name="roomexpire" id="roomexpire" class="form-control" autocomplete="off" required="">
            </div>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" name="edit-submit" class="btn btn-primary">Update</button>
          </div>
          </form>
        </div>
      </div>
    </div>


<!-- END OF DIVIDER -->


<main>
  <div class="container">
  <div class="row justify-content-center">
    <section class="section-default">
      <center>
      <h2>Room reserved </h2> 
      
      <br><br>
    </center>
       
          
          <table id="datatableid"class="table table-bordered table-dark table-sm">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Room</th>
        <th scope="col">Reserve starts in </th>
        <th scope="col">Reserve expires in</th>
        <th scope="col">Code</th>
        <th scope="col">Status</th>
        <th scope="col">Transaction time</th>


      </tr>
    </thead>
    <tbody>
      <?php 

      if(mysqli_num_rows($query_run) > 0)
      {
        while($row = mysqli_fetch_assoc($query_run))
        {
          ?>

      <tr>
              <td><?php echo $row['id']?></td>
              <td><?php echo $row['name']?></td>
              <td><?php echo $row['room']?></td>
              <td><?php echo $row['datetime']?></td>
              <td><?php echo $row['roomexpire']?></td>
              <td><?php echo $row['reserve_code']?></td>
              <td><?php echo $row['status']?></td>
              <td><?php echo $row['transaction_time']?></td>
              
      </tr>
      <?php   
        }
      }
      else{

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
      $('.editbtn').on('click',function(){

        $('#editmodal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);


          $('#update_id').val(data[0]);
          $('#name').val(data[1]);
          $('#room').val(data[2]);
          $('#datetime').val(data[3]);
          $('#roomexpire').val(data[4]);

      });
    });
  </script>
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

  require "adminfooter.php";

  ?>
