<?php
session_start();
// Here we check whether the user got to this page by clicking the proper login button.
if (isset($_POST['login-submit'])) {

  // We include the connection script so we can use it later.
  // We don't have to close the MySQLi connection since it is done automatically, but it is a good habit to do so anyways since this will immediately return resources to PHP and MySQL, which can improve performance.
  require 'dbh.inc.php';
  require '../user_type.php';

  // We grab all the data which we passed from the signup form so we can use it later.
  $mailuid = $_POST['uname'];
  $password = $_POST['pass'];

  // Then we perform a bit of error handling to make sure we catch any errors made by the user. Here you can add ANY error checks you might think of! I'm just checking for a few common errors in this tutorial so feel free to add more. If we do run into an error we need to stop the rest of the script from running, and take the user back to the login form with an error message.

  // We check for any empty inputs. (PS: This is where most people get errors because of typos! Check that your code is identical to mine. Including missing parenthesis!)
  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields&mailuid=".$mailuid);
    exit();
  }
  else {

    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
  
    $stmt = mysqli_stmt_init($conn);
  
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      // Then we execute the prepared statement and send it to the database!
      mysqli_stmt_execute($stmt);
      // And we get the result from the statement.
      $result = mysqli_stmt_get_result($stmt);
      // Then we store the result into a variable.
      if ($row = mysqli_fetch_assoc($result)) {
        // Then we match the password from the database with the password the user submitted. The result is returned as a boolean.
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        // If they don't match then we create an error message!
        if ($pwdCheck == false) {
          // If there is an error we send the user back to the signup page.
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        // Then if they DO match, then we know it is the correct user that is trying to log in!
        else if ($pwdCheck == true) {

          // Next we need to create session variables based on the users information from the database. If these session variables exist, then the website will know that the user is logged in.

          // Now that we have the database data, we need to store them in session variables which are a type of variables that we can use on all pages that has a session running in it.
          // This means we NEED to start a session HERE to be able to create the variables!
          session_start();
          // And NOW we create the session variables.
          $_SESSION['id'] = $row['idUsers'];
          $_SESSION['uid'] = $row['uidUsers'];
          $_SESSION['email'] = $row['emailUsers'];
          // Now the user is registered as logged in and we can now take them back to the front page! :)
          header("Location: ../index.php?login=success");
          exit();
        }
      }
      else {
        header("Location: ../index.php?login=wronguidpwd");
        exit();
      }
    }
  }
  // Then we close the prepared statement and the database connection!
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

/*$connection = mysqli_connect("localhost", "root", "", "loginsystem");

if(isset($_POST['login-submit']))
{

  $query = "SELECT * FROM users WHERE uidUsers = '$mailUid', pwdUsers = '$password'";
  $query_run = mysqli_query($connection,$query);
  $usertypes = mysqli_fetch_array($query_run)
  if($usertypes == "admin")
  {
    header("location: ")
  }
}*/
?>