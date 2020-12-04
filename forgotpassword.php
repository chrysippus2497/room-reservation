<?php
  require "header.php";
  require "includes/dbh.inc.php";
?>
<?php 

if(isset($_POST['email'])){

  $email = $_POST['email'];
}

?>
    
 <main>
      <div class="wrapper-main">
        <section class="section-default">
          <h1>Enter your e-mail address </h1><br>
          <center>
           An e-mail will be send to you with instructions on how to reset your password.
           <form class="form-reserve" action="forgotpassword.inc.php" method="post">
            <input type="text" name="email" placeholder="Enter email address..."  required>
            <button type="submit" name="reset-forgotpassword-submit">send</button>
          </form>
          </center> 
          <?php

              if(isset($_GET["request"]))
              {
                if($_GET["request"] == "success")
                {
                  echo '<center><p class="resetsuccess">Check your e-mail!</p></center>';
                }
              }
          ?>
          
             

          
        </section>
      </div>

    </main>

<?php

  require "footer.php";
?>
