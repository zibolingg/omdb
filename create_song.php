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
<h1>Add a song</h1>


<form method="post" action="post_create_song.php">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
    </div>
  <div class="form-group">
    <label for="lyrics">Lyrics</label>
    <input type="text" name="lyrics" class="form-control" id="lyrics" placeholder="Enter Lyrics">
  </div>

  <div class="form-group">
    <label for="theme">Theme</label>
    <input type="text" name="theme" class="form-control" id="theme" placeholder="Enter Theme">
  </div>

  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
            <hr/>



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

</html>
