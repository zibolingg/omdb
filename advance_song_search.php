<?php
  $nav_selected = "search_data";
  $left_buttons = "YES";
  $left_selected = "search_data";
  include("./nav.php");
  global $db;
  if(isset($_POST['song_search_button'])){
  $name1 = $_POST['song_search'];
  }

  if(isset($_POST['movie_search_button'])){
  $name2 = $_POST['movie_search'];
  }

  if(isset($_POST['people_search_button'])){
  $name3 = $_POST['people_search'];
  }
  if(isset($_POST['song_people_search_button'])){
    $lyricist = $_POST['lyricist'];
    $playback_singer = $_POST['playback_singer'];
    $music_director = $_POST['music_director'];
    $leading_actor = $_POST['leading_actor'];
    $leading_actress = $_POST['leading_actress'];
    $director = $_POST['director'];
    $producer = $_POST['producer'];




}
  ?>

<div class="right-content">
    <div class="container">

    <br><br>

      <?php
      if(!isset($_POST['movies']) AND !isset($_POST['people'])){ ?>
          <h3 style = "color: #01B0F1;">Search Songs</h3>
        <form method="post" action="search_data.php">
          <input type="text" name="song_search" placeholder="Enter song to search its record...">
          <button type="submit" name="song_search_button"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        <hr />
        <form method="post" action="advance_song_search.php">

          <div class="form-group">
            <label for="lyricist">Lyricist</label>
            <input type="text" class="form-control" id="lyricist" name="lyricist" placeholder="lyricist Name">
          </div>

          <div class="form-group">
            <label for="playback_singer">Playback Singer</label>
            <input type="text" class="form-control" id="playback_singer" name="playback_singer" placeholder="Playback Singer Name">
          </div>

          <div class="form-group">
            <label for="music_director">Music Director</label>
            <input type="text" class="form-control" id="music_director" name="music_director" placeholder="Music Director Name">
          </div>

        <div class="form-group">
          <label for="leading_actor">Leading Actor</label>
          <input type="text" class="form-control" id="leading_actor" name="leading_actor" placeholder="Leading Actor Name">
        </div>

        <div class="form-group">
          <label for="leading_actress">Leading Actress</label>
          <input type="text" class="form-control" id="leading_actress" name="leading_actress" placeholder="Leading Actress Name">
        </div>

        <div class="form-group">
          <label for="director">Director</label>
          <input type="text" class="form-control" id="director" name="director" placeholder="director Name">
        </div>

        <div class="form-group">
          <label for="producer">Producer</label>
          <input type="text" class="form-control" id="producer" name="producer" placeholder="producer Name">
        </div>


        <button type="submit"  name="song_people_search_button" class="btn btn-primary">Search</button>
      </form>


      <?php }
      if(isset($_POST['movies']) ){ ?>
          <h3 style = "color: #01B0F1;">Search Movies</h3>
        <form method="post" action="search_data.php">
          <input type="text" name="movie_search" placeholder="Enter movie to search its record...">
          <button type="submit" name="movie_search_button"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        <hr/>
        <h3 style = "color: #01B0F1;">Search movies by role</h3>

        <form method="post" action="advance_movie_search.php">
        <div class="form-group">
          <label for="lead_actor">Lead Actor</label>
          <input type="text" class="form-control" id="lead_actor" name="lead_actor" placeholder="Lead Actor Name">
        </div>

        <div class="form-group">
          <label for="lead_actress">Lead Actress</label>
          <input type="text" class="form-control" id="lead_actress" name="lead_actress" placeholder="Lead Actress Name">
        </div>

        <div class="form-group">
          <label for="producer">Producer</label>
          <input type="text" class="form-control" id="producer" name="producer" placeholder="producer Name">
        </div>

        <div class="form-group">
          <label for="director">Director</label>
          <input type="text" class="form-control" id="director" name="director" placeholder="director Name">
        </div>

        <div class="form-group">
          <label for="music_director">Music Director</label>
          <input type="text" class="form-control" id="music_director" name="music_director" placeholder="Music Director Name">
        </div>



        <button type="submit"  name="movie_people_search_button" class="btn btn-primary">Search</button>
      </form>



<?php }
if(isset($_POST['people'])){ ?>
    <h3 style = "color: #01B0F1;">Search Peoples</h3>
  <form method="post" action="search_data.php">
    <input type="text" name="people_search" placeholder="Enter People to search its record...">
    <button type="submit" name="people_search_button"><i class="fa fa-search" aria-hidden="true"></i></button>
  </form>

  <hr/>
  <form method="post" action="advance_people_search.php">
  <div class="form-group">
    <label for="stage_name">Stage Name</label>
    <input type="text" class="form-control" id="stage_name" name="stage_name" placeholder="Stage Name">
  </div>

  <div class="form-group">
    <label for="role">Role</label>
    <input type="text" class="form-control" id="role" name="role" placeholder="Role">
  </div>


  <button type="submit"  name="search" class="btn btn-primary">Search</button>
</form>

<?php } ?>



