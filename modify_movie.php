<?php $page_title = 'The Cow Layer'; ?>
<?php
    $nav_selected = "LIST";
    $left_buttons = "NO";
    $left_selected = "";
  require 'db_credentials.php';
     include("./nav.php");
    $db = mysqli_connect('localhost','root','','OMDB');
    $movie_id = $_GET["movie_id"];
    
  ?>
  
<!DOCTYPE html>
<html>
<form id="movieModify" action="modifyTheMovies.php" method= "POST">

<h1>Modify a movie</h1>
<?PHP
    $sql = "SELECT * FROM movies WHERE movie_id = '$movie_id'";
    if (!$sql_A1_result= $db->query($sql)) {
      die('There was an error running query[' . $connection->error . ']');
    }

    if ($sql_A1_result->num_rows > 0) {
      $a1_tuple = $sql_A1_result->fetch_assoc();
      echo '<br> Movie ID : ' . $a1_tuple["movie_id"] .
        '<br> Native Name : ' . $a1_tuple["native_name"] .
        '<br> English Name : ' . $a1_tuple["english_name"] .
        '<br> Year Made :  ' . $a1_tuple["year_made"];
    } //end if
    else {
      echo "0 results";
    } //end else

    $sql_A1_result->close();
    ?>
<div class= "tab">
  <p><input name= "english_name_update" placeholder="Modify English Name" class="form-control" oninput="this.className = ''"></p>
  <p><input name= "year_update" class="form-control" placeholder="Modify Year" oninput="this.className = ''"></p>
  
Movie Data:
<?PHP

    $sql_A2 = "SELECT * FROM movie_data WHERE movie_id = '$movie_id'";

    if (!$sql_A2_result = $db->query($sql_A2)) {
      die('There was an error running query[' . $connection->error . ']');
    }

    if ($sql_A2_result->num_rows > 0) {
      $a2_tuple = $sql_A2_result->fetch_assoc();
      echo '<br> Language : ' . $a2_tuple["language"] .
        '<br> Country : ' . $a2_tuple["country"] .
        '<br> Genre :  ' . $a2_tuple["genre"];
        '<br> Plot :  ' . $a2_tuple["plot"];
    } //end if
    else {
      echo "0 results";
    }
    ?>
<p><input name= "language" placeholder="Language" oninput="this.className = ''"></p>
<p><input name= "country" placeholder="Country" oninput="this.className = ''"></p>
<p><input name= "genre" placeholder="Genre" oninput="this.className = ''"></p>
<p><input name= "plot" placeholder="Plot" oninput="this.className = ''"></p>
<p><input name= "tag_line" placeholder="Tag line" oninput="this.className = ''"></p>


Modify Trivia:
<?PHP

$sql_A5 = "SELECT * FROM movie_trivia WHERE movie_id = '$movie_id'";

if (!$sql_A5_result = $db->query($sql_A5)) {
die('There was an error running query[' . $connection->error . ']');
}

if ($sql_A5_result->num_rows > 0) {
$a5_tuple = $sql_A5_result->fetch_assoc();
echo '<br> Trivia id : ' . $a5_tuple["movie_trivia_id"] .
    '<br> Trivia : ' . $a5_tuple["movie_trivia_name"] ;

} //end if
else {
echo "0 results";
} //end else

$sql_A5_result->close();
?>

<p><textarea name= "trivia" form="movieModify" rows="10" cols="100" >
     </textarea></p>

Modify Media:
<?php

// query string for the Query A.1
$sql_A3 = "SELECT * FROM movie_media WHERE movie_id =  '$movie_id'";

if (!$sql_A3_result = $db->query($sql_A3)) {
  die('There was an error running query[' . $connection->error . ']');
}


if ($sql_A3_result->num_rows > 0) {
  // output data of each row
  while ($a3_tuple = $sql_A3_result->fetch_assoc()) {
    echo '<tr>
              <td>' . $a3_tuple["movie_media_id"] . '</td>
              <td>' . $a3_tuple["m_link"] . '</td>
              <td>' . $a3_tuple["m_link_type"] . ' </span> </td>
          </tr>';
  } //end while

} //end second if

$sql_A3_result->close();
?>
 Media link: <p><textarea name= "movie_link" form="movieModify" rows="10" cols="100" >
   </textarea></p>

  

Modify KeyWords:
<?PHP

$sql_A4 = "SELECT * FROM movie_keywords WHERE movie_id ='$movie_id'";

if (!$sql_A4_result = $db->query($sql_A4)) {
die('There was an error running query[' . $connection->error . ']');
}

if ($sql_A4_result->num_rows > 0) {
$a4_tuple = $sql_A4_result->fetch_assoc();
echo '<br> keyword : ' . $a4_tuple["keyword"] ;

} //end if
else {
echo "0 results";
} //end else

$sql_A4_result->close();
?>

   <p><textarea name= "movie_keyword" form="movieModify" rows="10" cols="100" >
   </textarea></p>

Modify Numbers:

<?PHP

$sql_A6 = "SELECT * FROM movie_numbers WHERE movie_id = '$movie_id'";

if (!$sql_A6_result = $db->query($sql_A6)) {
die('There was an error running query[' . $connection->error . ']');
}

if ($sql_A6_result->num_rows > 0) {
$a6_tuple = $sql_A6_result->fetch_assoc();
echo '<br> Movie Time : ' . $a6_tuple["running_time"] .
    '<br> Movie Budget : ' . $a6_tuple["budget"] .
    '<br> Box office : ' . $a6_tuple["box_office"] ;

}
else {
echo "0 results";
}
$sql_A6_result->close();
?>

   <p><input name= "running_time" placeholder="Movie Time" oninput="this.className = ''"></p>
   <p><input name= "budget" placeholder="Movie Budget" oninput="this.className = ''"></p>
   <p><input name= "box_office" placeholder="Movie Box Office" oninput="this.className = ''"></p>

Modify quotes:
<?PHP

$sql_A7 = "SELECT * FROM movie_quotes WHERE movie_id = '$movie_id'";

if (!$sql_A7_result = $db->query($sql_A7)) {
die('There was an error running query[' . $connection->error . ']');
}

if ($sql_A7_result->num_rows > 0) {
$a7_tuple = $sql_A7_result->fetch_assoc();
echo '<br> Quote ID : ' . $a7_tuple["movie_quote_id"] .
    '<br> Quote : ' . $a7_tuple["movie_quote_name"] ;

}
else {
echo "0 results";
}
$sql_A7_result->close();
?>

    <p><textarea name= "movie_quote" form="movieModify" rows="10" cols="100" >
   </textarea></p>

</div>
<div style="overflow:auto;">
  <div  class="text-left">
           <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Modify Movie</button>
  </div>
</div>
<div style="text-align:center;margin-top:40px;">
<span class="step"></span>
</div>

</form>
<style type="text/css">
#movieModify {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

/* Style the input fields */
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}


/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}
function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("movieModify").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}
function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>
</html>
