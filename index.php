<?php
  require "header.php";
  include ('includes/dbh.inc.php');

  if(isset($_SESSION['id']) && isset($_SESSION['user_type']))
  {

  $id = $_SESSION['id'];
  
  $mysqli = new mysqli('localhost','id12292815_root', 'password', 'id12292815_loginsystem') or die (mysqli_error($mysqli));
  $result = $mysqli->query("SELECT user_type FROM users WHERE idUsers = $id ") or die ($mysqli->error);
  $row = $result->fetch_assoc();

    if($row['user_type'] == "admin")
    {
      header("Location: ..adminindex.php");
    }
  
  }
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">
       
          <?php
          if (!isset($_SESSION['id'])) {
            echo '<p class="login-status">You are logged out!</p>';
          }
          else if (isset($_SESSION['id'])) {
            echo '<p class="login-status">You are now logged in!</p>';
            echo '<h3><center><p class="login-status">Welcome </p>'. $_SESSION['uid'];

          }
          ?>





        </section>
      </div>
    </main>

<?php

  require "footer.php";
?>
