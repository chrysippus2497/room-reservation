<?php 

	require "header.php";
	require "includes/dbh.inc.php";
	require "forgotpassword.inc.php";

?>
<?php

              if(!isset($_GET["code"]))
              {               
                  exit("There was an error loading the page you requested.");
         	  }
         	  $pwdResetSelector = $_GET["code"];        	  
           $mysqli = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem') or die (mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM pwdreset") or die ($mysqli->error);
         	  if(mysqli_num_rows($result) === 0)

         	  {
         	  	 exit("There was an error loading the page you requested.");
         	  }


         	  if(isset($_POST['reset-pwd-submit']) && isset($_POST["password"]))
         	  {
         	  	$password = password_hash($_POST["password"],PASSWORD_DEFAULT);
         	  	

         	  	$row = $result->fetch_assoc();
         	  	$email = $row["pwdResetEmail"];


         	  	$sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?";

              $stmt = $conn->prepare($sql);

              $stmt->bind_param('ss', $password, $email);
              $stmt->execute();

              if ($stmt->error) {
                echo "FAILURE!!! " . $stmt->error;
              }
              else echo "Updated {$stmt->affected_rows} rows";

              $stmt->close();

         	  	if($sql)
         	  	{
         	  		$sql = mysqli_query($conn, "DELETE FROM pwdreset WHERE pwdResetSelector = '$pwdResetSelector'");
         	  		header("Location: successresetpassword.php?pwdreset=success");
         	  		echo "Your password has been updated!";
         	  		exit();
         	  	}
         	  	else
         	  		header("Location: resetpassword.php?pwdreset=error");
         	  }
   ?> 

 <main>
      <div class="wrapper-main">
        <section class="section-default">
          <h1>Reset password </h1><br>
          <center>
           
           <form class="form-reserve" action="" method="post">
            <input type="password" name="password" placeholder="New password" autocomplete="off" required>
            <button type="submit" name="reset-pwd-submit">reset password</button>
          </form>
          </center> 

          
             

          
        </section>
      </div>

    </main>







<?php

  require "footer.php";
?>
