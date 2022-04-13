<?php
$nav_selected = "MOVIES";
$left_buttons = "YES";
$left_selected = "YES";

include("./nav.php");
require 'bin/functions.php';

?>

<?php
if (isset($_GET['movie_id'])) {
  $movie_id = mysqli_real_escape_string($db, $_GET['movie_id']);
}
?>
        
<?php
    $native_name = '';//
    $english_name = '';//
    $year_made = '';//
    $running_time = '';//
    $length = '';
    $strength = '';
    $weight = '';
    $budget = '';//
    $box_office = '';//
    $base_chars = '';
    $language = '';//
    $country = '';//
    $genre = '';//
    $plot = '';//
    $movie_media_id = [];
    $m_link = [];//
    $m_link_type = [];//
    $keyword = [];
    $people_id = [];
    $stage_name = [];
    $first_name = [];
    $middle_name = [];
    $last_name = [];
    $gender = [];
    $image_name = [];
    $role = [];
    $screen_name = [];
    $song_id = [];
    $title = [];
    $lyrics = [];
    $theme = [];
    $movie_quote_id = [];
    $movie_quote_name = [];
    $movie_trivia_id = [];
    $movie_trivia_name = [];
    $song_people = [];
    $song_people_role = [];

    // query string for the Query A.1
    $sql_A1 = "SELECT native_name, english_name, year_made
              FROM movies
              WHERE movie_id =".$movie_id.";";
    $result = $db->query($sql_A1);
          
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $native_name = $row["native_name"];
            $english_name = $row["english_name"];
            $year_made = $row["year_made"];
        }
    }
    $result->close();


    $sql_A1_2 = "SELECT *
                    FROM movie_numbers
                    WHERE movie_id =".$movie_id.";";
    $result = $db->query($sql_A1_2);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $running_time = $row["running_time"];
            $length = $row["length"];
            $strength = $row["strength"];
            $weight = $row["weight"];
            $budget = $row["budget"];
            $box_office = $row["box_office"];
            $base_chars = $row["base_chars"];
        }
    }
    $result->close();


    $sql_A2 = "SELECT language, country, genre, plot
              FROM movie_data
              WHERE movie_id =".$movie_id.";";
    $result = $db->query($sql_A2);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $language = $row["language"];
             $country = $row["country"];
             $genre = $row["genre"];
             $plot = $row["plot"];
        }
    }
    $result->close();
    

    $sql_A3 = "SELECT movie_media_id, m_link, m_link_type
              FROM movie_media
              WHERE movie_id =".$movie_id.";";

    $result = $db->query($sql_A3);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $movie_media_id[] = $row["movie_media_id"];
             $m_link[] = $row["m_link"];
             $m_link_type[] = $row["m_link_type"];
        }
    }
    $result->close();
  

    $sql_A4 = "SELECT * FROM movie_keywords WHERE movie_id = ".$movie_id.";";
    
    $result = $db->query($sql_A4);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $keyword[] = $row["keyword"];
        }
    }
    $result->close();
   

    $sql_B1 = "SELECT * from people natural join movie_people WHERE movie_people.movie_id =".$movie_id.";";

    $result = $db->query($sql_B1);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
              $people_id[] = $row["people_id"];
              $stage_name[] = $row["stage_name"];
              $first_name[] = $row["first_name"];
              $middle_name[] = $row["middle_name"];
              $last_name[] = $row["last_name"];
              $gender[] = $row["gender"];
              $image_name[] = $row["image_name"];
              $role[] = $row["role"];
              $screen_name[] = $row["screen_name"];
        }
    }
    $result->close();


    $sql_C1 = "SELECT * from songs natural join movie_song WHERE movie_song.movie_id =".$movie_id.";";
  
    $result = $db->query($sql_C1);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $song_id[] = $row["song_id"];
             $title[] = $row["title"];
             $lyrics[] = $row["lyrics"];
             $theme[] = $row["theme"];
        }
    }
    $result->close();

if(count($song_id) > 0){

foreach($song_id as $song){
    $sql_C = "SELECT people.stage_name, song_people.role from people natural join song_people natural join movie_song WHERE movie_song.song_id = ".$song." and movie_song.movie_id = ".$movie_id.";";

    $result = $db->query($sql_C);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $song_people[] = $row["stage_name"];
             $song_people_role[] = $row["role"];
        }
    }
}
    $result->close();

}
    $sql_C3 = "SELECT * from movie_quotes WHERE movie_id =".$movie_id.";";

    $result = $db->query($sql_C3);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $movie_quote_id[] = $row["movie_quote_id"];
             $movie_quote_name[] = $row["movie_quote_name"];
        }
    }
    $result->close();


    $sql_C4 = "SELECT * from movie_quotes WHERE movie_id =".$movie_id.";";

    $result = $db->query($sql_C4);


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $movie_trivia_id[] = $row["movie_trivia_id"];
             $movie_trivia_name[] = $row["movie_trivia_name"];
        }
    }
    $result->close();
?>



