<?php
$nav_selected = "MOVIES";
$left_buttons = "YES";
$left_selected = "NO";

include("./nav.php");
require 'bin/functions.php';
require 'db_configuration.php';
global $db;
?>




<?php
if (isset($_GET['people_id'])) {
  $people_id = mysqli_real_escape_string($db, $_GET['people_id']);
}
?>




<div class="right-content">
  <div class="container">
    <h3 style="color: #01B0F1;"> People More Data </h3>
          
    <?php


    $sql_A1 = "SELECT people_id, stage_name, first_name, middle_name, last_name, gender
               FROM people
               WHERE people_id=" . $people_id;

        
        
        
    if (!$sql_A1_result = $db->query($sql_A1)) {
      die('There was an error running query[' . $connection->error . ']');
    }

    if ($sql_A1_result->num_rows > 0) {
      $a1_tuple = $sql_A1_result->fetch_assoc();
      echo '<br> People ID : ' . $a1_tuple["people_id"] .
        '<br> First Name : ' . $a1_tuple["first_name"] .
        '<br> Last Name : ' . $a1_tuple["last_name"] .
        '<br> Middle Name :  ' . $a1_tuple["middle_name"] .
        '<br> Stage Name : ' . $a1_tuple["stage_name"] ;
        '<br> Gender :  ' . $a1_tuple["gender"] ;
    } //end if
    else {
      echo "0 results";
    } //end else

    $sql_A1_result->close();
    ?>
  </div>
</div>





<div class="right-content">
  <div class="container">
    <h3 style="color: #01B0F1;">People Trivia</h3>

    <?php

    //TODO: 
    $sql_A2 =  "SELECT people_id, people_trivia_id, people_trivia_name
                 FROM people_trivia
                 WHERE people_id =" . $people_id;

    if (!$sql_A2_result = $db->query($sql_A2)) {
      die('There was an error running query[' . $connection->error . ']');
    }

    if ($sql_A2_result->num_rows > 0) {
      $a2_tuple = $sql_A2_result->fetch_assoc();
      echo '<br> Song ID : ' . $a2_tuple["people_id"] .
        '<br> People ID : ' . $a2_tuple["people_trivia_id"] .
        '<br> Role :  ' . $a2_tuple["people_trivia_name"];
        
    } //end if
    else {
      echo "0 results";
    } //end else

    $sql_A2_result->close();
    ?>

  </div>
</div>




<div class="right-content">
  <div class="container">
    <h3 style="color: #01B0F1;">Movies Participate</h3>


        <?php

       
        $sql_A3 = "SELECT native_name
        FROM movies
        LEFT JOIN movie_people
        ON movies.movie_id = movie_people.movie_id
        LEFT JOIN people
        ON movie_people.screen_name=people.stage_name
        WHERE movie_people.people_id =" . $people_id;
            
            
            
            
            

        if (!$sql_A3_result = $db->query($sql_A3)) {
          die('There was an error running query[' . $connection->error . ']');
        }

        // this is 1 to many relationship
        // So, many tuples may be returned
        // We will display those in a table in a while loop
       
        if ($sql_A3_result->num_rows > 0) {
          $a3_tuple = $sql_A3_result->fetch_assoc();
          echo '<br> Movie Participate: ' . $a3_tuple["native_name"];
            
        } //end if
        else {
          echo "0 results";
        }

        $sql_A3_result->close();
        ?>

    </table>
  </div>
</div>








<!-- ================== JQuery Data Table script ================================= -->

<script type="text/javascript" language="javascript">
  $(document).ready(function() {

    $('#info').DataTable({
      dom: 'lfrtBip',
      buttons: [
        'copy', 'excel', 'csv', 'pdf'
      ]
    });

    $('#info thead tr').clone(true).appendTo('#info thead');
    $('#info thead tr:eq(1) th').each(function(i) {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');

      $('input', this).on('keyup change', function() {
        if (table.column(i).search() !== this.value) {
          table
            .column(i)
            .search(this.value)
            .draw();
        }
      });
    });

    var table = $('#info').DataTable({
      orderCellsTop: true,
      fixedHeader: true,
      retrieve: true
    });

  });
</script>



<style>
  tfoot {
    display: table-header-group;
  }
</style>

<?php include("./footer.php"); ?>
