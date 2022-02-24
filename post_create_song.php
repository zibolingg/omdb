<?php
          include(".\nav.php");
        if(isset($_POST['submit'])){
          $title = $_POST['title'];
          $lyrics = $_POST['lyrics'];
          $theme = $_POST['theme'];
          $a = "INSERT INTO `songs`(`title`, `lyrics`, `theme`) VALUES ('$title','$lyrics','$theme')";
          $query = mysqli_query($db,$a);
          db_disconnect($db);
          echo ("<script LANGUAGE='JavaScript'>
          window.alert('Succesfully Added');
          window.location.href='create_song.php';
          </script>");

        }
?>

