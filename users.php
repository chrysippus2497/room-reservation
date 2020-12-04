
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
	$query = "SELECT * FROM users";
	$query_run = mysqli_query($connection, $query);


?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registration Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php
       if(isset($_GET["error"]))
              {
                if($_GET["error"] == "usernametaken")
                {
                  echo  '<script> alert("Invalid Username or Email address!"); </script>';
                }
              }


        ?>
		      <form action="adminincludes/addusercode.php" method="POST">
		      <div class="modal-body">
		        <div class="form-group">
		        	<label>Username</label>
		        	<input type="text" name="uname" class="form-control" autocomplete="off" required="">
		        </div>
		         <div class="form-group">
		        	<label>Email</label>
		        	<input type="email" name="email" class="form-control" autocomplete="off" required="">
		        </div>
		         <div class="form-group">
		        	<label>Password</label>
		        	<input type="password" name="pass" class="form-control" autocomplete="off" required="">
		        </div>

            <div class="form-group" >
                <label>User-type</label>
                <select name="usertype" id="" class="form-control">
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
            </div>
		      
          </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
		        <button type="submit" name="register-submit" class="btn btn-primary">Register</button>
		      </div>
		      </form>

    </div>
  </div>
</div>


<main>
<div class="container">
  <div class="row justify-content-center">
    <section class="section-default">
    		<center>
    		<h2> Users </h2><br><br>
    		</center>


	<table id="datatableid" class="table table-bordered table-dark table-sm">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Username</th>
				<th scope="col">Email</th>
        <th scope="col">User Type</th>
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
				<td><?php echo $row['idUsers']; ?></td>
				<td><?php echo $row['uidUsers']; ?></td>
				<td><?php echo $row['emailUsers']; ?></td>
        <td><?php echo $row['user_type']; ?></td>
				<td>
					<button type="submit"class="btn btn-outline-info btn-sm editbtn">EDIT</button>
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
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add User
</button>
</section>
<br><br>
</div>
</div>


<!-- DIVIDER -->
<!--EDIT POP UP FORM-->

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit user data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		      <form action="adminincludes/updatecode.php" method="POST">
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
             <div class="form-group" >
                <label>User-type</label>
                <select name="usertype" id="usertype" class="form-control">
                  <option value="user">user</option>
                  <option value="admin">admin</option>
                </select>
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





<!-- DIVIDER -->
<!--DELETE POP UP FORM-->

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete user data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		      <form action="adminincludes/deletecode.php" method="POST">
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

  require "adminfooter.php";

  ?>


  <!-- Edit button function -->

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
  				$('#uname').val(data[1]);
  				$('#email').val(data[2]);
  				$('#pass').val(data[3]);

  		});
  	});
  </script>


  <!-- Delete button function -->

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
  	
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

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


