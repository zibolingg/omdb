<?php
include("./nav.php");
  if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $lyrics = $_POST['lyrics'];
    $theme = $_POST['theme'];

    $query = mysqli_query($db , "UPDATE `songs` SET
      `title`='$title',`lyrics`='$lyrics',`theme`='$theme' WHERE song_id='$id'");
      db_disconnect($db);
      if($query){
        echo '<script type="text/javascript">';
        echo 'alert("Data updated successfully");';
        echo 'window.location.href = "songs.php";';
        echo '</script>';
      }
  }

?>
