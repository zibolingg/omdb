
<?php $page_title = 'Delete your movie'; ?>
<?php 
     $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";
  require 'db_credentials.php'; 
    include("./nav.php");

?>
<div class="container">
<style>#title {text-align: center; color: darkgoldenrod;}</style>
<?php
include_once 'db_credentials.php';


  $db = mysqli_connect('localhost','root','','OMDB');


	
     $id = $_GET['movie_id'];
    $sql = "DELETE FROM movies WHERE movie_id = '$id'";
    

	


        if (!$db) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            
    }
        mysqli_query($db, $sql);
        
        header('location: movies.php?updated=Success');
        mysqli_close($db);

        ?>










