
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <body>

      <?php
      ob_start();

      require "header.php";
      require "includes/dbh.inc.php";
      require "includes/comments.inc.php";

      $cid = $_POST['cid'];
      $uid = $_POST['uid'];
      $date = $_POST['date'];
      $message = $_POST['message'];
      $movieRating = $_POST['movieRating'];
      $movieName = $_POST['movieName'];

      echo "
      <div class='w3-card w3-gray col-4 offset-md-4' style='margin-top:20px; margin-bottom: 20px; padding:20px;'>
      <form action='".editComments($conn)."' method='post' enctype='multipart/form-data'>
        <input type='hidden' name='cid' value='".$_POST['cid']."'>
        <input type='hidden' name='uid' value='".$_POST['uid']."'>
        <input type='hidden' name='date' value='".$_POST['date']."'>
        <input type='hidden' name='movieName' value='".$_POST['movieName']."'>

        <div class='w3-container form-group'>
          <h4>Movie Rating</h4>
          <input class='w3-input' type='number' name='movieRating' style='width:10%' min='1' max='5' value='".$_POST['movieRating']."' required>
        </div>
        <div class='w3-container form-group'>
          <textarea name='message' class='form-control' style='margin-top:20px' required>".$_POST['message']."</textarea>
        </div>
        <div class='w3-container form-group'>
          <button class='btn btn-primary btn-block' type='submit' name='editSubmit'>Edit</button>
        </div>
      </form>
      </div>";
	  header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php");
      ob_end_flush();
      ?>

  </body>
</html>
