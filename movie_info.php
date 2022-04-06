<?php
$nav_selected = "MOVIES";
$left_buttons = "YES";
$left_selected = "YES";

include("./nav.php");
require 'bin/functions.php';
?>




<!-- =====================================================================================================

This page displays the information from all 12 tables.
The input is "movie_id". 
This "movie_id" is passed to movie_info.php as a URL parameter.

This pages displays the movie information in three sections.

[A] MOVIE 
[B] PEOPLE
[C] SONGS

The above three sections are outlined below

[A]  MOVIE Details

[A.1] Basic Data  (table: movies)
Display Type: Name - value pairs

id
native_name 
english_name 
year_made 

[A.2] Extended Data (table: movie_data)
Display Type: Name - value pairs

language
country
genre
plot


[A.3] Movie Media (table: movie_media)
Display Type: Show this as a table

m_media_id
m_link  (preferable to display the media on the page)
m_link_type

[A.4] Movie Key Words (table: movie_keywords)
Display Type: Name - value pairs

keywords (show it as a comma separated list) 


[B] PEOPLE Details

[B.1] People  (table: movie_people and people)  
Display Type: Show this as a table

role 
screen_name
first_name
middle_name
last_name 
image_name (prefereable to display the image on the page)

[C] SONGS Details

[C.1] Songs (table: movie_song, songs, song_media, song_people, song_keywords)
Display Type: Show this as a table

