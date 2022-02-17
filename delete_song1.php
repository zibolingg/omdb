<?php
  require 'db_configuration.php';
    $song_id = $_GET['song_id'];
    $query = mysqli_query($db,"DELETE FROM `songs` WHERE song_id='$song_id'");
    if($query){
      echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data deleted Succesfully');
    window.location.href='songs.php';
    </script>");
    }
?>
