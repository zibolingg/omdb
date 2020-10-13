<?php $page_title = 'The Cow Layer'; ?>
<?php
    $nav_selected = "LIST";
    $left_buttons = "NO";
    $left_selected = "";
    
  require 'db_credentials.php';
     include("./nav.php");
  ?>
  <?php
      $mysqli = NEW MySQLi('localhost','root','','OMDB');
     
?>
<form action="createTheMovie.php" method="POST" enctype="multipart/form-data">
<br>
<h3 id="title">Create A Movie</h3> <br>
<table>
  
    <tr>
        <td style="width:100px">Movie English Name:</td>
        <td><input type="text"  name="movie" class="form-control" maxlength="180" size="180" required title="Please enter a movie name."></td>
    </tr>
    <tr>
        <td style="width:100px">Native Name:</td>
        <td><input type="text"  name="native" class="form-control" maxlength="180" size="180" required title="Please enter the native name."></td>
    </tr>
   
    <tr>
        <td style="width:100px">Year:</td>
        <td><input type="text"  name="year" class="form-control" maxlength="4" size="10" required title="Please enter the year of the movie."></td>
    </tr>
 
  
</table>
<br><br>
        <div align="center" class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Create Movie</button>
        </div>
        <br> <br>

    </form>
</div>
