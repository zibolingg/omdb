<?php $page_title = 'The Cow Layer'; ?>
<?php
    $nav_selected = "LIST";
    $left_buttons = "NO";
    $left_selected = "";
  require 'db_credentials.php';
     include("./nav.php");
    
  ?>
  <?php
  if (isset($_GET['movie_id'])) {
    $movie_id = mysqli_real_escape_string($db, $_GET['movie_id']);
      echo $movie_id;
  }
  ?>
<div class="right-content">
<div class="container">
  <h3 style="color: #01B0F1;">Movies Modify</h3>

<form action="modifyTheMovies.php" method= "get">
Modify native name: <input type="text" name="native_name_update">
Modify english name: <input type="text" name="english_name_update">
Modify year: <input type="text" name="year_update">
<input type= "submit" value="Submit">
</div>
</form>
