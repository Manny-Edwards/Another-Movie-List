<?php
  require "header.php";
  require "includes/dbh.inc.php";
  require "includes/comments.inc.php";
  date_default_timezone_set('America/New_York');

 ?>
 <?php
  $movie = $_GET['movieName'];
  $sql = "SELECT * FROM movies WHERE movieName = '$movie'";
  $result = mysqli_query($conn, $sql);
  $movies = mysqli_fetch_array($result);

  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

  <body>
    <div class="w3-card col-4 offset-md-4" style="margin-top:20px;">

      <div class="w3-container">
        <h1 class="w3-center"><?php echo $movies['movieName']; ?></h1>

      </div>
      <div class="w3-container w3-center">
        <img src="img/<?php echo $movies['movieImage']; ?>" height="600" align="middle">
      </div>

      <div class="w3-container">
        <h3 class="w3-center">Average rating:
        <?php echo $movies['movieRating']; ?></h3>
      </div>

      <div class="w3-container">
        <p><?php echo $movies['movieBio']; ?></p>
      </div>

    </div>

    <div class="w3-card w3-blue col-4 offset-md-4" style="margin-top:20px; margin-bottom: 20px; padding:20px;">
      <?php

      $movie = $movies['movieName'];


      if (isset($_SESSION['userId'])) {
        $user = $_SESSION['userUId'];
        if (commented($conn,$movie,$user) == False) {
          echo "
          <form action='".setComments($conn)."' method='post' enctype='multipart/form-data'>
            <input type='hidden' name='uid' value='$user'>
            <input type='hidden' name='movie' value='$movie'>
            <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>

            <div class='w3-container form-group'>
              <h4>Movie Rating 1-5</h4>
              <input class='w3-input' type='number' name='movieRating' style='width:10%' min='1' max='5' value='5' required>
            </div>
            <div class='w3-container form-group'>
              <textarea name='message' class='form-control' style='margin-top:20px' required></textarea>
            </div>
            <div class='w3-container form-group'>
              <button class='btn btn-primary btn-block' type='submit' name='commentSubmit'>Comment</button>
            </div>
          </form>";
        }

      }
      else {
        $user = NULL;
      }
      getComments($conn,$movie,$user);

      ?>
    </div>
  </body>
</html>
