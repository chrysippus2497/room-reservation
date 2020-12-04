<?php
  
  require "adminheader.php";
  
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">
       
          <?php
          if (!isset($_SESSION['id'])) {
            echo '<p class="login-status">Please login admin!</p>';
          }
          else if (isset($_SESSION['id'])) {
            echo '<h3><center><p class="login-status">Welcome</p>'.$_SESSION['uid'];

          }
          ?>





        </section>
      </div>
    </main>

<?php

  require "adminfooter.php";
?>
