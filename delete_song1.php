<?php
  include("./nav.php");
    $song_id = $_GET['song_id'];
    $query = mysqli_query($db,"DELETE FROM `songs` WHERE song_id='$song_id'");
    if($query){
    db_disconnect($db);
      echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data deleted Succesfully');
    window.location.href='songs.php';
    </script>");
    }
    db_disconnect($db);
?>
