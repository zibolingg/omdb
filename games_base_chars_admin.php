<?php
  $nav_selected = "GAMES";
  $left_buttons = "YES";
  $left_selected = "ANAGRAMADMIN";

  include("./nav.php");
  
 ?>

<!DOCTYPE html>
<html>
<form id="basecharAdmin" action="games_base_chars_admin.php" method= "POST">

<h2>Welcome to the Base Characters Game!</h1>
<h4>Enter a word to find its base characters and all the movies that contain them.</h3>

<?php
if (isset($_POST['basecharinput']) && !empty($_POST['basecharinput'])){
    $basecharinput = $_POST['basecharinput'];
    $basecharJSON = strtolower(str_replace(" ", "", $basecharinput));
      
    //Make API call to find base_chars
    $jsonLog = "http://indic-wp.thisisjava.com/api/getBaseCharacters.php?string=".$basecharJSON."&language=Telugu";
    $jsonfile = file_get_contents($jsonLog);
    $decodedData = json_decode(strstr($jsonfile, '{'));
    $base_chars = implode(", ", $decodedData->data);
    echo "<p>The base characters of ".$basecharinput." are: ";

    echo "<b style='color:red'>".implode(", ", $decodedData->data)."</b>";
    echo "</p>";
   }
?>

<div class= "tab">
  <p><input name= "basecharinput" placeholder="Enter a word to play!" class="form-control" ></p>
<div style="overflow:auto;">
  <div  class="text-left">
           <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Go!</button>
  </div>
</div>
<br>
<table id="info" cellpadding="0" cellspacing="0" border="0"
    class="datatable table table-striped table-bordered datatable-style table-hover"
    width="100%" style="width: 100px;">
      <thead>
        <tr id="table-first-row">
                <th>id</th>
                <th>Native Name</th>
                <th>English Name</th>
                <th>Year </th>

        </tr>
      </thead>

      <tbody>

      <?php

if(isset($base_chars)){
    $query_conditions = [];
    $count = count($decodedData->data);
    foreach ($decodedData->data as $datum){
        if($count > 1){
           $query_conditions[] = "native_name like '%".$datum."%' and";
          $count = $count - 1;
        } else {
            $query_conditions[] = "native_name like '%".$datum."%'";
        }
     }
    $query_string = implode(" ", $query_conditions);
    
$sql = "SELECT * from movies where ".$query_string." ORDER BY year_made ASC;";

$db->set_charset("utf8");

$result = $db->query($sql);
        header('Content-type: text/html; charset=utf-8');
        if(isset($_GET['create'])){
                   if($_GET["create"] == "Success"){
                       echo '<br><h3>Success! Your movie has been added!</h3>';
                   }
               }
          

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>'.$row["movie_id"].'</td>
                        <td>'.$row["native_name"].' </span> </td>
                        <td>'.$row["english_name"].'</td>
                        <td>'.$row["year_made"].'</td>
                    </tr>';
            }//end while
        }//end if
        else {
            echo "0 results";
        }//end else

         $result->close();
    }
        ?>

      </tbody>
</table>
</div>

<div style="text-align:center;margin-top:40px;">
<span class="step"></span>
</div>

</form>
<style type="text/css">
#basecharAdmin {
  background-color: #ffffff;
  margin: auto;
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
<script type="text/javascript" language="javascript">
$(document).ready( function () {

$('#info').DataTable( {
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    dom: 'lfrtBip',
    buttons: [
        'copy', 'excel', 'csv', 'pdf'
    ] }
);

var table = $('#info').DataTable( {
    orderCellsTop: true,
    fixedHeader: true,
    retrieve: true
} );

} );

</script>



<style>
tfoot {
display: table-header-group;
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
    document.getElementById("basecharAdmin").submit();
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


<?php
db_disconnect($db);
include("./footer.php");
?>
