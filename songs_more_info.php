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
if (isset($_GET['song_id'])) {
  $song_id = mysqli_real_escape_string($db, $_GET['song_id']);
}
?>




<div class="right-content">
  <div class="container">
    <h3 style="color: #01B0F1;"> Songs More Data </h3>
          
    <?php


    $sql_A1 = "SELECT song_id, title, lyrics, theme
              FROM songs
              WHERE song_id =" . $song_id;

    if (!$sql_A1_result = $db->query($sql_A1)) {
      die('There was an error running query[' . $connection->error . ']');
    }

    if ($sql_A1_result->num_rows > 0) {
      $a1_tuple = $sql_A1_result->fetch_assoc();
      echo '<br> Song ID : ' . $a1_tuple["song_id"] .
        '<br> Song Name : ' . $a1_tuple["title"] .
        '<br> Lyrics : ' . $a1_tuple["lyrics"] .
        '<br> Theme :  ' . $a1_tuple["theme"];
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
    <h3 style="color: #01B0F1;">Songs People </h3>

    <?php

    //TODO: 
    $sql_A2 =  "SELECT song_id, people_id, role
                 FROM song_people
                 WHERE song_id =" . $song_id;

    if (!$sql_A2_result = $db->query($sql_A2)) {
      die('There was an error running query[' . $connection->error . ']');
    }

    if ($sql_A2_result->num_rows > 0) {
      $a2_tuple = $sql_A2_result->fetch_assoc();
      echo '<br> Song ID : ' . $a2_tuple["song_id"] .
        '<br> People ID : ' . $a2_tuple["people_id"] .
        '<br> Role :  ' . $a2_tuple["role"];
        
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
    <h3 style="color: #01B0F1;"> Song Keywords</h3>


        <?php

        // query string for the Query A.1
        $sql_A3 = "SELECT song_id, keyword
              FROM song_keywords
              WHERE song_id =" . $song_id;

        if (!$sql_A3_result = $db->query($sql_A3)) {
          die('There was an error running query[' . $connection->error . ']');
        }

        // this is 1 to many relationship
        // So, many tuples may be returned
        // We will display those in a table in a while loop
       
        if ($sql_A3_result->num_rows > 0) {
          $a3_tuple = $sql_A3_result->fetch_assoc();
          echo '<br> Song ID : ' . $a3_tuple["song_id"] .
            '<br> Keyword :  ' . $a3_tuple["keyword"];
            
        } //end if
        else {
          echo "0 results";
        }

        $sql_A3_result->close();
        ?>

    </table>
  </div>
</div>






<div class="right-content">
  <div class="container">
    <h3 style="color: #01B0F1;"> Song Media</h3>

    <?
    //TODO: 
    $sql_A4 = "SELECT song_media_id, s_link, s_link_type, song_id
    FROM song_media
    WHERE song_id =" . $song_id;

if (!$sql_A4_result = $db->query($sql_A4)) {
die('There was an error running query[' . $connection->error . ']');
}

if ($sql_A4_result->num_rows > 0) {
$a4_tuple = $sql_A4_result->fetch_assoc();
echo '<br> Song ID : ' . $a4_tuple["song_id"] .
     '<br> Song Media ID : ' . $a4_tuple["song_id"] .
    '<br> Song link : ' . $a4_tuple["s_link"] ;
'<br> Song link type : ' . $a4_tuple["s_link_type"] ;

} //end if
else {
echo "0 results";
} //end else

$sql_A4_result->close();
    ?>
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