<div class="container">
  <div class="cellphone-container">
      <div class="movie">
        <h1><?php echo $native_name;?></h1>
        <div class="movie-img">
        <?php if(!empty(trim($m_link[0]))){ ?>
        <img src="posters/<?php echo $m_link[0].'.'.$m_link_type[0];?>" alt="<?php echo $m_link[0];?>" style="width:300px;height:300px;"></img>
        <?php } else { ?>
            <img src="images/no-image.png" alt="No Image" style="width:300px;height:300px;"></img>
        <?php } ?>
        </div>
        <div class="text-movie-cont">
          <div class="mr-grid summary-row">
            <div class="col">
                <br>
                <h5>SUMMARY:</h5>
               <ul class="movie-likes">
                <?php if(!empty(trim($english_name))){?>
                    <li>English Name: <?php echo $english_name; ?></li>
                <?php } else {?>
                    <li>English Name: N/A</li>
                <?php } ?>
                <?php if(!empty(trim($year_made))){?>
                    <li>Year Released: <?php echo $year_made; ?></li>
                <?php } else {?>
                    <li>Year Released: N/A</li>
                <?php } ?>
                <?php if(!empty(trim($language))){?>
                    <li>Language: <?php echo $language; ?></li>
                <?php } else {?>
                    <li>Language: N/A</li>
                <?php } ?>
                <?php if(!empty(trim($country))){?>
                    <li>Country: <?php echo $country; ?></li>
                <?php } else {?>
                    <li>Country: N/A</li>
                <?php } ?>
                <?php if(!empty(trim($genre))){?>
                    <li>Genre: <?php echo $genre; ?></li>
                <?php } else {?>
                    <li>Genre: N/A</li>
                <?php } ?>
                <?php if(!empty(trim($running_time))){?>
                    <li>Run Time: <?php echo $running_time; ?></li>
                <?php } else {?>
                    <li>Run Time: N/A</li>
                <?php } ?>
                <?php if(!empty(trim($budget))){?>
                    <li>Budget: <?php echo $budget; ?></li>
                <?php } else {?>
                    <li>Budget: N/A</li>
                <?php } ?>
                <?php if(!empty(trim($box_office))){?>
                    <li>Box Office: <?php echo $box_office; ?></li>
                <?php } else {?>
                    <li>Box Office: N/A</li>
                <?php } ?>
                <br>
              </ul>
            </div>
          </div>
          <div class="mr-grid plot-row">
            <div class="col1">
            <h5>PLOT:</h5>
                <ul class="movie-plot">
                <?php if(!empty($plot)){ ?>
                    <?php if(!empty(trim($plot))){ ?>
                        <p class="movie-description"><?php echo $plot; ?></p>
                    <?php } else { ?>
                        <p class="movie-description">N/A</p>
                    <?php } ?>
                <?php } else {
                    echo "<li>Plot N/A</li>";
                }
                ?>
                </ul>
            </div>
          </div>
            <br>
          <div class="mr-grid actors-row">
            <div class="col2">
            <h5>CAST:</h5>
              <ul class="movie-actors">
                <?php
                    if(empty($people_id)){
                        echo "<li>Cast Info N/A</li>";
                    } else {
                        for($i = 0; $i < count($people_id); $i++){
                            if(count($stage_name) > 0 && !empty(trim($stage_name[$i]))){
                                echo "<p>Stage Name: ".$stage_name[$i];
                                if(count($role) > 0 && !empty(trim($role[$i]))){
                                    echo "<li style='text-indent:30px;'>Role: ".$role[$i]."</li>";
                                } else {
                                        echo "<li style='text-indent:30px;'>Role: N/A</li>";
                                }
                                if(count($screen_name) > 0 && !empty(trim($screen_name[$i]))){
                                    echo "<li style='text-indent:30px;'>Billing: ".$screen_name[$i]."</li>";
                                } else {
                                    echo "<li style='text-indent:30px;'>Billing: N/A</li>";
                                }
                                echo "</p>";
                            }
                        }
                    }
                ?>
              </ul>
            </div>
          </div>
            <div class="mr-grid cast-row">
              <div class="col2">
              <br>
              <h5>SOUNDTRACK:</h5>
                <ul class="movie-actors">
                  <?php
                    if(count($song_id) > 0){
                      for($i = 0; $i < count($song_id); $i++){
                          echo "<p>".$title[$i]." - by ".$song_people[$i].", ".$song_people_role[$i];
                          if(count($lyrics) > 0 && !empty(trim($lyrics[$i]))){
                              echo "<li style='text-indent:30px;'>Lyrics: ".$lyrics[$i]."</li></p>";
                          } else {
                              echo "<li style='text-indent:30px;'>Lyrics: N/A</li>";
                          }
                          if(count($theme) > 0 && !empty(trim($theme[$i]))){
                              echo "<li style='text-indent:30px;'>Theme: ".$theme[$i]."</li></p>";
                          } else{
                              echo "<li style='text-indent:30px;'>Theme: N/A</li>";
                          }
                      }
                    } else {
                        echo "<li>No Songs Listed</li>";
                    }
                  ?>
                </ul>
              </div>
            </div>
            <br>
        </div>
      </div>
  </div>
</div>
<style>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 800px;
  margin: auto;
background: linear-gradient(110deg, #fdcd3b 60%, #ffed4b 60%);
  font-family: arial;
}
</style>

<?php
    db_disconnect($db);
    include("./footer.php");
?>
