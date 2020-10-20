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
<!DOCTYPE html>
<html>
<form id="movieInfo" action="">
<h1>Create a movie</h1>

<div class="tab">Movie Name:
  <p><input name= "native_name" placeholder="Native Name" oninput="this.className = ''"></p>
  <p><input name= "english_name" placeholder="English Name" oninput="this.className = ''"></p>
  <p><input name= "year" placeholder="Year" oninput="this.className = ''"></p>
</div>
<?php
    echo "HERE";
          //$movie = mysqli_real_escape_string($db,$_POST['english_name']);
          //$native = mysqli_real_escape_string($db,$_POST['native_name']);
          //$year = mysqli_real_escape_string($db,$_POST['year']);
          $movie = $_POST['english_name'];
          $native = $_POST['native_name'];
          $year = $_POST['year'];
          
            $sql = "INSERT INTO movies (native_name, english_name, year_made)
                VALUES ( '$native' , '$movie', '$year' )";
    
                    mysqli_query($db, $sql);
                    ;
    ?>

<div class="tab">Movie Data:
  <p><input name= "language" placeholder="Language" oninput="this.className = ''"></p>
  <p><input name= "country" placeholder="Country" oninput="this.className = ''"></p>
  <p><input name= "genre" placeholder="Genre" oninput="this.className = ''"></p>
  <p><input name= "plot" placeholder="Plot" oninput="this.className = ''"></p>
  <p><input name= "tag_line" placeholder="Tag line" oninput="this.className = ''"></p>
</div>
<?php
echo "HERE";
      $language = mysqli_real_escape_string($db,$_POST['language']);
      $country = mysqli_real_escape_string($db,$_POST['country']);
      $genre = mysqli_real_escape_string($db,$_POST['genre']);
      $plot = mysqli_real_escape_string($db,$_POST['plot']);
      $tag_line = mysqli_real_escape_string($db,$_POST['tag_line']);
        $sql = "INSERT INTO movie_data (language, country, genre, plot, tag_line)
            VALUES ( '$language' , '$country', '$genre', '$plot', '$tag_line' )";

                mysqli_query($db, $sql);
                ;
?>

<div class="tab">Movie Trivia:
  <p><input name= "trivia" placeholder="Trivia" oninput="this.className = ''"></p>
</div>
<?php
echo "HERE";
      $trivia = mysqli_real_escape_string($db,$_POST['trivia']);
      
        $sql = "INSERT INTO movie_trivia (trivia)
            VALUES ( '$trivia' )";

                mysqli_query($db, $sql);
                ;
?>

<div class="tab">Movie Media:
  <p><input name= "movie_link" placeholder="Movie link" oninput="this.className = ''"></p>
  <p><input name= "movie_link_type" placeholder="Link type" oninput="this.className = ''"></p>
</div>
<?php
echo "HERE";
      $movie_link = mysqli_real_escape_string($db,$_POST['movie_link']);
      $movie_link_type = mysqli_real_escape_string($db,$_POST['movie_link_type']);

        $sql = "INSERT INTO movies_data (m_link, m_link_type)
            VALUES ( '$language' , '$country', '$genre', '$plot', '$tag_line' )";

                mysqli_query($db, $sql);
                ;
?>

<div style="overflow:auto;">
  <div style="float:right;">
    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
  </div>
</div>

<div style="text-align:center;margin-top:40px;">
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
</div>
<style type="text/css">
#regForm {
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

</html>
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
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
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
