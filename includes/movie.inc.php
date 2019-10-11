<?php
  if (isset($_POST['saveMovie'])) {
    require 'dbh.inc.php';
	ob_start();
    
    echo "<pre>", print_r($_POST), "</pre>";
    echo "<pre>", print_r($_FILES), "</pre>";
    echo "<pre>", print_r($_FILES['movieImage']), "</pre>";
    $movieName = $_POST['movieName'];
    $bio = $_POST['bio'];
    $bio = str_replace("'","''", $bio);
    $movieRating = $_POST['movieRating'];
    $movieImageName = time(). '_' . $_FILES['movieImage']['name'];
    $target = '../img/' . $movieImageName;
    if (move_uploaded_file($_FILES['movieImage']['tmp_name'], $target)) {
      echo "ok";
      $sql = "SELECT movieName FROM movies WHERE movieName=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        $usernameErr = "This movie already exists";
        header("Location: ../movieEdit.php?failure=movieUsed");
      }
      else {
        mysqli_stmt_bind_param($stmt, "s", $movieName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
          $usernameErr = "This movie already exists";
          header("Location: ../index.php?failure=movieUsed");
        }
        else {
          $sql = "INSERT INTO movies (movieImage, movieBio, movieName, movieRating) VALUES (?, ?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            $usernameErr = "This movie already exists";
            header("Location: ../index.php?failure=movieUsed");
          }
          else {
            mysqli_stmt_bind_param($stmt, "ssss", $movieImageName, $bio, $movieName, $movieRating);
            mysqli_stmt_execute($stmt);
            header("Location: ../index.php?success=uploaded");
            
          }
        }
      }
    }
    else {
    header("Location: http://manassehedwardsportfolio-com.stackstaging.com/movieEdit.php");
  }
  }