title 
lyrics
screen name (from people)
role (from song_people)
keywords (from song_keywords, show this info as comma separated list
media (from songs_media - show the IDs as comma separated list, media_link will be a hyper link)

===================================================================================================== -->

<!-- ========== Getting the movie id =====================================
// This is the movie_id coming to this page as GET parameter
// We will fetch it and save it as $movie_id to be used in our queries
======================================================================== -->
<?php
if (isset($_GET['movie_id'])) {
  $movie_id = mysqli_real_escape_string($db, $_GET['movie_id']);
}
?>


<!-- ================ [A.1] Basic Data (table: movies) ======================
Display Type: Name - value pairs

movie_id
native_name 
english_name 
year_made
========================================================================= -->


          
    <?php


    // query string for the Query A.1
    $sql_A1 = "SELECT movie_id, native_name, english_name, year_made 
              FROM movies
              WHERE movie_id =".$movie_id.";";
    $result = $db->query($sql_A1);
          
          if ($result->num_rows > 0) {
          ?>
          <div class="right-content">
            <div class="container">
          <h3 style="color: #01B0F1;">Basic Movie Info</h3>
          <table id="info0" cellpadding="0" cellspacing="0" border="0"
              class="datatable table table-striped table-bordered datatable-style table-hover"
              width="100%" style="width: 50px;">
                <thead>
                  <tr id="table-first-row">
                          <th>ID</th>
                          <th>Native Name</th>
                          <th>English Name</th>
                          <th>Year </th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($row = $result->fetch_assoc()) {
                      echo '<tr>
                              <td>'.$row["movie_id"].'</td>
                              <td>'.$row["native_name"].' </td>
                              <td>'.$row["english_name"].'</td>
                              <td>'.$row["year_made"].'</td>
                          </tr>';
                  }//end while
                ?>
          
          
                </tbody>
          </table>
          </div>
        </div>
          <?php
          $result->close();
          }
          ?>
    
  




<!-- ================ [A.2] Extended Data (table: movie_data) ======================
Display Type: Name - value pairs

language
country
genre
plot

TODO: Copy the code snippet from A.1, change the code to reflect Extended data
========================================================================= -->


    <?php

    //TODO:
    $sql_A2 = "SELECT movie_id, language, country, genre, plot
              FROM movie_data
              WHERE movie_id =".$movie_id.";";
    $result = $db->query($sql_A2);

          if ($result->num_rows > 0) {
          ?>
          <div class="right-content">
            <div class="container">
          <h3 style="color: #01B0F1;">Movie Data</h3>
          <table id="info1" cellpadding="0" cellspacing="0" border="0"
              class="datatable table table-striped table-bordered datatable-style table-hover"
              width="100%" style="width: 50px;">
                <thead>
                  <tr id="table-first-row">
                          <th>ID</th>
                          <th>Language</th>
                          <th>Country</th>
                          <th>Genre</th>
                          <th>Plot</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($row = $result->fetch_assoc()) {
                      echo '<tr>
                              <td>'.$row["movie_id"].'</td>
                              <td>'.$row["language"].'</td>
                              <td>'.$row["country"].'</td>
                              <td>'.$row["genre"].'</td>
                              <td>'.$row["plot"].'</td>
                          </tr>';
                  }//end while
                ?>
                </tbody>
          </table>
          </div>
        </div>
          <?php
          $result->close();
          }
          ?>


<!-- ================ [A.3] Movie Media (table: movie_media) ======================
Display Type: Show this as a table

m_media_id
m_link  (preferable to display the media on the page)
m_link_type
========================================================================= -->



        <?php

        // query string for the Query A.1
        $sql_A3 = "SELECT movie_id, movie_media_id, m_link, m_link_type 
              FROM movie_media
              WHERE movie_id =".$movie_id.";";

          $result = $db->query($sql_A3);

                if ($result->num_rows > 0) {
                ?>
                <div class="right-content">
                  <div class="container">
                <h3 style="color: #01B0F1;">Movie Media</h3>
                <table id="info2" cellpadding="0" cellspacing="0" border="0"
                    class="datatable table table-striped table-bordered datatable-style table-hover"
                    width="100%" style="width: 50px;">
                      <thead>
                        <tr id="table-first-row">
                                <th>ID</th>
                                <th>Media ID</th>
                                <th>Media Link</th>
                                <th>Media Link Type</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        while($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td>'.$row["movie_id"].'</td>
                                    <td>'.$row["movie_media_id"].'</td>
                                    <td>'.$row["m_link"].'</td>
                                    <td>'.$row["m_link_type"].'</td>
                                </tr>';
                        }//end while
                      ?>
                      </tbody>
                </table>
                </div>
              </div>
                <?php
                $result->close();
                }
                ?>

        






<!-- ================ [A.4] Movie Key Words (table: movie_keywords) ======================
Display Type: Name - value pairs

keywords (show it as a comma separated list) 
========================================================================= -->

    <?PHP
    //TODO: 
    $sql_A4 = "SELECT * FROM movie_keywords WHERE movie_id = ".$movie_id.";";
    $result = $db->query($sql_A4);

          if ($result->num_rows > 0) {
          ?>
          <div class="right-content">
            <div class="container">
          <h3 style="color: #01B0F1;">Movie Keywords</h3>
          <table id="info3" cellpadding="0" cellspacing="0" border="0"
              class="datatable table table-striped table-bordered datatable-style table-hover"
              width="100%" style="width: 50px;">
                <thead>
                  <tr id="table-first-row">
                          <th>ID</th>
                          <th>Keyword</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($row = $result->fetch_assoc()) {
                      echo '<tr>
                              <td>'.$row["movie_id"].'</td>
                              <td>'.$row["keyword"].'</td>
                          </tr>';
                  }//end while
                ?>
                </tbody>
          </table>
          </div>
        </div>
          <?php
          $result->close();
          }
          ?>




<!-- ================ [B.1] People  (table: movie_people and people)   ======================
Display Type: Show this as a table

role 
screen_name
first_name
middle_name
last_name 
image_name  
========================================================================= -->


    <?php

    //TODO: 
    $sql_B1 = "SELECT * from people natural join movie_people WHERE movie_id =".$movie_id.";";

          $result = $db->query($sql_B1);

                if ($result->num_rows > 0) {
                ?>
                <div class="right-content">
                  <div class="container">
                <h3 style="color: #01B0F1;">Movie People</h3>
                <table id="info4" cellpadding="0" cellspacing="0" border="0"
                    class="datatable table table-striped table-bordered datatable-style table-hover"
                    width="100%" style="width: 50px;">
                      <thead>
                        <tr id="table-first-row">
                                <th>ID</th>
                                <th>People ID</th>
                                <th>Stage Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        while($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td>'.$row["movie_id"].'</td>
                                    <td>'.$row["people_id"].'</td>
                                    <td>'.$row["stage_name"].'</td>
                                    <td>'.$row["first_name"].'</td>
                                    <td>'.$row["middle_name"].'</td>
                                    <td>'.$row["last_name"].'</td>
                                </tr>';
                        }//end while
                      ?>
                      </tbody>
                </table>
                 
                </div>
              </div>
                <?php
                }
                ?>
          
          <?php

          //TODO:
          $sql_B1_1 = "SELECT * from people natural join movie_people WHERE movie_id =".$movie_id.";";

                $result = $db->query($sql_B1_1);

                      if ($result->num_rows > 0) {
                      ?>
                      <div class="right-content">
                        <div class="container">
    
          <table id="info5" cellpadding="0" cellspacing="0" border="0"
              class="datatable table table-striped table-bordered datatable-style table-hover"
              width="100%" style="width: 50px;">
                <thead>
                  <tr id="table-first-row">
                          <th>ID</th>
                          <th>Stage Name</th>
                          <th>People ID</th>
                          <th>Gender</th>
                          <th>Image Name</th>
                          <th>Role</th>
                          <th>Screen Name</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($row = $result->fetch_assoc()) {
                      echo '<tr>
                              <td>'.$row["movie_id"].'</td>
                              <td>'.$row["people_id"].'</td>
                              <td>'.$row["stage_name"].'</td>
                              <td>'.$row["gender"].'</td>
                              <td>'.$row["image_name"].'</td>
                              <td>'.$row["role"].'</td>
                              <td>'.$row["screen_name"].'</td>
                          </tr>';
                  }//end while
                ?>
                </tbody>
          </table>
                       
                      </div>
                    </div>
                      <?php
                      $result->close();
                      }
                      ?>

          
          


<!-- ================ [C.1] Songs (table: movie_song, songs, song_media, song_people, song_keywords)   ======================
Display Type: Show this as a table

title 
lyrics
screen name (from people)
role (from song_people)
keywords (from song_keywords, show this info as comma separated list
media (from songs_media - show the IDs as comma separated list, media_link will be a hyper link)
========================================================================= -->


    <?php
          
          $sql_C1 = "SELECT * from songs natural join movie_song WHERE movie_id =".$movie_id.";";
          
          $result = $db->query($sql_C1);

                if ($result->num_rows > 0) {
                ?>
                <div class="right-content">
                  <div class="container">
                <h3 style="color: #01B0F1;">Movie Songs</h3>
                <table id="info6" cellpadding="0" cellspacing="0" border="0"
                    class="datatable table table-striped table-bordered datatable-style table-hover"
                    width="100%" style="width: 50px;">
                      <thead>
                        <tr id="table-first-row">
                                <th>ID</th>
                                <th>Song ID</th>
                                <th>Title</th>
                                <th>Lyrics</th>
                                <th>Theme</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        while($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td>'.$row["movie_id"].'</td>
                                    <td>'.$row["song_id"].'</td>
                                    <td>'.$row["title"].'</td>
                                    <td>'.$row["lyrics"].'</td>
                                    <td>'.$row["theme"].'</td>
                                </tr>';
                        }//end while
                      ?>
                      </tbody>
                </table>
                </div>
              </div>
                <?php
                $result->close();
                }
                ?>

     


<!-- ================== JQuery Data Table script ================================= -->
<?php
$count = 0;
while($count < 7){
?>

    <script type="text/javascript" language="javascript">
      $(document).ready( function () {
          
          $('#info<?php echo $count;?>').DataTable( {
              dom: 'lfrtBip',
              buttons: [
                  'copy', 'excel', 'csv', 'pdf'
              ] }
          );

          $('#info<?php echo $count;?> thead tr').clone(true).appendTo( '#info<?php echo $count;?> thead' );
          $('#info<?php echo $count;?> thead tr:eq(1) th').each( function (i) {
              var title = $(this).text();
              $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      
              $( 'input', this ).on( 'keyup change', function () {
                  if ( table.column(i).search() !== this.value ) {
                      table
                          .column(i)
                          .search( this.value )
                          .draw();
                  }
              } );
          } );
      
          var table = $('#info<?php echo $count;?>').DataTable( {
              orderCellsTop: true,
              fixedHeader: true,
              retrieve: true
          } );
          
      } );

  </script>
<?php
$count++;
}
?>
          
<style>
  tfoot {
    display: table-header-group;
  }
</style>

<?php
    db_disconnect($db);
    include("./footer.php");
?>