<!-- Lyricist starts here-->

          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';
            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    } ?>
<!-- Lyricist Ends here -->



<!-- Playback starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';
            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    } ?>
<!-- Playback Singer Ends here -->



<!-- music_director starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';
            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    } ?>
<!-- Music director Ends here -->



<!-- Leading Actor starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';
            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    } ?>
<!-- Leading Actor Ends here -->

<!-- Leading Actress starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';
            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    } ?>
<!-- Leading Actress Ends here -->



<!-- director starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='director'
            AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
            OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';
            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    } ?>
<!-- director Ends here -->


<!-- Producer starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='producer'
            AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
            OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';
            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    } ?>
<!-- director Ends here -->



<!-- Lyricist and Playback singer starts here-->

          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!-- Lyricist and Playback singer Ends here -->


<!-- Lyricist and Music Director starts here-->

          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Lyricist and Music Director Ends here -->

<!-- Lyricist and Leading Actor starts here-->

          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Lyricist and Leading Actor Ends here -->

<!--Lyricist and Leading Actress starts here-->

          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Lyricist and Leading Actress Ends here -->

<!-- Lyricist and Director starts here-->

          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='director'
            AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
            OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Lyricist and Director Ends here -->

<!-- Lyricist and Producer starts here-->

          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='producer'
            AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
            OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Lyricist and Producer Ends here -->

<!-- Playback Singer and Music Director starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Playback Singer and Music Director Ends here -->

<!--Playback Singer and Leading Actor starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Playback Singer and Leading Actor Ends here -->

<!-- Playback Singer and Leading Actress starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Playback Singer and Leading Actress Ends here -->

<!--Playback Singer and Director starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='director'
            AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
            OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Playback Singer and Director Ends here -->

<!-- Playback Singer and Producer starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='producer'
            AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
            OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Playback Singer and Producer Ends here -->

<!--Music Director and Leading Actor starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Music Director and Leading Actor Ends here -->

<!-- Music Director and Leading Actress starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Music Director and Leading Actress Ends here -->

<!-- Music Director and Director starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='director'
            AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
            OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Music Director and Director Ends here -->

<!-- Music Director and Producer starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='producer'
            AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
            OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!-- Music Director and Producer  Ends here -->

<!-- Leading Actor and Leading Actress starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Leading Actor and Leading Actress Ends here -->

<!-- Leading Actor and Director starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='director'
            AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
            OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Leading Actor and Director Ends here -->

<!-- Leading Actor and Producer starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='producer'
            AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
            OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Leading Actor and Producer Ends here -->

<!--Leading Actress and Director starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='director'
            AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
            OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Leading Actress and Director Ends here -->

<!--Leading Actress and Producer starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='producer'
            AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
            OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Leading Actress and Producer Ends here -->

