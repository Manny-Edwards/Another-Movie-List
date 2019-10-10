<?php
  require "header.php";
  require "includes/dbh.inc.php";
 ?>

  <main>
    <?php
      if (isset($_SESSION['userId'])) {
        echo '';
      }
      else {
        echo '';
      }

      if (isset($_GET['failure'])) {
        if ($_GET['failure'] == "nameError") {
          echo '<div class="w3-container w3-red"><p>Error in name field. Invalid Name. Please Register again.</p></div>';
        }
        else if ($_GET['failure'] == "emailError") {
          echo '<div class="w3-container w3-red"><p>Error in email field. Invalid Email. Please Register again.</p></div>';
        }
        else if ($_GET['failure'] == "usernameError") {
          echo '<div class="w3-container w3-red"><p>Error in username field. Invalid Username. Please Register again.</p></div>';
        }
        else if ($_GET['failure'] == "passwordError") {
          echo '<div class="w3-container w3-red"><p>Error in password field. Passwords do not match. Please Register again.</p></div>';
        }
        else if ($_GET['failure'] == "usernameUsed") {
          echo '<div class="w3-container w3-red"><p>This username already exists.</p></div>';
        }
        else if ($_GET['failure'] == "nouser") {
          echo '<div class="w3-container w3-red"><p>There is no user by this name. Please log in again.</p></div>';
        }
        else if ($_GET['failure'] == "wrongpass") {
          echo '<div class="w3-container w3-red"><p>Incorrect password. Please try again.</p></div>';
        }
        else if ($_GET['failure'] == "movieUsed") {
          echo '<div class="w3-container w3-red"><p>Error with this upload. Please try again later.</p></div>';
        }
      }
      if(isset($_GET['success'])){
        if ($_GET['success'] == "signup") {
          echo '<div class="w3-container w3-green"><p>You have signed up successfully. Welcome.</p></div>';
        }
        else if ($_GET['success'] == "login") {
          echo '<div class="w3-container w3-green"><p>You have logged in. Welcome.</p></div>';
        }
        else if ($_GET['success'] == "logout") {
          echo '<div class="w3-container w3-green"><p>You have logged out. Please come again.</p></div>';
        }
        else if ($_GET['success'] == "uploaded") {
          echo '<div class="w3-container w3-green"><p>The movie has been sucessfully uploaded!</p></div>';
        }
      }

     ?>

     <div id="movieTab" class="w3-container">
       <label><h3>Search Movie</h3></label>
       <input class="w3-input w3-border w3-hover-gray" id="filter-value" style="margin-bottom:5px" type="text">
       <div id="example-table" style="overflow:hidden"></div>
     </div>



     <script type="text/javascript">
        var dummyData = <?php
        $return_arr = array();
        $fetch = mysqli_query($conn,"SELECT * FROM movies");
        while ($row = mysqli_fetch_array($fetch)) {
            $row_array['id'] = $row['idMovies'];
            $row_array['name'] = $row['movieName'];
            $row_array['rating'] = $row['movieRating'];
            $row_array['image'] = $row['movieImage'];
            array_push($return_arr,$row_array);
        }
        echo json_encode($return_arr);
         ?>

      var inputVal = document.getElementById("filter-value").value
      //define Tabulator
      var table = new Tabulator("#example-table", {
         height:"75%",
         layout:"fitColumns",
         resizableColumns:false,
         columns:[
             {title:"Movies", field:"type"},
         ],
         rowFormatter:function(row){
             var element = row.getElement(),
             data = row.getData(),
             width = this.offsetWidth,
             rowTable, cellContents;

             while(element.firstChild) element.removeChild(element.firstChild);

             rowTable = document.createElement("table")
             rowTabletr = document.createElement("tr");
             cellContents = "<td><a href='movie.php?movieName="+ data.name +"'><img src='img/" + data.image + "' height='250px'></a></td>";
             cellContents += "<td><div class='w3-container w3-center w3-text-white'><strong>Name:</strong> " + data.name + "</div><div class='w3-container w3-center w3-text-white'><strong>Rating:</strong> " + data.rating + "</div></td>";

             rowTabletr.innerHTML = cellContents;
             rowTable.appendChild(rowTabletr);
             element.append(rowTable);
         },
      })
      table.setData(dummyData);
      function updateFilter(){
        var updateFilter = $("#filter-value").val();
        table.setFilter("name","like", $("#filter-value").val());
      }
      $("#filter-value").keyup(updateFilter);

     </script>
  </main>
