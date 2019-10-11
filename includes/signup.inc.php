<?php
if (isset($_POST['register-submit'])) {

  require 'dbh.inc.php';
  $firstnameErr = $lastnameErr = $usernameErr = $emailErr = $passwordRepeatErr = "";


  $firstname = $_POST['Fname'];
  $lastname = $_POST['Lname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordRepeat = $_POST['password-repeat'];

    // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z]*$/",$firstname)) {
      $nameErr = "Only letters allowed";
      header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=nameError");
      exit();
  }
  if (!preg_match("/^[a-zA-Z]*$/",$lastname)) {
      $nameErr = "Only letters allowed";
      header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=nameError");
      exit();
  }
    // check if e-mail address is well-formed
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
    header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=emailError");
    exit();
  }
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $usernameErr = "Invalid username format";
    header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=usernameError");
    exit();
  }
  elseif ($password !== $passwordRepeat) {
    $passwordRepeatErr = "Your passwords do not match";
    header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=passwordError");
    exit();
  }
  else {
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      $usernameErr = "This username already exists";
      header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=usernameUsed");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        $usernameErr = "This username already exists";
        header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=usernameUsed");
        exit();
      }
      else {
        $sql = "INSERT INTO users (fnameUsers, lnameUsers, uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          $usernameErr = "This username already exists";
          header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?failure=usernameUsed");
          exit();
        }
        else {
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $username, $email, $hashedPwd);
          mysqli_stmt_execute($stmt);

          $msg = "<h1>Hi There!</h1>\nThank you for making an account. We hope you enjoy your experience!";
          mail($email,"Signup_Verification",$msg);

          header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?success=signup");
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php");
  exit();
}
