<?php
  ob_start();
  require 'dbh.inc.php';

  function setComments($conn){
    if (isset($_POST['commentSubmit'])) {
      $uid = $_POST['uid'];
      $date = $_POST['date'];
      $message = $_POST['message'];
      $movieName = $_POST['movie'];
      $movieRating = $_POST['movieRating'];

      $sql = "INSERT INTO comments (uid, date, message, movieName, movieRating) VALUES ('$uid','$date','$message','$movieName', $movieRating)";
      $result = mysqli_query($conn, $sql);
    }
  }
  function getComments($conn,$movieName,$user){
    $sql = "SELECT * FROM comments";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
      if ($row['movieName'] == $movieName) {
        echo "<div class='w3-container w3-hover-shadow w3-text-black' style='margin-top:10px; margin-bottom:10px; border-radius:5px; background-color:#fff; font-family:verdana; font-size:14px; line-height:16px; font-weight:100'><p>";
          echo $row['uid']."<br>";
          echo $row['date']."<br><br>";
          echo "Rating:".$row['movieRating']."<br>";
          echo nl2br($row['message'])."<br>";
          if ($user != NULL) {
            if($row['uid'] == $user || $user == "Admin"){
              echo "</p>
                <form method='POST' action='".deleteComments($conn)."'>
                  <input type='hidden' name='movieName' value='".$row['movieName']."'>
                  <input type='hidden' name='cid' value='".$row['cid']."'>
                  <button type='submit' class='w3-btn w3-black' name='commentDelete'>Delete</button>
                </form>
                <form method='POST' action='commentEdit.php'>
                  <input type='hidden' name='cid' value='".$row['cid']."'>
                  <input type='hidden' name='uid' value='".$row['uid']."'>
                  <input type='hidden' name='date' value='".$row['date']."'>
                  <input type='hidden' name='message' value='".$row['message']."'>
                  <input type='hidden' name='movieRating' value='".$row['movieRating']."'>
                  <input type='hidden' name='movieName' value='".$row['movieName']."'>
                  <button class='w3-btn w3-black'>Edit</button>
                </form>
              </div>";
            }
            else {
              echo "</p></div>";
            }
          }
          else {
            echo "</p></div>";
          }


      }
    }
  }
  function editComments($conn){
    if (isset($_POST['editSubmit'])) {
      $cid = $_POST['cid'];
      $uid = $_POST['uid'];
      $date = $_POST['date'];
      $message = $_POST['message'];
      $movieName = $_POST['movieName'];
      $movieRating = $_POST['movieRating'];

      $sql = "UPDATE comments SET message='$message', movieRating='$movieRating' WHERE cid='$cid'";
      $result = mysqli_query($conn, $sql);
      header("Location: ../movie.php?movieName=$movieName");
    }
  }
  function deleteComments($conn){
    if (isset($_POST['commentDelete'])) {
      $cid = $_POST['cid'];
      $movieName = $_POST['movieName'];
      $sql = "DELETE FROM comments WHERE cid='$cid'";
      $result = mysqli_query($conn, $sql);
      echo "<div class='w3-red'>This comment has been deleted.</div><br>";
      echo "<a href='movie.php?movieName=$movieName' class='w3-button w3-black' style='margin-bottom:10px;'>Ok</a><br>";
      exit();
    }

  }
  function commented($conn,$movieName,$user){
    $sql = "SELECT * FROM comments";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
      if ($row['movieName'] == $movieName) {
        if ($row['uid'] == $user) {
          return True;
        }
      }
    }
    return False;
  }
  ob_end_flush();
