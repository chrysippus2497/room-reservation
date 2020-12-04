<?php
include'adminheader.php';

?>

<?php 

  $connection = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem');
  $query = "SELECT * FROM roomreserve WHERE status = 'ENDED'";
  $query_run = mysqli_query($connection, $query);



?>

<!-- <?php 
        date_default_timezone_set('Asia/Manila');
        $date = date("Y-m-d G:i");
    
?> -->



<main>
	<div class="container">
	<div class="row justify-content-center">
	<section class="section-default">
    <center>
    <h2>Ended Room reserved </h2> 
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
        <th scope="col">Action</th>
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


                <td>
                <button type="submit"class="btn btn-outline-danger btn-sm deletebtn">DELETE</button>
                </td>
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
 <!--DELETE POP UP FORM-->

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <form action="deleteendedreserved.php" method="POST">
          <div class="modal-body">
          <input type="hidden" name="delete_id" id="delete_id">
          <center> 
          <h4>Are you sure?</h4>

          <h6 >Do you really want to delete these recrods? This process cannot be undone.</h6>
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
   




</section>
</div>
</div>
</main>




  <?php

  require "adminfooter.php";

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