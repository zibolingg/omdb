<?php
  require 'db_configuration.php';
  $total_elements = $_POST['total_elements'];

  $movie_id = $_POST['movie_id'];

  for($i=1 ; $i<$total_elements ; $i++){
    if(!empty($_POST['song_id'.$i.''])){
      $id = $_POST['song_id'.$i.''];
      $query = "delete from movie_song where id='$id'";
      $result = mysqli_query($db,$query);
    }
    else{
      // break;
    }
  }

header("location:add_song.php?movie_id=$movie_id")

?>
// looks great