<!-- Director and Producer starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='director'
            AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
            OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='producer'
            AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
            OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

            if(mysqli_num_rows($query1)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['lyrics']; ?></td>
              <td><?php echo $row['theme']; ?></td>
              <td><?php echo $row['role']; ?></td>
            </tr>
          <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  ?>
<!--Director and Producer Ends here -->




<!--Lyricist , Playback singer AND Music Director starts here-->

          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='music_director'
              AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
              OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Lyricist , Playback singer AND Music Director Ends here -->


<!--Lyricist , Playback singer AND Leading Actor starts here-->

          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Lyricist , Playback singer AND Leading Actor Ends here -->

<!--Lyricist , Playback singer AND Leading Actress starts here-->

          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Lyricist , Playback singer AND Leading Actress Ends here -->

<!--Lyricist , Playback singer AND Director starts here-->

          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Lyricist , Playback singer AND Director Ends here -->

<!--Lyricist , Playback singer AND Producer starts here-->

          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Lyricist , Playback singer AND Producer Ends here -->

<!--Lyricist , Music Director AND Leading Actor starts here-->

          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Lyricist , Music Director AND Leading Actor Ends here -->

<!--Lyricist , Music Director AND Leading Actress starts here-->

          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Lyricist , Music Director AND Leading Actress Ends here -->

<!--Lyricist , Music Director AND Director starts here-->

          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Lyricist , Music Director AND Director Ends here -->

<!--Lyricist , Music Director AND Producer starts here-->

          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Lyricist , Music Director AND Producer Ends here -->

<!-- Playback Singer , Music Director AND Leading Actor starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Playback Singer , Music Director AND Leading Actor Ends here -->

<!--Playback Singer , Music Director AND Leading Actress starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Playback Singer , Music Director AND Leading Actress Ends here -->

<!--Playback Singer , Music Director AND Director starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Playback Singer , Music Director AND Director Ends here -->

<!--Playback Singer , Music Director AND Producer starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Playback Singer , Music Director AND Producer Ends here -->


<!--Playback Singer , Leading Actor AND Leading Actress starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Playback Singer , Leading Actor AND Leading Actress Ends here -->


<!--Playback Singer , Leading Actor AND Director starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Playback Singer , Leading Actor AND Director Ends here -->


<!-- Playback Singer , Leading Actor AND Producer starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Playback Singer , Leading Actor AND Producer Ends here -->


<!--Playback Singer , Leading Actress AND Director starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Playback Singer , Leading Actress AND Director Ends here -->


<!--Playback Singer , Leading Actress AND Producer starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Playback Singer , Leading Actress AND Producer Ends here -->


<!--Playback Singer , Director AND Producer starts here-->

          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='director'
            AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
            OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Playback Singer , Director AND Producer Ends here -->


<!--Music Director , Leading Actor AND Leading Actress starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Music Director , Leading Actor AND Leading Actress Ends here -->


<!--Music Director , Leading Actor AND Director starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Music Director , Leading Actor AND Director Ends here -->

<!--Music Director , Leading Actor AND Producer starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Music Director , Leading Actor AND Producer Ends here -->

<!--Music Director , Leading Actress AND Director starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Music Director , Leading Actress AND Director Ends here -->

<!--Music Director , Leading Actress AND Producer starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Music Director , Leading Actress AND Producer Ends here -->

<!--Music Director , Director AND Producer starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='director'
            AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
            OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Music Director , Director AND Producer Ends here -->


<!--Leading Actor , Leading Actress AND Director starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Leading Actor , Leading Actress AND Director Ends here -->

<!--Leading Actor , Leading Actress AND Producer starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Leading Actor , Leading Actress AND Producer Ends here -->

<!--Leading Actor , Director AND Producer starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='director'
            AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
            OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Leading Actor , Director AND Producer Ends here -->

<!--Leading Actress , Director AND Producer starts here-->

          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='director'
            AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
            OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='producer'
              AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
              OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

              if(mysqli_num_rows($query2)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
  }
  ?>
<!--Leading Actress , Director AND Producer Ends here -->





<!--Lyricist , Playback singer, Music Director AND Leading Actor starts here-->

          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='music_director'
              AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
              OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actor'
                AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
                OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist , Playback singer, Music Director AND Leading Actor Ends here -->

<!--Lyricist , Playback singer, Music Director AND Leading Actress starts here-->
          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='music_director'
              AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
              OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actress'
                AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist , Playback singer, Music Director AND Leading Actress Ends here -->

<!--Lyricist , Playback singer, Music Director AND Director starts here-->
          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='music_director'
              AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
              OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='director'
                AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist , Playback singer, Music Director AND Director Ends here -->

<!--Lyricist , Playback singer, Music Director AND Producer starts here-->
          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='music_director'
              AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
              OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='producer'
                AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist , Playback singer, Music Director AND Producer Ends here -->


<!--Lyricist , Music Director ,Leading Actor and Leading Actress starts here-->
          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actress'
                AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist , Music Director ,Leading Actor and Leading Actress Ends here -->


<!--Lyricist , Music Director ,Leading Actor and Director starts here-->
          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='director'
                AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist , Music Director ,Leading Actor and Director Ends here -->


<!--Lyricist , Music Director ,Leading Actor and Producer starts here-->
          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='producer'
                AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist , Music Director ,Leading Actor and Producer Ends here -->


<!--Lyricist ,Leading Actor, Leading Actress and Director starts here-->
          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='director'
                AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist ,Leading Actor, Leading Actress and Director Ends here -->


<!--Lyricist ,Leading Actor, Leading Actress and Producer starts here-->
          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='producer'
                AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist ,Leading Actor, Leading Actress and Producer Ends here -->


<!--Lyricist ,Leading Actress, Director and Producer starts here-->
          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='producer'
                AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist ,Leading Actress, Director and Producer Ends here -->


<!--Playback singer ,Music Director, Lead Actor and Lead Actress starts here-->
          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actress'
                AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Playback singer ,Music Director, Lead Actor and Lead Actress Ends here -->


<!--Playback singer ,Music Director, Lead Actor and Director starts here-->
          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='director'
                AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Playback singer ,Music Director, Lead Actor and Director Ends here -->


<!--Playback singer ,Music Director, Lead Actor and Producer starts here-->
          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='producer'
                AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Playback singer ,Music Director, Lead Actor and Producer Ends here -->


<!--Playback singer , Lead Actor,Lead Actress and Director starts here-->
          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='director'
                AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Playback singer , Lead Actor,Lead Actress and Director Ends here -->


<!--Playback singer , Lead Actor,Lead Actress and Producer starts here-->
          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='producer'
                AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Playback singer , Lead Actor,Lead Actress and Producer Ends here -->

<!--Playback singer ,Lead Actress,Director and Producer starts here-->
          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='producer'
                AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Playback singer ,Lead Actress,Director and Producer Ends here -->

<!--Music Director ,Lead Actor,Lead Actress and Director starts here-->
          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='director'
                AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Music Director ,Lead Actor,Lead Actress and Director Ends here -->

<!--Music Director ,Lead Actor,Lead Actress and Producer starts here-->
          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='producer'
                AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Music Director ,Lead Actor,Lead Actress and Producer Ends here -->


<!--Music Director ,Lead Actress, Director and Producer starts here-->
          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='producer'
                AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Music Director ,Lead Actress, Director and Producer Ends here -->


<!--Lead Actor ,Lead Actress, Director and Producer starts here-->
          <?php

          if(empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actress'
            AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
            OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='director'
              AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
              OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='producer'
                AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                if(mysqli_num_rows($query3)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lead Actor ,Lead Actress, Director and Producer Ends here -->




<!--Lyricist ,Playback Singer, Music Director,Lead Actor and Lead Actress starts here-->
          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='music_director'
              AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
              OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actor'
                AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
                OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='leading_actress'
                  AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                  OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                  if(mysqli_num_rows($query4)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist ,Playback Singer, Music Director,Lead Actor and Lead Actress Ends here -->


<!--Lyricist ,Playback Singer, Music Director,Lead Actor and Director starts here-->
          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='music_director'
              AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
              OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actor'
                AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
                OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='director'
                  AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                  OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                  if(mysqli_num_rows($query4)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist ,Playback Singer, Music Director,Lead Actor and Director Ends here -->


<!--Lyricist ,Playback Singer, Music Director,Lead Actor and Producer starts here-->
          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='music_director'
              AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
              OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actor'
                AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
                OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='producer'
                  AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                  OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                  if(mysqli_num_rows($query4)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist ,Playback Singer, Music Director,Lead Actor and Producer Ends here -->



<!--Lyricist , Music Director,Lead Actor , Lead Actress and Director starts here-->
          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actress'
                AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='director'
                  AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                  OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                  if(mysqli_num_rows($query4)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist , Music Director,Lead Actor , Lead Actress and Director Ends here -->


<!--Lyricist , Music Director,Lead Actor , Lead Actress and Producer starts here-->
          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actress'
                AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='producer'
                  AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                  OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                  if(mysqli_num_rows($query4)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist , Music Director,Lead Actor , Lead Actress and Producer Ends here -->



<!--Lyricist ,Lead Actor , Lead Actress, Director  and Producer starts here-->
          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='director'
                AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='producer'
                  AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                  OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                  if(mysqli_num_rows($query4)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist ,Lead Actor , Lead Actress, Director  and Producer Ends here -->



<!--Playback singer ,Music Director,Lead Actor, Lead Actress And Director starts here-->
          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actress'
                AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='director'
                  AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                  OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                  if(mysqli_num_rows($query4)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Playback singer ,Music Director,Lead Actor, Lead Actress And Director Ends here -->


<!--Playback singer ,Music Director,Lead Actor, Lead Actress And Producer starts here-->
          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actress'
                AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='producer'
                  AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                  OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                  if(mysqli_num_rows($query4)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Playback singer ,Music Director,Lead Actor, Lead Actress And Producer Ends here -->




<!--Playback singer ,Lead Actor, Lead Actress,Director And Producer starts here-->
          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='director'
                AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='producer'
                  AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                  OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                  if(mysqli_num_rows($query4)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Playback singer ,Lead Actor, Lead Actress,Director And Producer Ends here -->


<!--Music Director ,Lead Actor, Lead Actress,Director And Producer starts here-->
          <?php

          if(empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='leading_actor'
            AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
            OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actress'
              AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
              OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='director'
                AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='producer'
                  AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                  OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                  if(mysqli_num_rows($query4)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Music Director ,Lead Actor, Lead Actress,Director And Producer Ends here -->




<!--Lyricist, Playback Singer , Music Director ,Lead Actor, Lead Actress and Director starts here-->
          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='music_director'
              AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
              OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actor'
                AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
                OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='leading_actress'
                  AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                  OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                  if(mysqli_num_rows($query4)>0){

                    $query5 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                    from song_people
                    JOIN people ON people.people_id = song_people.people_id
                    JOIN songs ON songs.song_id = song_people.song_id
                    WHERE song_people.role='director'
                    AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                    OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                    if(mysqli_num_rows($query5)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

    <?php
    while($row5 = mysqli_fetch_assoc($query5)){
      $count++;
    ?>
    <tr>
      <td><?php echo $count; ?></td>
      <td><?php echo $row5['first_name'].' '.$row5['middle_name'].' '.$row5['last_name'];?></td>
      <td><?php echo $row5['title']; ?></td>
      <td><?php echo $row5['lyrics']; ?></td>
      <td><?php echo $row5['theme']; ?></td>
      <td><?php echo $row5['role']; ?></td>
    </tr>
  <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist, Playback Singer , Music Director ,Lead Actor, Lead Actress and Director Ends here -->


<!--Lyricist , Music Director ,Lead Actor, Lead Actress, Director and Producer starts here-->
          <?php

          if(!empty($lyricist) AND empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actress'
                AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='director'
                  AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                  OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                  if(mysqli_num_rows($query4)>0){

                    $query5 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                    from song_people
                    JOIN people ON people.people_id = song_people.people_id
                    JOIN songs ON songs.song_id = song_people.song_id
                    WHERE song_people.role='producer'
                    AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                    OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                    if(mysqli_num_rows($query5)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

    <?php
    while($row5 = mysqli_fetch_assoc($query5)){
      $count++;
    ?>
    <tr>
      <td><?php echo $count; ?></td>
      <td><?php echo $row5['first_name'].' '.$row5['middle_name'].' '.$row5['last_name'];?></td>
      <td><?php echo $row5['title']; ?></td>
      <td><?php echo $row5['lyrics']; ?></td>
      <td><?php echo $row5['theme']; ?></td>
      <td><?php echo $row5['role']; ?></td>
    </tr>
  <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist , Music Director ,Lead Actor, Lead Actress, Director and Producer Ends here -->



<!--Playback Singer , Music Director ,Lead Actor, Lead Actress, Director and Producer starts here-->
          <?php

          if(empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='music_director'
            AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
            OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='leading_actor'
              AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
              OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actress'
                AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='director'
                  AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                  OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                  if(mysqli_num_rows($query4)>0){

                    $query5 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                    from song_people
                    JOIN people ON people.people_id = song_people.people_id
                    JOIN songs ON songs.song_id = song_people.song_id
                    WHERE song_people.role='producer'
                    AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                    OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                    if(mysqli_num_rows($query5)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

    <?php
    while($row5 = mysqli_fetch_assoc($query5)){
      $count++;
    ?>
    <tr>
      <td><?php echo $count; ?></td>
      <td><?php echo $row5['first_name'].' '.$row5['middle_name'].' '.$row5['last_name'];?></td>
      <td><?php echo $row5['title']; ?></td>
      <td><?php echo $row5['lyrics']; ?></td>
      <td><?php echo $row5['theme']; ?></td>
      <td><?php echo $row5['role']; ?></td>
    </tr>
  <?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Playback Singer , Music Director ,Lead Actor, Lead Actress, Director and Producer Ends here -->


<!--Lyricist, Playback Singer , Music Director ,Lead Actor, Lead Actress, Director and Producer starts here-->
          <?php

          if(!empty($lyricist) AND !empty($playback_singer) AND !empty($music_director) AND !empty($leading_actor)
           AND !empty($leading_actress) AND !empty($director) AND !empty($producer) ){
            ?>
            <h3 style = "color: #01B0F1;">Search Result</h3>
            <?php
            $query =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='lyricist'
            AND (people.first_name LIKE '%".$lyricist."%' OR people.middle_name LIKE '%".$lyricist."%'
            OR people.last_name LIKE '%".$lyricist."%' OR people.stage_name LIKE '%".$lyricist."%')");

            if(mysqli_num_rows($query)>0){
            $count ='0';

            $query1 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
            from song_people
            JOIN people ON people.people_id = song_people.people_id
            JOIN songs ON songs.song_id = song_people.song_id
            WHERE song_people.role='playback_singer'
            AND (people.first_name LIKE '%".$playback_singer."%' OR people.middle_name LIKE '%".$playback_singer."%'
            OR people.last_name LIKE '%".$playback_singer."%' OR people.stage_name LIKE '%".$playback_singer."%')");

            if(mysqli_num_rows($query1)>0){

              $query2 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
              from song_people
              JOIN people ON people.people_id = song_people.people_id
              JOIN songs ON songs.song_id = song_people.song_id
              WHERE song_people.role='music_director'
              AND (people.first_name LIKE '%".$music_director."%' OR people.middle_name LIKE '%".$music_director."%'
              OR people.last_name LIKE '%".$music_director."%' OR people.stage_name LIKE '%".$music_director."%')");

              if(mysqli_num_rows($query2)>0){
                $query3 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                from song_people
                JOIN people ON people.people_id = song_people.people_id
                JOIN songs ON songs.song_id = song_people.song_id
                WHERE song_people.role='leading_actor'
                AND (people.first_name LIKE '%".$leading_actor."%' OR people.middle_name LIKE '%".$leading_actor."%'
                OR people.last_name LIKE '%".$leading_actor."%' OR people.stage_name LIKE '%".$leading_actor."%')");

                if(mysqli_num_rows($query3)>0){

                  $query4 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                  from song_people
                  JOIN people ON people.people_id = song_people.people_id
                  JOIN songs ON songs.song_id = song_people.song_id
                  WHERE song_people.role='leading_actress'
                  AND (people.first_name LIKE '%".$leading_actress."%' OR people.middle_name LIKE '%".$leading_actress."%'
                  OR people.last_name LIKE '%".$leading_actress."%' OR people.stage_name LIKE '%".$leading_actress."%')");

                  if(mysqli_num_rows($query4)>0){

                    $query5 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                    from song_people
                    JOIN people ON people.people_id = song_people.people_id
                    JOIN songs ON songs.song_id = song_people.song_id
                    WHERE song_people.role='director'
                    AND (people.first_name LIKE '%".$director."%' OR people.middle_name LIKE '%".$director."%'
                    OR people.last_name LIKE '%".$director."%' OR people.stage_name LIKE '%".$director."%')");

                    if(mysqli_num_rows($query5)>0){

                      $query6 =mysqli_query($db,"select songs.title,songs.lyrics,songs.theme,song_people.role, people.first_name,people.middle_name,people.last_name
                      from song_people
                      JOIN people ON people.people_id = song_people.people_id
                      JOIN songs ON songs.song_id = song_people.song_id
                      WHERE song_people.role='director'
                      AND (people.first_name LIKE '%".$producer."%' OR people.middle_name LIKE '%".$producer."%'
                      OR people.last_name LIKE '%".$producer."%' OR people.stage_name LIKE '%".$producer."%')");

                      if(mysqli_num_rows($query6)>0){

            ?>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th><th scope="col">People Name</th>
            <th scope="col">Song Title</th> <th scope="col">Song Lyrics</th>
            <th scope="col">Song Theme</th> <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>
              <?php
              while($row = mysqli_fetch_assoc($query)){
                $count++;
              ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['lyrics']; ?></td>
                <td><?php echo $row['theme']; ?></td>
                <td><?php echo $row['role']; ?></td>
              </tr>
            <?php } ?>


            <?php
            while($row1 = mysqli_fetch_assoc($query1)){
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];?></td>
              <td><?php echo $row1['title']; ?></td>
              <td><?php echo $row1['lyrics']; ?></td>
              <td><?php echo $row1['theme']; ?></td>
              <td><?php echo $row1['role']; ?></td>
            </tr>
          <?php } ?>

          <?php
          while($row2 = mysqli_fetch_assoc($query2)){
            $count++;
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['first_name'].' '.$row2['middle_name'].' '.$row2['last_name'];?></td>
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['lyrics']; ?></td>
            <td><?php echo $row2['theme']; ?></td>
            <td><?php echo $row2['role']; ?></td>
          </tr>
        <?php } ?>

        <?php
        while($row3 = mysqli_fetch_assoc($query3)){
          $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row3['first_name'].' '.$row3['middle_name'].' '.$row3['last_name'];?></td>
          <td><?php echo $row3['title']; ?></td>
          <td><?php echo $row3['lyrics']; ?></td>
          <td><?php echo $row3['theme']; ?></td>
          <td><?php echo $row3['role']; ?></td>
        </tr>
      <?php } ?>


      <?php
      while($row4 = mysqli_fetch_assoc($query4)){
        $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row4['first_name'].' '.$row4['middle_name'].' '.$row4['last_name'];?></td>
        <td><?php echo $row4['title']; ?></td>
        <td><?php echo $row4['lyrics']; ?></td>
        <td><?php echo $row4['theme']; ?></td>
        <td><?php echo $row4['role']; ?></td>
      </tr>
    <?php } ?>

    <?php
    while($row5 = mysqli_fetch_assoc($query5)){
      $count++;
    ?>
    <tr>
      <td><?php echo $count; ?></td>
      <td><?php echo $row5['first_name'].' '.$row5['middle_name'].' '.$row5['last_name'];?></td>
      <td><?php echo $row5['title']; ?></td>
      <td><?php echo $row5['lyrics']; ?></td>
      <td><?php echo $row5['theme']; ?></td>
      <td><?php echo $row5['role']; ?></td>
    </tr>
  <?php } ?>

  <?php
  while($row6 = mysqli_fetch_assoc($query6)){
    $count++;
  ?>
  <tr>
    <td><?php echo $count; ?></td>
    <td><?php echo $row6['first_name'].' '.$row6['middle_name'].' '.$row6['last_name'];?></td>
    <td><?php echo $row6['title']; ?></td>
    <td><?php echo $row6['lyrics']; ?></td>
    <td><?php echo $row6['theme']; ?></td>
    <td><?php echo $row6['role']; ?></td>
  </tr>
<?php } ?>

            </tbody>
          </table>

        <?php }

      else{
        echo '<h3>No Matches</h3>';
      }
    }
    else{
      echo '<h3>No Matches</h3>';
    }
  }
  else{
    echo '<h3>No Matches</h3>';
  }
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
}
else{
  echo '<h3>No Matches</h3>';
}
  }
  ?>
<!--Lyricist, Playback Singer , Music Director ,Lead Actor, Lead Actress, Director and Producer Ends here -->






 <style>
   tfoot {
     display: table-header-group;
   }
 </style>

  <?php include("./footer.php"); ?>
