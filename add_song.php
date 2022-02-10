<?php $page_title = 'The Cow Layer'; ?>
<?php
    $nav_selected = "LIST";
    $left_buttons = "NO";
    $left_selected = "";
  require 'db_credentials.php';
     include("./nav.php");
    
  ?>
  
<!DOCTYPE html>
<html>
<form id="addSong" action="add_the_song.php" method= "post">
<h1>Modify a movie
<p><input type = "text"  name= "movie_id" value=<?php echo $_GET["movie_id"]; ?> placeholder="movie_id" readonly="readonly"></p>
</h1>
<div class= "tab"> Add Song to movie:
  <p><textarea name= "new_songs" form="addSong" rows="10" cols="100" >
  </textarea></p>
</div>
<div style="overflow:auto;">
  <div  class="text-left">
           <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Add Song</button>
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


/* Mark the active step: Here are the steps*/
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid:
  This a demo */
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
    document.getElementById("addSong").submit();
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
