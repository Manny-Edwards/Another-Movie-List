<?php
  require "header.php";
 ?>
 <?php
 if (isset($_GET['failure'])) {
   if ($_GET['failure'] == "uploadError") {
     echo '<div class="w3-container w3-red"><p>Failed to add the movie. Please try again.</p></div>';
   }
   else if ($_GET['failure'] == "usernameUsed") {
     echo '<div class="w3-container w3-red"><p>Failed to add the movie. This movie already exists on the list, try again.</p></div>';
   }
 }
 else if(isset($_GET['success'])){
     if ($_GET['success'] == "upload") {
       echo '<div class="w3-container w3-green"><p>The movie has been added successfully.</p></div>';
     }
   }
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

  <body>
    <div class="w3-card col-4 offset-md-4" style="margin-top:20px;">
      <form action="http://manassehedwardsportfolio-com.stackstaging.com/includes/movie.inc.php" method="post" enctype="multipart/form-data">
        <div class="form-group text-center">
          <input class="w3-input w3-xlarge" type="text" placeholder="Movie Name" name="movieName" id="movieName" style="width:100%; text-align:center" value="" required>
        </div>
        <div class="form-group">
          <img src="img/default.jpg" id="imageDisplay" onclick="triggerClick()" style="display:block; size:50%; margin: 10px auto">
          <input type="file" name="movieImage" onchange="displayImage(this)" id="movieImage" style="display:none" required>
        </div>
        <div class="form-group">
          <label for="movieName">Movie Rating</label>
          <input class="w3-input" type="number" placeholder="Movie Rating" name="movieRating" id="movieRating" style="width:10%" min="1" max="5" value="5" required>
        </div>
        <div class="form-group">
          <label for="Bio">Synopsis</label>
          <textarea name="bio"  id="bio" class="form-control" required></textarea>
        </div>
        <div class="form-group text-center">
          <button type="submit" name="saveMovie" class="btn btn-primary btn-block">Save Movie</button>
        </div>
      </form>
    </div>

    <script type="text/javascript">
      function triggerClick(){
        document.querySelector('#movieImage').click();
      }
      function displayImage(e){
        if (e.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e){
            document.querySelector('#imageDisplay').setAttribute('src', e.target.result);
          }
          reader.readAsDataURL(e.files[0]);
        }
      }
    </script>
  </body>
</html>
