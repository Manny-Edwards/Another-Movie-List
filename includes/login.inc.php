<?php

if (isset($_POST['login-submit'])) {

  require 'dbh.inc.php';

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (true) {
    $sql = "SELECT * FROM users WHERE uidUsers=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $passCheck = password_verify($password, $row['pwdUsers']);
        if ($passCheck == false) {
          header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=wrongpass");
          exit();
        }
        elseif ($passCheck == true) {
          session_start();
          $_SESSION['userFname'] = $row['fnameUsers'];
          $_SESSION['userLname'] = $row['lnameUsers'];
          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userUId'] = $row['uidUsers'];
          $_SESSION['userEmail'] = $row['emailUsers'];
          $_SESSION['Admin'] = $row['Admin'];


          header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?success=login");
          exit();
        }
        else {
          header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=wrongpass");
          exit();
        }
      }
      else {
        header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=nouser");
        exit();
      }

    }
  }

}
else {
  header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php");
  exit();
}
